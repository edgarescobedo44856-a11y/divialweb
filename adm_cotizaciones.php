<?php 
session_start();
// 1. Seguridad: Solo admin entra
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])){
    header('Location: login.php'); 
    exit();
}
include("php/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - Admin</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div class="d-flex" id="wrapper">

        <?php include 'php/admin_menu.php'; ?>

        <div id="page-content-wrapper">

            

            <div class="container-fluid px-4 py-4">

                <h2 class="mb-4 text-dark">
                    <span class="lang-es">Gestión de Pedidos</span>
            <span class="lang-en d-none">Order management</span></h2>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-clipboard-data me-2"></i>
                        <span class="lang-es">Listado de Solicitudes</span><span class="lang-en d-none">Requests</span></h5>
                    </div>
                    <div class="card-body">
                        
                        <?php
                        // ---------------------------------------------------------
                        // CONSULTA SQL CORREGIDA
                        // ---------------------------------------------------------
                        
                        $sql = "SELECT 
                                p.id_pedido,
                                p.telefono,
                                p.tipo_material,
                                p.terminado,
                                p.medidas,
                                p.detalles_pedido,
                                p.fecha_pedido, 
                                u.usu_nombre,
                                u.usu_ap_pat,
                                u.usu_ap_mat,
                                u.usu_correo
                            FROM pedidos p
                            INNER JOIN usuarios u ON p.usu_correo = u.usu_correo 
                            ORDER BY p.fecha_pedido DESC"; 

                        // Usamos tu función db_query 
                        $result = db_query($sql); 
                        ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th><span class="lang-es">Fecha</span><span class="lang-en d-none">Fate</span></th>
                                        <th><span class="lang-es">Cliente</span><span class="lang-en d-none">Customer</span></th>
                                        <th><span class="lang-es">Contacto</span><span class="lang-en d-none">Contact</span></th>
                                        <th><span class="lang-es">Productos Solicitados</span><span class="lang-en d-none">Requested Products</span></th>
                                        <th><span class="lang-es">Detalles</span><span class="lang-en d-none">Details</span></th>
                                        <th class="text-center"><span class="lang-es">Acciones</span><span class="lang-en d-none">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_object($result)) {
                                        // Formatear nombre completo
                                        $nombre_completo = $row->usu_nombre . " " . $row->usu_ap_pat;
                                        // Formatear fecha
                                        $fecha = date("d/m/Y H:i", strtotime($row->fecha_pedido)); // USANDO fecha_pedido
                                ?>
                                    <tr>
                                        <td><strong>#<?php echo $row->id_pedido; ?></strong></td>
                                        
                                        <td><small class="text-muted"><?php echo $fecha; ?></small></td>
                                        
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold"><?php echo $nombre_completo; ?></span>
                                                <span class="text-muted small"><?php echo $row->usu_correo; ?></span>
                                            </div>
                                        </td>

                                        <td><?php echo $row->telefono; ?></td>

                                        <td>
                                            <span class="badge bg-info text-dark mb-1"><?php echo $row->tipo_material; ?></span><br>
                                            <small><strong><span class="lang-es">Medidas:</span><span class="lang-en d-none">Measures:</span></strong> <?php echo $row->medidas; ?></small><br>
                                            <small><strong><span class="lang-es">terminado:</span><span class="lang-en d-none">Over:</span></strong> <?php echo $row->terminado; ?></small>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                     data-bs-toggle="popover" title="Detalles Extra" 
                                                     data-bs-content="<?php echo $row->detalles_pedido; ?>">
                                                <span class="lang-es">Ver notas</span><span class="lang-en d-none">See notes</span>
                                            </button>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="adm_cotizacion_pdf.php?id=<?php echo $row->id_pedido; ?>" target="_blank" class="btn btn-primary btn-sm" title="Ver PDF">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                </a>
                                                
                                                <a href="adm_cotizacion_eliminar.php?id=<?php echo $row->id_pedido; ?>" 
                                                   onclick="return confirm('¿Borrar esta cotización?');" 
                                                   class="btn btn-danger btn-sm" title="Eliminar">
                                                     <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center py-4'>No hay cotizaciones registradas.</td></tr>";
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
        // Script para activar los popovers de Bootstrap (para ver los detalles)
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>