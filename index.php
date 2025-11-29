<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio - Vidriería DIVIAL</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Mismos estilos que productos -->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/servicios.css">
</head>

<body>

    <div class="d-flex flex-column min-vh-100">

        <!-- MENÚ -->
        <?php include 'php/menu.php'; ?>

        <!-- HEADER A LO ANCHO -->
        <header class="header text-center sombra py-4 w-100">
            <h1>BIENVENIDOS A DIVIAL</h1>
            <p>Donde encontrarás los mejores productos de vidrio y aluminio.</p>
        </header>

        <!-- CONTENIDO PRINCIPAL -->
        <div class="container my-5">

            <!-- Imagen centrada -->
            <div class="d-flex justify-content-center">
                <img src="img/Imagen1Inicio.png" 
                     class="img-fluid sombra img-borde" 
                     style="max-width: 720px;">
            </div>

        </div>
        <header class="header text-center sombra py-4 w-100">
            <h1>SERVICIOS</h1>
           
        </header>
         <!-- CONTENIDO SERVICIOS -->
        <div class="container my-5">

            <!-- Imagen centrada -->
            <div class="d-flex justify-content-center">
                <img src="img/INDEX1.jpg" 
                     class="img-fluid sombra img-borde" 
                     style="max-width: 720px;">
            </div>

        </div>
        <header class="header text-center sombra py-4 w-100">
            <h1>PRODUCTOS</h1>
           
        </header>
         <!-- CONTENIDO PRODUCTOS -->
        <div class="container my-5">

            <!-- Imagen centrada -->
            <div class="d-flex justify-content-center">
                <img src="img/INDEX2.jpg" 
                     class="img-fluid sombra img-borde" 
                     style="max-width: 720px;">
            </div>

        </div>

        <!-- FOOTER -->
        <footer class="py-4 navbar-elegante text-white text-center sombra">
            <div class="container">
                <?php include("php/footer.php"); ?>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
