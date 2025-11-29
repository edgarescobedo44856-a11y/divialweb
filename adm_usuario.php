<?php 
session_start();
// Validamos sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    echo "Usuario no Logueado";
    header('Location: login.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Mueblería</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
    
    <?php include("php/conexion.php"); ?>
    
    <style>
        /* Ajustes específicos para esta página si los necesitas */
    </style>
</head>

<body>

    <div >

        <?php include('php/admin_menu.php'); ?>

        <div id="page-content-wrapper">
            

            <div class="container-fluid px-4 py-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">Gestión de Usuarios</h2>
                    <a href="adm_usuario_registrar.php" class="btn btn-success">
                        <i class="bi bi-person-plus-fill"></i> 
                        <span class="lang-es">Nuevo Usuario</span><span class="lang-en d-none">New User</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><span class="lang-es">Lista de Usuarios Registrados</span><span class="lang-en d-none">User List</span></h5>
                    </div>

                    <div class="card-body">
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form action="" method="GET"> 
                                    <div class="input-group">
                                        <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre o email...">
                                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> <span class="lang-es">Buscar</span><span class="lang-en d-none">Search</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                        // Lógica de búsqueda (simple)
                        // Nota: Si usas el buscador, aquí deberías filtrar con WHERE, 
                        // por ahora dejo el select completo como estaba.
                        $result = select("usuarios");
                        ?>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID / Email</th>
                                        <th><span class="lang-es">Nombre</span><span class="lang-en d-none">Name</span></th>
                                        <th><span class="lang-es">Apellidos</span><span class="lang-en d-none">Lastname</span></th> 
                                        <th>Email</th>
                                        <th><span class="lang-es">Tipo</span><span class="lang-en d-none">Type</span></th>
                                        <th class="text-center"><span class="lang-es">Acciones</span><span class="lang-en d-none">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_object($result)) {
                                ?>
                                    <tr>
                                        <td><small class="text-muted"><?php echo $row->usu_correo; ?></small></td>

                                        <td class="fw-bold"><?php echo $row->usu_nombre; ?></td>

                                        <td><?php echo $row->usu_ap_pat . " " . $row->usu_ap_mat; ?></td>

                                        <td><?php echo $row->usu_correo; ?></td>

                                        <td>
                                            <?php 
                                                $tipo = isset($row->tipo) ? $row->tipo : 'cliente';
                                                $badgeColor = ($tipo == 'admin') ? 'bg-danger' : (($tipo == 'gerente') ? 'bg-primary' : 'bg-secondary');
                                            ?>
                                            <span class="badge <?php echo $badgeColor; ?>"><?php echo strtoupper($tipo); ?></span>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="adm_usuario_modificar.php?id=<?php echo $row->usu_correo; ?>" class="btn btn-warning btn-sm text-dark" title="Editar">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="adm_usuario_eliminar.php?id=<?php echo $row->usu_correo; ?>" onclick="return confirmarEliminacion()" class="btn btn-danger btn-sm" title="Eliminar">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    } 
                                } else {
                                    echo "<tr><td colspan='6' class='text-center py-4'>No hay usuarios registrados</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div> </div> </div> </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function confirmarEliminacion() {
        return confirm("¿Realmente desea eliminar este registro? Esta acción no se puede deshacer.");
      }
    </script>
</body>
</html>