<?php 
session_start();
// 1. Validación estricta: Solo Gerente
if(!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'gerente' ){
    header('Location: login.php'); 
    exit();
}
include("php/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/ger_menu.css">
</head>
<body>

    <div class="d-flex" id="wrapper">

        <?php include 'php/ger_menu.php'; ?>

        <div id="page-content-wrapper">



            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">Panel de Pedidos</h2>
                    <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="bi bi-printer"></i> Imprimir Nota
                    </button>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Pedidos Pendientes</h5>
                    </div>
                    <div class="card-body">
                        
                        <?php
                        // CONSULTA JOIN: Unimos cotizaciones con usuarios para ver nombres y correos
                        $sql = "SELECT 
                                p.id_pedido,
                                p.telefono,
                                p.tipo_material,
                                p.terminado,
                                p.medidas,
                                p.detalles_pedido,
                                p.fecha_pedido, /* Usamos fecha_pedido */
                                u.usu_nombre,
                                u.usu_ap_pat,
                                u.usu_ap_mat,
                                u.usu_correo
                            FROM pedidos p
                            INNER JOIN usuarios u ON p.usu_correo = u.usu_correo /* Join a la tabla usuarios (u) */
                            ORDER BY p.fecha_pedido DESC"; 

                        $result = db_query($sql); 
                        ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Folio</th>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>detalles_pedido</th>
                                        <th>Contacto</th>
                                        <th class="text-center">extras</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_object($result)) {
                                        $nombre_completo = $row->usu_nombre . " " . $row->usu_ap_pat;
                                        $fecha = date("d/M/Y", strtotime($row->fecha_pedido));
                                ?>
                                    <tr>
                                        <td class="fw-bold text-primary">#<?php echo str_pad($row->id_pedido, 4, "0", STR_PAD_LEFT); ?></td>
                                        
                                        <td><small><?php echo $fecha; ?></small></td>
                                        
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold"><?php echo $nombre_completo; ?></span>
                                                <span class="text-muted small"><i class="bi bi-envelope-at"></i> <?php echo $row->usu_correo; ?></span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge bg-primary mb-1"><?php echo $row->tipo_material; ?></span>
                                            <div class="small text-muted">
                                                terminado: <?php echo $row->acabado_resina; ?><br>
                                                Medidas: <?php echo $row->medidas; ?>
                                            </div>
                                            <?php if(!empty($row->detalles_pedido)){ ?>
                                                <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none" 
                                                        data-bs-toggle="popover" title="Notas del Cliente" 
                                                        data-bs-content="<?php echo $row->detalles_pedido; ?>">
                                                    <i class="bi bi-info-circle"></i> Ver notas
                                                </button>
                                            <?php } ?>
                                        </td>

                                        <td><?php echo $row->telefono; ?></td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="adm_cotizacion_pdf.php?id=<?php echo $row->id_producto; ?>" target="_blank" class="btn btn-primary btn-sm" title="Ver Orden de Trabajo">
                                                    <i class="bi bi-file-earmark-pdf"></i> PDF
                                                </a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center py-5 text-muted'>No hay pedidos pendientes.</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>