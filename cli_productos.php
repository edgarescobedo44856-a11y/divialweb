<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - Vidriería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tus estilos -->
    <link rel="stylesheet" href="css/menu.css">  

    <link rel="stylesheet" href="css/productos.css"> 
</head>

<body >

    <!-- MENÚ -->
   <?php include 'php/menu.php'; ?>


    <div >
 <header class="header text-center sombra">
        <h1>Catalogo general de productos</h1>
        <p></p>
    </header>
 <div class="container my-4">
        <div class="input-group mb-3 busqueda sombra">
            <span class="input-group-text bg-azul text-white">🔍</span>
            <input type="text" id="buscador" class="form-control" placeholder="Buscar producto...">
        </div>
    </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <!-- ================= PRODUCTO 1 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/vidrio 6mm.jpg" class="card-img-top" alt="Vidrio Templado" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Vidrio Templado (6 mm)</h5>
                        <p class="card-text text-light">Vidrio de seguridad ideal para canceles, puertas y barandales.</p>
                        <h4 class="text-info">Precio por m²</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 2 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/vidrio_laminado_3+3.jpg" class="card-img-top" alt="Vidrio Laminado" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Vidrio Laminado (3+3 mm)</h5>
                        <p class="card-text text-light">Dúplex de seguridad. Mantiene fragmentos unidos.</p>
                        <h4 class="text-info">Precio por m²</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 3 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/espejo_plata_4mm.jpg" class="card-img-top" alt="Espejo" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Espejo Plata (4 mm)</h5>
                        <p class="card-text text-light">Espejo de alta calidad. Corte a medida.</p>
                        <h4 class="text-info">Precio por m²</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 4 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/bisagra_psio.jpg" class="card-img-top" alt="Bisagra de Piso" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Bisagra de Piso</h5>
                        <p class="card-text text-light">Para puertas de cristal templado de alto tráfico.</p>
                        <h4 class="text-info">Precio por unidad</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 5 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/jaladera_tabular.jpg" class="card-img-top" alt="Jaladera Tubular" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Jaladera Tubular</h5>
                        <p class="card-text text-light">Acero inoxidable para puertas de vidrio o madera.</p>
                        <h4 class="text-info">Precio por unidad</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 6 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/pinza_fijo.jpg" class="card-img-top" alt="Pinza Sujetadora" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Pinza Sujetadora</h5>
                        <p class="card-text text-light">Pinza de sujeción para cristal templado.</p>
                        <h4 class="text-info">Precio por unidad</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 7 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/perfil_p75.jpg" class="card-img-top" alt="Perfil de Ventana" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Perfil Línea 75</h5>
                        <p class="card-text text-light">Perfil de aluminio para ventanas corredizas.</p>
                        <h4 class="text-info">Precio por metro lineal</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 8 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/perfil_u_simple.jpg" class="card-img-top" alt="Perfil U Simple" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Perfil U Simple</h5>
                        <p class="card-text text-light">Para vidrios fijos de 8–10 mm.</p>
                        <h4 class="text-info">Precio por metro lineal</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

            <!-- ================= PRODUCTO 9 ================= -->
            <div class="col">
                <div class="card h-100 shadow-sm bg-secondary text-white hover-zoom">
                    <img src="img/riel_superior.jpg" class="card-img-top" alt="Riel Superior" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Riel Superior</h5>
                        <p class="card-text text-light">Para puertas corredizas de cristal templado.</p>
                        <h4 class="text-info">Precio por metro lineal</h4>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="login.php" class="btn btn-outline-info w-100">Cotizar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
 
    <!-- FOOTER FINAL -->
    <footer class="mt-5 py-4 bg-black text-center text-white">
        <?php include("php/footer.php"); ?>
    </footer>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
