<?php 
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php'); 
    exit();
}

include("php/conexion.php");

$dato_sesion = $_SESSION['usuario']; 

// Buscamos al usuario ya sea por nombre O por correo
$sql_user = "SELECT usu_correo FROM usuarios WHERE usu_correo = '$dato_sesion' OR usu_nombre = '$dato_sesion'";
$res_user = db_query($sql_user);
$row_user = mysqli_fetch_object($res_user);

// Si encontramos al usuario, usamos ese correo para buscar los pedidos
if($row_user){
    $cliente_actual = $row_user->usu_correo;
} else {
    $cliente_actual = "error"; // Usuario no encontrado
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos - Mueblería</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; }
        .status-badge { font-size: 0.9em; }
        .card-header-client { background-color: #343a40; color: white; } /* Mismo tono oscuro elegante */
    </style>
</head>
<body>

    <?php include('php/cli_navbar.php'); ?>

    <div class="container my-5">
        
        <div class="row">
            <div class="col-12 mb-4">
                <h2 class="fw-light">Hola, <span class="fw-bold" style="color: #A0522D;"><?php echo $_SESSION['usuario']; ?></span></h2>
                <p class="text-muted">Aquí tienes el historial de tus solicitudes de cotización.</p>
            </div>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header card-header-client d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Mis Solicitudes</h5>
                <a href="cli_cotizar.php" class="btn btn-warning btn-sm fw-bold text-dark">
                    <i class="bi bi-plus-lg"></i> Nueva Cotización
                </a>
            </div>

            <div class="card-body">
                
                <?php
                // CONSULTA: Traer solo los pedidos de ESTE usuario
                // Ordenados del más reciente al más antiguo
                $sql = "SELECT * FROM cotizaciones WHERE usu_correo = '$cliente_actual' ORDER BY fecha_solicitud DESC";
                $result = db_query($sql);
                ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Mueble Solicitado</th>
                                <th>Detalles</th>
                                <th class="text-center">Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_object($result)) {
                                $fecha = date("d/m/Y", strtotime($row->fecha_solicitud));
                        ?>
                            <tr>
                                <td class="fw-bold text-secondary">#<?php echo str_pad($row->id_cotizacion, 4, "0", STR_PAD_LEFT); ?></td>
                                
                                <td><?php echo $fecha; ?></td>
                                
                                <td>
                                    <span class="fw-bold text-primary"><?php echo $row->tipo_mueble; ?></span><br>
                                    <small class="text-muted">Acabado: <?php echo $row->acabado_resina; ?></small>
                                </td>

                                <td>
                                    <small><strong>Medidas:</strong> <?php echo $row->medidas; ?></small>
                                    <?php if(!empty($row->detalles_extra)) { ?>
                                        <br>
                                        <span class="d-inline-block text-truncate" style="max-width: 150px; font-size: 0.85em; color: #666;">
                                            Note: <?php echo $row->detalles_extra; ?>
                                        </span>
                                    <?php } ?>
                                </td>

                                <td class="text-center">
                                    <a href="adm_cotizacion_pdf.php?id=<?php echo $row->id_cotizacion; ?>" target="_blank" class="btn btn-outline-secondary btn-sm" title="Descargar Comprobante">
                                        <i class="bi bi-file-earmark-arrow-down"></i> PDF
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            // DISEÑO DE ESTADO VACÍO (EMPTY STATE)
                            echo "<tr><td colspan='6' class='text-center py-5'>";
                            echo "<i class='bi bi-cart-x display-1 text-muted mb-3'></i>";
                            echo "<h4 class='text-muted'>Aún no has realizado ninguna cotización.</h4>";
                            echo "<a href='cli_cotizar.php' class='btn btn-primary mt-3'>¡Pide tu primer mueble aquí!</a>";
                            echo "</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <?php include("php/footer.php"); ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>