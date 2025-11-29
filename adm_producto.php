<?php 
session_start();
// Validamos sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])){
    header('Location: login.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - DIVIAL</title>
     <?php include("php/conexion.php"); ?>
    
    <style>
        /* Estilo específico para las miniaturas de productos */
        .img-thumbnail-producto {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    

    
   
</head>
<body>

    <<div>

        <?php include 'php/admin_menu.php'; ?>

        <div id="page-content-wrapper">

            <div class="container-fluid px-4 py-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">Inventario de Productos</h2>
                    <a href="adm_producto_registrar.php" class="btn btn-success">
                        <i class="bi bi-plus-lg"></i> Nuevo Producto
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i><span class="lang-es">Lista de Productos</span><span class="lang-en d-none">Products List</span></h5>
                    </div>

                    <div class="card-body">
                        
                        <?php
                        // Seleccionamos todos los productos
                        $result = select("productos");
                        ?>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%"><span class="lang-es">Foto</span><span class="lang-en d-none">Photo</span></th>
                                        <th><span class="lang-es">Nombre</span><span class="lang-en d-none">Name</span></th>
                                        <th><span class="lang-es">Tipo</span><span class="lang-en d-none">Type</span></th>
                                        <th><span class="lang-es">Precio</span><span class="lang-en d-none">Price</span></th>
                                        <th><span class="lang-es">Stock</span><span class="lang-en d-none">Stock</span></th>
                                        <th class="text-center"><span class="lang-es">Acciones</span><span class="lang-en d-none">Actions</span></th>
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
                                                // Verificamos si existe la imagen física
                                                $imagen_mostrar = (file_exists($ruta_foto) && $row->prod_foto != "") ? $ruta_foto : "img/no-photo.png";
                                            ?>
                                            <img src="<?php echo $imagen_mostrar; ?>" class="img-thumbnail-producto" alt="Mueble">
                                        </td>

                                        <td class="fw-bold"><?php echo $row->prod_nombre; ?></td>
                                        
                                        <td><span class="badge bg-secondary"><?php echo $row->prod_tipo; ?></span></td>
                                        
                                        <td class="text-success fw-bold">$<?php echo number_format($row->precio, 2); ?></td>
                                        
                                        <td>
                                            <?php if($row->cantidad > 5) { ?>
                                                <span class="badge bg-success rounded-pill"><?php echo $row->cantidad; ?> pzs</span>
                                            <?php } elseif($row->cantidad > 0) { ?>
                                                <span class="badge bg-warning text-dark rounded-pill"><?php echo $row->cantidad; ?> pzs</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger rounded-pill">Agotado</span>
                                            <?php } ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="adm_producto_modificar.php?id=<?php echo $row->id_producto; ?>" class="btn btn-warning btn-sm text-dark" title="Editar">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="adm_producto_eliminar.php?id=<?php echo $row->id_producto; ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto? La imagen también será borrada.');" class="btn btn-danger btn-sm" title="Borrar">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center py-5 text-muted'><h4><i class='bi bi-inbox'></i></h4> No hay productos registrados</td></tr>";
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
        // Busca todos los enlaces del sidebar
        const links = document.querySelectorAll('#sidebar-wrapper .list-group-item');
        links.forEach(link => {
            // Si el enlace contiene "adm_producto", le ponemos la clase active
            if(link.href.includes("adm_producto")) {
                // Quitamos active de los demás
                links.forEach(l => l.classList.remove('active'));
                // Ponemos active a este
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>