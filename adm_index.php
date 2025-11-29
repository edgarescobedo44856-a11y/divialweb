<?php 
session_start();

// Verificar sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Administrativo - DIVIAL</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div >

    <!-- MENÚ LATERAL -->
    <?php include('php/admin_menu.php'); ?>

    <!-- CONTENIDO PRINCIPAL -->
    <div id="page-content-wrapper" class="p-4 flex-grow-1">

        <div class="container-fluid">

            <!-- ENCABEZADO -->
            <div class="mb-4">
                <h2 class="fw-bold text-dark">Menú Administrativo</h2>
                <p class="text-muted">
                    Bienvenido 
                    <span class="fw-semibold text-primary">
                        <?= htmlspecialchars($_SESSION['usuario']); ?>
                    </span>, aquí puedes gestionar toda la operación de la empresa.
                </p>
            </div>

            <!-- TARJETAS -->
            <div class="row g-4">

                <!-- Usuarios -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="icon-container bg-primary text-white mx-auto">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5 class="mt-3 fw-bold">Usuarios</h5>
                            <p class="text-muted small">Control de accesos y roles del sistema</p>
                            <a href="adm_usuario.php" class="btn btn-outline-primary w-100">Administrar</a>
                        </div>
                    </div>
                </div>

                <!-- Proveedores -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="icon-container bg-primary text-white mx-auto">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h5 class="mt-3 fw-bold">Proveedores</h5>
                            <p class="text-muted small">Control de proveedores</p>
                            <a href="adm_proveedor.php" class="btn btn-outline-primary w-100">Administrar</a>
                        </div>
                    </div>
                </div>

                <!-- Inventario -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="icon-container bg-success text-white mx-auto">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <h5 class="mt-3 fw-bold">Inventario</h5>
                            <p class="text-muted small">Productos, existencia y materiales</p>
                            <a href="adm_producto.php" class="btn btn-outline-success w-100">Ver inventario</a>
                        </div>
                    </div>
                </div>

                <!-- Cotizaciones -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="icon-container bg-info text-white mx-auto">
                                <i class="bi bi-tools"></i>
                            </div>
                            <h5 class="mt-3 fw-bold">Cotizaciones</h5>
                            <p class="text-muted small">Pedidos y solicitudes de clientes</p>
                            <a href="adm_cotizaciones.php" class="btn btn-outline-info w-100">Ver pedidos</a>
                        </div>
                    </div>
                </div>

                <!-- Cortadores -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="icon-container bg-warning text-white mx-auto">
                                <i class="bi bi-scissors"></i>
                            </div>
                            <h5 class="mt-3 fw-bold">Cortadores</h5>
                            <p class="text-muted small">Gestión de trabajos y asignaciones</p>
                            <a href="adm_cortadores.php" class="btn btn-outline-warning w-100">Gestionar</a>
                        </div>
                    </div>
                </div>

                <!-- Repartidores -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="icon-container bg-danger text-white mx-auto">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h5 class="mt-3 fw-bold">Repartidores</h5>
                            <p class="text-muted small">Control de entregas y seguimiento</p>
                            <a href="adm_repartidores.php" class="btn btn-outline-danger w-100">Supervisar</a>
                        </div>
                    </div>
                </div>

            </div> <!-- row -->

        </div> <!-- container-fluid -->

    </div> <!-- page-content-wrapper -->

</div> <!-- d-flex -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
c:\wamp64\www\examen\css\adm_menu.css