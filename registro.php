<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Mismos estilos que productos -->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/servicios.css">
  
</head>

<body>

    <div class="d-flex flex-column min-vh-100">

        <!-- MENÚ -->
        <?php include 'php/menu.php'; ?>

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="m-0">Registrar Nuevo Usuario</h3>
            </div>
            <div class="card-body">
                <form method="post" action="adm_usuario_registrar_usuario.php">

                    <h5 class="mb-3 text-secondary">Información Personal</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="usu_nombre" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Edad</label>
                            <input type="number" class="form-control" name="usu_edad" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sexo</label>
                           
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" name="usu_ap_pat" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" name="usu_ap_mat" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo de Usuario</label>
                            <select class="form-select" name="tipo" disabled>
                                <option value="cliente" selected>Cliente</option>
                            </select>

                            <!-- IMPORTANTE: si el select está disabled, su valor NO viaja al POST -->
                            <!-- Así que agregamos un input oculto con el valor correcto -->
                            <input type="hidden" name="tipo" value="cliente">
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3 text-secondary">Acceso (Login)</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Correo Electrónico </label>
                            <input type="email" class="form-control" name="usu_correo" required onkeyup="this.value=this.value.toLowerCase();">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="usu_password" required>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3 text-secondary">Domicilio</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Calle</label>
                            <input type="text" class="form-control" name="dom_calle" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Número</label>
                            <input type="text" class="form-control" name="dom_numero">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="dom_colonia" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ciudad</label>
                            <input type="text" class="form-control" name="dom_ciudad" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" name="dom_estado" required onkeyup="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">C.P.</label>
                            <input type="text" class="form-control" name="dom_cp" required>
                        </div>
                    </div>

                    <div class="mt-4">
    <button type="submit" class="btn btn-registrarse w-100">Registrarse</button>
</div>

                </form>
            </div>
        </div>
    </div>
    
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <?php include("php/footer.php"); ?>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>