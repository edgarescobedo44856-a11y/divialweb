<?php 
session_start();
// Asegúrate de que solo usuarios autorizados puedan registrar proveedores
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Proveedor - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/menu_admin.css"> 

    <?php include("php/conexion.php"); ?>
</head>

<body>

    <div class="d-flex" id="wrapper">

        <?php include 'php/admin_menu.php'; ?>

        <div id="page-content-wrapper">

            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">
                        <span class="lang-es">Nuevo Proveedor</span>
                        <span class="lang-en d-none">New Supplier</span>
                    </h2>
                    <a href="adm_proveedor.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> 
                        <span class="lang-es">Volver a la lista de Proveedores</span>
                        <span class="lang-en d-none">Back to Supplier list</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-truck me-2"></i>
                            <span class="lang-es">Registrar Nuevo Proveedor</span>
                            <span class="lang-en d-none">Register New Supplier</span>
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <form id="form_proveedor" method="post" action="adm_proveedor_registrar_proveedor.php" onsubmit="return validarProveedor(this);">

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Información de la Empresa</span>
                                <span class="lang-en d-none">Company Information</span>
                            </h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Nombre de la Empresa</span>
                                        <span class="lang-en d-none">Company Name</span>
                                    </label>
                                    <input type="text" class="form-control" name="pro_nombre_empresa" id="pro_nombre_empresa" onkeyup="this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                            
                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Contacto</span>
                                <span class="lang-en d-none">Contact</span>
                            </h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Nombre del Contacto Principal</span>
                                        <span class="lang-en d-none">Primary Contact Name</span>
                                    </label>
                                    <input type="text" class="form-control" name="pro_contacto_principal" id="pro_contacto_principal" onkeyup="this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Email</span>
                                        <span class="lang-en d-none">Email Address</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" name="pro_email" id="pro_email" onkeyup="this.value=this.value.toLowerCase();" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Teléfono</span>
                                        <span class="lang-en d-none">Phone</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control" name="pro_telefono" id="pro_telefono" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Página Web (Opcional)</span>
                                        <span class="lang-en d-none">Website (Optional)</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                        <input type="url" class="form-control" name="pro_pagina_web" id="pro_pagina_web">
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Domicilio Fiscal</span>
                                <span class="lang-en d-none">Fiscal Address</span>
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Calle</span>
                                        <span class="lang-en d-none">Street</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_calle" id="dom_calle" onkeyup="this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Número</span>
                                        <span class="lang-en d-none">Number</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_numero" id="dom_numero" required>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Colonia</span>
                                        <span class="lang-en d-none">Neighborhood</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_colonia" id="dom_colonia" onkeyup="this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Ciudad</span>
                                        <span class="lang-en d-none">City</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_ciudad" id="dom_ciudad" onkeyup="this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Estado</span>
                                        <span class="lang-en d-none">State</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_estado" id="dom_estado" onkeyup="this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">C.P.</span>
                                        <span class="lang-en d-none">Zip Code</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_cp" id="dom_cp" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-5">
                                <a href="adm_proveedor.php" class="btn btn-secondary">
                                    <span class="lang-es">Cancelar</span>
                                    <span class="lang-en d-none">Cancel</span>
                                </a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold">
                                    <i class="bi bi-save"></i> 
                                    <span class="lang-es">Guardar Proveedor</span>
                                    <span class="lang-en d-none">Save Supplier</span>
                                </button>
                            </div>

                        </form>
                    </div>          
                </div>
            </div> 
        
        </div> 
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const links = document.querySelectorAll('#sidebar-wrapper .list-group-item');
        links.forEach(link => {
            if(link.href.includes("adm_proveedor")) {
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });

        function validarProveedor(form) {
            if (form.pro_nombre_empresa.value.trim() === "") {
                console.error("El nombre de la empresa es obligatorio.");
                form.pro_nombre_empresa.focus();
                return false;
            }
            if (form.pro_email.value.trim() === "") {
                console.error("El email es obligatorio.");
                form.pro_email.focus();
                return false;
            }
            return true;
        }
    </script>
    </body>
</html>
