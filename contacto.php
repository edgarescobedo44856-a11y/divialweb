<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Vidriería DIVIAL - Contacto">
    <meta name="keywords" content="Vidrio, aluminio, contacto, cotización">
    <meta name="author" content="DIVIAL">
    <style>
    .header a {
        color: #00ff0dff !important;   /* Color del link */
        text-decoration: none;
        font-weight: bold;
    }

    .header a:hover {
        color: #00bcd4 !important;   /* Color al pasar el mouse */
        text-decoration: underline;
    }
</style>



    <title>Contacto - Vidriería DIVIAL</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/servicios.css">
</head>

<body>

<!-- MENU -->
<?php include('php/menu.php'); ?>

<div id="content">

    <form id="form" name="form" method="post" action="#">
        
        <header class="header text-center sombra">
        <h1>CONTACTO</h1>
       

        <h2>Ubicación</h2>
        <p>
            <b>Dirección:</b> Av. Juárez #405 <br>
            Col. Presa de Cháves <br>
            Cd. Hidalgo, Michoacán
        </p>

        <p>
            <b>Teléfono:</b> +52 786-143-0566<br>
            <a href="https://wa.me/527861430566?text=Hola%2C%20quisiera%20pedir%20una%20cotización.">
                Contáctanos por WhatsApp
            </a>
        </p>

        <p>
            <a href="mailto:divial.compras@gmail.com">
                Correo: divial.compras@gmail.com
            </a>
        </p>

        <p>
            Síguenos en:
            <a href="https://www.facebook.com/share/1EasSwnjE4/">Facebook</a>
        </p>

        <!-- MAPA -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30050.348586669916!2d-100.5355008!3d19.7001216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2c97fe68823d7%3A0xa86a5a92d3461d1e!2sDIVIAL!5e0!3m2!1ses-419!2smx!4v1761794920051!5m2!1ses-419!2smx"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>

    </form>

</div>
</header>
<footer class="py-4 navbar-elegante text-white text-center sombra">
            <div class="container">
                <?php include("php/footer.php"); ?>
            </div>
        </footer>

</body>
</html>
