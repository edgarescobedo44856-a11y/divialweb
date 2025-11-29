<?php 
session_start();
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])){ 
    header('Location: login.php'); 
    exit(); 
}
include("php/conexion.php");

// Validamos que venga el ID
if(!isset($_GET['id'])){
    header('Location: adm_producto.php');
    exit();
}

// **IMPORTANTE**: Sanear el ID para mayor seguridad, aunque el uso es select_where.
// Asumiendo que $conexion está disponible globalmente desde php/conexion.php
global $conexion;
$id = mysqli_real_escape_string($conexion, $_GET['id']); 

$res = select_where("productos", "id_producto = '$id'"); 
// Nota: Es mejor que select_where use Sentencias Preparadas, pero por ahora se mantiene la sintaxis.
$row = mysqli_fetch_object($res);

// Si no existe el producto, regresar
if(!$row){
    header('Location: adm_producto.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div>

    

        <div id="page-content-wrapper">

            <?php include 'php/admin_menu.php'; ?>

            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0"><span class="lang-es">Editar Inventario</span><span class="lang-en d-none">Edit stock</span></h2>
                    <a href="adm_producto.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> <span class="lang-es">Regresar</span><span class="lang-en d-none">Back</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="m-0"><i class="bi bi-pencil-square me-2"></i><span class="lang-es">Editando: </span><span class="lang-en d-none">Editing: </span><strong><?php echo $row->prod_nombre; ?></strong></h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <form method="post" action="adm_producto_actualizar.php" enctype="multipart/form-data">
                            
                            <input type="hidden" name="id_producto" value="<?php echo $row->id_producto; ?>">
                            <input type="hidden" name="foto_vieja" value="<?php echo $row->prod_foto; ?>">

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold"><span class="lang-es">Nombre del Producto</span><span class="lang-en d-none">Product Name</span></label>
                                            <input type="text" class="form-control" name="txt_nombre" value="<?php echo $row->prod_nombre; ?>" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold"><span class="lang-es">Precio ($)</span><span class="lang-en d-none">Price ($)</span></label>
                                            <input type="number" step="0.01" class="form-control" name="num_precio" value="<?php echo $row->precio; ?>" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold"><span class="lang-es">Cantidad</span><span class="lang-en d-none">Stock</span></label>
                                            <input type="number" class="form-control" name="num_cantidad" value="<?php echo $row->cantidad; ?>">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold"><span class="lang-es">Descripción</span><span class="lang-en d-none">Description</span></label>
                                            <textarea class="form-control" name="txt_descripcion" rows="4"><?php echo $row->descripcion; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-light border-0">
                                        <div class="card-body text-center">
                                            <label class="form-label fw-bold mb-3"><span class="lang-es">Imagen actual</span><span class="lang-en d-none">Current Image</span></label>
                                            <div class="mb-3">
                                                <?php 
                                                    $ruta_img = "img/productos/" . $row->prod_foto;
                                                    $mostrar_img = (file_exists($ruta_img) && $row->prod_foto != "") ? $ruta_img : "img/no-photo.png";
                                                ?>
                                                <img src="<?php echo $mostrar_img; ?>" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                            </div>
                                            
                                            <label class="form-label text-muted small"><span class="lang-es">Cambiar imagen (Opcional)</span><span class="lang-en d-none">Change Image (Optional)</span></label>
                                            <input type="file" class="form-control form-control-sm" name="foto_nueva" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="adm_producto.php" class="btn btn-secondary"><span class="lang-es">Cancelar</span><span class="lang-en d-none">Cancel</span></a>
                                <button type="submit" class="btn btn-warning px-4 fw-bold"><span class="lang-es">Actualizar Cambios</span><span class="lang-en d-none">Update</span></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>