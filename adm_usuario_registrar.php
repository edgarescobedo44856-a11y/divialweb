<?php 
session_start();
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario - Admin</title>
    
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    <div>

        

        <div id="page-content-wrapper">

            <?php include 'php/admin_menu.php'; ?>

            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">
                        <span class="lang-es">Nuevo Usuario</span>
                        <span class="lang-en d-none">New User</span>
                    </h2>
                    <a href="adm_usuario.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> 
                        <span class="lang-es">Volver a la lista</span>
                        <span class="lang-en d-none">Back to list</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            <span class="lang-es">Registrar Nuevo Usuario</span>
                            <span class="lang-en d-none">Register New User</span>
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <form id="form_usuario" method="post" action="adm_usuario_registrar_usuario.php" onsubmit="return validarUsuario(this);">

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Información Personal</span>
                                <span class="lang-en d-none">Personal Information</span>
                            </h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Nombre</span>
                                        <span class="lang-en d-none">First Name</span>
                                    </label>
                                    <input type="text" class="form-control" name="usu_nombre" id="usu_nombre" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Edad</span>
                                        <span class="lang-en d-none">Age</span>
                                    </label>
                                    <input type="number" class="form-control" name="usu_edad" id="usu_edad">
                                </div>

                               
                                   

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Apellido Paterno</span>
                                        <span class="lang-en d-none">Last Name</span>
                                    </label>
                                    <input type="text" class="form-control" name="usu_ap_pat" id="usu_ap_pat" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Apellido Materno</span>
                                        <span class="lang-en d-none">Second Last Name</span>
                                    </label>
                                    <input type="text" class="form-control" name="usu_ap_mat" id="usu_ap_mat" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Tipo de Usuario</span>
                                        <span class="lang-en d-none">User Type</span>
                                    </label>
                                    <select class="form-select" name="tipo" id="tipo">
                                        <option value="" selected disabled>Select...</option>
                                        <option value="admin">Admin</option>
                                        <option value="gerente">Gerente / Manager</option>
                                        <option value="cliente">Cliente / Client</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Acceso (Login)</span>
                                <span class="lang-en d-none">Access (Login)</span>
                            </h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Correo Electrónico</span>
                                        <span class="lang-en d-none">Email Address</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" name="usu_correo" id="usu_correo" onkeyup="this.value=this.value.toLowerCase();">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Contraseña</span>
                                        <span class="lang-en d-none">Password</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                                        <input type="password" class="form-control" name="usu_password" id="usu_password">
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Domicilio</span>
                                <span class="lang-en d-none">Address</span>
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Calle</span>
                                        <span class="lang-en d-none">Street</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_calle" id="dom_calle" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Número</span>
                                        <span class="lang-en d-none">Number</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_numero" id="dom_numero">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Colonia</span>
                                        <span class="lang-en d-none">Neighborhood</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_colonia" id="dom_colonia" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Ciudad</span>
                                        <span class="lang-en d-none">City</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_ciudad" id="dom_ciudad" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">Estado</span>
                                        <span class="lang-en d-none">State</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_estado" id="dom_estado" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold">
                                        <span class="lang-es">C.P.</span>
                                        <span class="lang-en d-none">Zip Code</span>
                                    </label>
                                    <input type="text" class="form-control" name="dom_cp" id="dom_cp">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-5">
                                <a href="adm_usuario.php" class="btn btn-secondary">
                                    <span class="lang-es">Cancelar</span>
                                    <span class="lang-en d-none">Cancel</span>
                                </a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold">
                                    <i class="bi bi-save"></i> 
                                    <span class="lang-es">Guardar Usuario</span>
                                    <span class="lang-en d-none">Save User</span>
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
            if(link.href.includes("adm_usuario")) {
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    </script>

    <script src="js/validar_usuario.js"></script>

</body>
</html>