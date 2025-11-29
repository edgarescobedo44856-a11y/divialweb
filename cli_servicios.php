<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios | DIVIAL</title>

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tus estilos -->
    <link rel="stylesheet" href="css/menu.css">  
    <link rel="stylesheet" href="css/servicios.css">  
</head>

<body class="fade-in">

    <?php include 'php/menu.php'; ?>

    <!-- BANNER -->
    <header class="header text-center sombra">
        <h1>Servicios Profesionales en Vidrio y Aluminio</h1>
        <p>Soluciones premium para hogares, negocios y construcción moderna.</p>
    </header>

    <!-- BUSCADOR -->
    <div class="container my-4">
        <div class="input-group mb-3 busqueda sombra">
            <span class="input-group-text bg-azul text-white">🔍</span>
            <input type="text" id="buscador" class="form-control" placeholder="Buscar servicio...">
        </div>
    </div>

    <!-- SERVICIOS -->
    <section class="container servicios-container py-4">

        <div class="row row-cols-1 row-cols-md-3 g-4" id="listaServicios">

            <!-- 1 -->
            <div class="col servicio" data-nombre="ventanas aluminio fabricacion">
                <div class="card h-100 card-service text-center sombra">
                    <img src="img/producto1.png" class="card-img-top img-servicio" alt="Ventanas de aluminio">

                    <div class="card-body">
                        <h3 class="titulo-servicio">Fabricación de Ventanas de Aluminio</h3>
                        <p>Sellado térmico, máxima durabilidad y diseños modernos.</p>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="col servicio" data-nombre="barandales vidrio templado">
                <div class="card h-100 card-service text-center sombra">
                    <img src="img/barandal_templado.jpg" class="card-img-top img-servicio" alt="Barandales">

                    <div class="card-body">
                        <h3 class="titulo-servicio">Barandales de Vidrio Templado</h3>
                        <p>Acabado premium, seguridad probada y estética minimalista.</p>
                    </div>
                </div>
            </div>

            <!-- 3 -->
            <div class="col servicio" data-nombre="puertas aluminio vidrio">
                <div class="card h-100 card-service text-center sombra">
                    <img src="img/puertas_aluminio.jpg" class="card-img-top img-servicio" alt="Puertas">

                    <div class="card-body">
                        <h3 class="titulo-servicio">Puertas de Aluminio y Vidrio</h3>
                        <p>Modelos corredizos, abatibles y personalizados.</p>
                    </div>
                </div>
            </div>

            <!-- 4 -->
            <div class="col servicio" data-nombre="canceles baño vidrio templado">
                <div class="card h-100 card-service text-center sombra">
                    <img src="img/canceles_baño.jpg" class="card-img-top img-servicio" alt="Canceles">

                    <div class="card-body">
                        <h3 class="titulo-servicio">Canceles para Baño</h3>
                        <p>Vidrio templado y diseño elegante con instalación profesional.</p>
                    </div>
                </div>
            </div>

            <!-- 5 -->
            <div class="col servicio" data-nombre="estructuras aluminio marquesinas domos">
                <div class="card h-100 card-service text-center sombra">
                    <img src="img/estructuras.jpg" class="card-img-top img-servicio" alt="Estructuras">

                    <div class="card-body">
                        <h3 class="titulo-servicio">Estructuras de Aluminio</h3>
                        <p>Marquesinas, domos y sistemas de alta resistencia.</p>
                    </div>
                </div>
            </div>

            <!-- 6 -->
            <div class="col servicio" data-nombre="cortinas aluminio">
                <div class="card h-100 card-service text-center sombra">
                    <img src="img/cortinas.jpg" class="card-img-top img-servicio" alt="Cortinas">

                    <div class="card-body">
                        <h3 class="titulo-servicio">Cortinas de Aluminio</h3>
                        <p>Protección y estética para comercio y hogar.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-4 navbar-elegante text-white text-center sombra">
        <div class="container">
            <?php include("php/footer.php"); ?>
        </div>
    </footer>

<script>
    // BUSCADOR DE SERVICIOS
    document.getElementById("buscador").addEventListener("keyup", function() {
        let filtro = this.value.toLowerCase();
        let servicios = document.querySelectorAll(".servicio");

        servicios.forEach(serv => {
            let nombre = serv.getAttribute("data-nombre");
            serv.style.display = nombre.includes(filtro) ? "" : "none";
        });
    });
</script>

</body>
</html>
