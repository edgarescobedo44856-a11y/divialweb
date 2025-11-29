<?php 
session_start();
// 1. Validar sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}
include("php/conexion.php"); 

// 2. Validamos que llegue el ID (Email del proveedor)
if(!isset($_GET['id'])){
    header('Location: adm_proveedor.php');
    exit();
}

$var_email = $_GET['id']; // Usaremos el email como ID único
$result_proveedor = select_where("proveedores", "pro_email = '$var_email'");
$row_proveedor = mysqli_fetch_object($result_proveedor);

// Si no existe el proveedor
if (!$row_proveedor) {
    echo "<script>alert('Proveedor no encontrado'); window.location='adm_proveedor.php';</script>";
    exit();
}

// 3. Buscar Domicilio (Asumiendo que usu_correo en domicilios almacena el email del proveedor)
$result_domicilio = select_where("domicilios", "usu_correo = '$var_email'");
$row_domicilio = mysqli_fetch_object($result_domicilio);

// Si no existe domicilio, inicializamos un objeto vacío para evitar errores
if (!$row_domicilio) {
    $row_domicilio = (object) [
        'dom_calle' => '',
        'dom_numero' => '',
        'dom_colonia' => '',
        'dom_ciudad' => '',
        'dom_estado' => '',
        'dom_cp' => ''
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Proveedor - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/menu_admin.css"> 
</head>

<body>

    <div class="d-flex" id="wrapper">

        <?php include 'php/admin_menu.php'; ?>

        <div id="page-content-wrapper">

            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0"><span class="lang-es">Editar Proveedor</span><span class="lang-en d-none">Edit Supplier</span></h2>
                    <a href="adm_proveedor.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> <span class="lang-es">Regresar a la lista</span><span class="lang-en d-none">Back to List</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-truck me-2"></i><span class="lang-es">Editando: </span><span class="lang-en d-none">Editing: </span><strong><?php echo $row_proveedor->pro_nombre_empresa; ?></strong></h5>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <form method="post" action="adm_proveedor_modificar_proveedor.php">
                            
                            <!-- El Email/ID original se pasa como campo oculto para identificar el registro a actualizar -->
                            <input name="hid_email_original" type="hidden" value="<?php echo $row_proveedor->pro_email; ?>" />

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Datos de la Empresa</span><span class="lang-en d-none">Company Data</span></h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><span class="lang-es">Nombre de la Empresa</span><span class="lang-en d-none">Company Name</span></label>
                                    <input type="text" class="form-control" name="pro_nombre_empresa" 
                                            value="<?php echo $row_proveedor->pro_nombre_empresa; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                
                                

                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><span class="lang-es">Contacto Principal</span><span class="lang-en d-none">Main Contact</span></label>
                                    <input type="text" class="form-control" name="pro_contacto_principal" 
                                            value="<?php echo $row_proveedor->pro_contacto_principal; ?>" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><span class="lang-es">Página Web</span><span class="lang-en d-none">Website</span></label>
                                    <input type="url" class="form-control" name="pro_pagina_web" 
                                            value="<?php echo $row_proveedor->pro_pagina_web; ?>">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" name="pro_email" 
                                            value="<?php echo $row_proveedor->pro_email; ?>" required>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold"><span class="lang-es">Teléfono</span><span class="lang-en d-none">Phone</span></label>
                                    <input type="text" class="form-control" name="pro_telefono" 
                                            value="<?php echo $row_proveedor->pro_telefono; ?>" required>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold"><span class="lang-es">Contraseña</span><span class="lang-en d-none">Password</span></label>
                                    <input type="text" class="form-control" name="pas_password" 
                                            value="<?php echo $row_proveedor->pro_password; ?>" required>
                                </div>
                            </div>
                            
                            <!-- Sección de Domicilio -->
                            <h5 class="text-muted mb-3 border-bottom pb-2"><span class="lang-es">Datos de Domicilio</span><span class="lang-en d-none">Address Details</span></h5>
                            <div class="row g-3 mb-4">
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Calle</label>
                                    <input type="text" class="form-control" name="dom_calle" 
                                        value="<?php echo $row_domicilio->dom_calle; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label fw-bold"><span class="lang-es">Número</span><span class="lang-en d-none">Number</span></label>
                                    <input type="text" class="form-control" name="dom_numero" 
                                        value="<?php echo $row_domicilio->dom_numero; ?>" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold"><span class="lang-es">Colonia</span><span class="lang-en d-none">Neighborhood</span></label>
                                    <input type="text" class="form-control" name="dom_colonia" 
                                        value="<?php echo $row_domicilio->dom_colonia; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold"><span class="lang-es">Ciudad</span><span class="lang-en d-none">City</span></label>
                                    <input type="text" class="form-control" name="dom_ciudad" 
                                        value="<?php echo $row_domicilio->dom_ciudad; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold"><span class="lang-es">Estado</span><span class="lang-en d-none">State</span></label>
                                    <input type="text" class="form-control" name="dom_estado" 
                                        value="<?php echo $row_domicilio->dom_estado; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">C.P.</label>
                                    <input type="text" class="form-control" name="dom_cp" 
                                        value="<?php echo $row_domicilio->dom_cp; ?>" required>
                                </div>

                            </div>


                            <div class="d-flex justify-content-end gap-2 mt-5">
                                <a href="adm_proveedor.php" class="btn btn-secondary"><span class="lang-es">Cancelar</span><span class="lang-en d-none">Cancel</span></a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold">
                                    <i class="bi bi-save"></i> <span class="lang-es">Guardar Cambios</span><span class="lang-en d-none">Save Changes</span>
                                </button>
                            </div>

                        </form>
                    </div>            
                </div>
            </div> 
        </div> 
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para marcar el menú activo (adaptado para adm_proveedor.php) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('#sidebar-wrapper .list-group-item');
            links.forEach(link => {
                if(link.href.includes("adm_proveedor")) {
                    // Primero limpia todas las clases 'active'
                    links.forEach(l => l.classList.remove('active'));
                    // Luego activa el enlace de proveedor
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>