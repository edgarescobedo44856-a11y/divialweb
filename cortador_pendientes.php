<?php 
session_start();
// 1. Validación estricta de Gerente
if(!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'gerente'){
    header('Location: login.php'); 
    exit();
}
include("php/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Supervisión  - pedidos</title>
    
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/ger_menu.css">
    <style>
        .img-thumbnail-producto {
            width: 50px; height: 50px; object-fit: cover; border-radius: 6px;
        }
    </style>
</head>
<body>

     <div class="d-flex" id="wrapper">

        <?php include 'php/ger_menu.php'; ?>

        <div id="page-content-wrapper">
            <?php include 'php/ger_navbar_top.php'; ?>

            <div class="container-fluid px-4 py-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">Supervisión de Inventario</h2>
                    <a href="cortador_producto_registrar.php" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Ingresar Mercancía
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-clipboard-check me-2"></i>Existencias Actuales</h5>
                    </div>

                    <div class="card-body">
                        
                        <?php $result = select("productos"); ?>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_object($result)) {
                                ?>
                                    <tr>
                                        <td><small class="text-muted">#<?php echo $row->id_producto; ?></small></td>
                                        
                                        <td>
                                            <?php 
                                                $ruta_foto = "img/productos/" . $row->prod_foto; 
                                                $imagen_mostrar = (file_exists($ruta_foto) && $row->prod_foto != "") ? $ruta_foto : "img/no-photo.png";
                                            ?>
                                            <img src="<?php echo $imagen_mostrar; ?>" class="img-thumbnail-producto">
                                        </td>

                                        <td class="fw-bold"><?php echo $row->nombre; ?></td>
                                        <td><span class="badge bg-secondary"><?php echo $row->tipo_mueble; ?></span></td>
                                        <td class="text-success fw-bold">$<?php echo number_format($row->precio, 2); ?></td>
                                        
                                        <td>
                                            <?php if($row->cantidad <= 3) { ?>
                                                <span class="badge bg-danger rounded-pill">¡Bajo! (<?php echo $row->cantidad; ?>)</span>
                                            <?php } else { ?>
                                                <span class="badge bg-success rounded-pill"><?php echo $row->cantidad; ?> pzs</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center py-4'>No hay productos registrados</td></tr>";
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
</body>
</html>