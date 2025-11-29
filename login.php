<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - DIVIAL</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="login-container">

        <div class="card-login shadow-lg">

            <div class="row g-0">

                <!-- LADO IZQUIERDO CON LOGO -->
                <div class="col-lg-6 login-image d-flex align-items-center justify-content-center">
                    <img src="img/logo vidreria.jpg" alt="DIVIAL" class="logo-login">
                </div>

                <!-- LADO DERECHO FORMULARIO -->
                <div class="col-lg-6 bg-white p-5">

                    <div class="text-center mb-4">
                        <h1 class="titulo-login">Bienvenido</h1>
                        <p class="subtitulo-login">Acceso al Sistema</p>
                    </div>

                    <form action="validar_usuario.php" method="post">

                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input name="ema_email" type="email" class="form-control input-login" value="edgar@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input name="pas_password" type="password" class="form-control input-login" value="1234" required>
                        </div>

                        <button type="submit" class="btn btn-login w-100 mt-2">Iniciar Sesión</button>

                        <a href="registro.php" class="btn btn-outline-light w-100 mt-3 btn-registrarse">
                            Registrarse
                        </a>

                    </form>

                    <div class="text-center mt-4">
                        <a href="index.php" class="volver-tienda">← Regresar a la tienda</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
