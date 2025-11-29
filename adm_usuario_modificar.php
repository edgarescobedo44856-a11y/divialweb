<?php 
session_start();
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}
include("php/conexion.php"); 

// Validamos que llegue el ID
if(!isset($_GET['id'])){
    header('Location: adm_usuario.php');
    exit();
}

$var_id = $_GET['id'];
$result = select_where("usuarios", "usu_correo = '$var_id'");
$row = mysqli_fetch_object($result);

// Si no existe el usuario
if (!$row) {
    echo "<script>alert('Usuario no encontrado'); window.location='adm_usuario.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    <div class="d-flex" id="wrapper">

        <?php include 'php/admin_menu.php'; ?>

        <div id="page-content-wrapper">

          

            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0"><span class="lang-es">Editar Usuario</span><span class="lang-en d-none">Edit User</span></h2>
                    <a href="adm_usuario.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> <span class="lang-es">Regresar a la lista</span><span class="lang-en d-none">Back to List</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i><span class="lang-es">Editando a: </span><span class="lang-en d-none">Editing to: </span><strong><?php echo $row->usu_nombre; ?></strong></h5>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <form method="post" action="adm_usuario_modificar_usuario.php">
                            
                            <input name="hid_id" type="hidden" value="<?php echo $row->usu_correo; ?>" />

                            <h5 class="text-muted mb-3 border-bottom pb-2">
                                <span class="lang-es">Datos Personales</span><span class="lang-en d-none">Personal Data</span></h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><span class="lang-es">Nombre</span><span class="lang-en d-none">Name</span></label>
                                    <input type="text" class="form-control" name="txt_Nombre" 
                                           value="<?php echo $row->usu_nombre; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                
                               

                               

                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><span class="lang-es">Apellido Paterno</span><span class="lang-en d-none">Paternal Surname</span></label>
                                    <input type="text" class="form-control" name="txt_ApPat" 
                                           value="<?php echo $row->usu_ap_pat; ?>" required onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><span class="lang-es">Apellido Materno</span><span class="lang-en d-none">Maternal Surname</span></label>
                                    <input type="text" class="form-control" name="txt_ApMat" 
                                           value="<?php echo $row->usu_ap_mat; ?>" onkeyup="this.value=this.value.toUpperCase();">
                                </div>
                            </div>

                            <h5 class="text-muted mb-3 border-bottom pb-2"><span class="lang-es">Datos de cuenta</span><span class="lang-en d-none">Account details</span></h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Email (Usuario)</label>
                                    <input type="email" class="form-control" name="ema_email" 
                                           value="<?php echo $row->usu_correo; ?>" required>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold"><span class="lang-es">Contraseña</span><span class="lang-en d-none">Password</span></label>
                                    <input type="text" class="form-control" name="pas_password" 
                                           value="<?php echo $row->usu_password; ?>" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Rol / Type</label>
                                    <select class="form-select" name="lst_Tipo">
                                        <option value="<?php echo $row->tipo; ?>" selected class="bg-light text-muted">
                                            <?php echo ucfirst($row->tipo); ?> (Actual)
                                        </option>
                                        <option disabled>──────────</option>
                                        <option value="admin">Admin</option>
                                        <option value="gerente">Gerente</option>
                                        <option value="cliente">Cliente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-5">
                                <a href="adm_usuario.php" class="btn btn-secondary"><span class="lang-es">Cancelar</span><span class="lang-en d-none">Cancel</span></a>
                                <button type="submit" class="btn btn-warning px-4 fw-bold">
                                    <i class="bi bi-save"></i> <span class="lang-es">Guardar Cambios</span><span class="lang-en d-none">Save</span>
                                </button>
                            </div>

                        </form>
                    </div>            
                </div>
            </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const links = document.querySelectorAll('#sidebar-wrapper .list-group-item');
        links.forEach(link => {
            if(link.href.includes("adm_usuario")) {
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>