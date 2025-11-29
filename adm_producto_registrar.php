<?php session_start();
if(!isset($_SESSION['usuario'])){ header('Location: login.php'); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adm_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
</head>
<body>
    
    <div >
        <?php include 'php/admin_menu.php'; ?>
        
        <div id="page-content-wrapper">
           

            <div class="container-fluid px-4 py-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="m-0"> <span class="lang-es">Registrar Nuevo Producto</span><span class="lang-en d-none">Register New Product</span></h3>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="adm_producto_guardar.php" enctype="multipart/form-data" onsubmit="return validarProducto(this);">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"><span class="lang-es">Nombre del producto</span><span class="lang-en d-none">Product Name</span></label>
                                    <input type="text" class="form-control" name="txt_nombre" id="txt_nombre">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"><span class="lang-es">Tipo</span><span class="lang-en d-none">Type</span></label>
                                    <select class="form-select" name="lst_tipo" id="lst_tipo">
                                        <option value="">Seleccione...</option>
                                        <option>Aluminio</option>
                                        <option>Herrajes</option>
                                        <option>Lunas</option>
                                        <option>Vidrios</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"><span class="lang-es">Precio ($)</span><span class="lang-en d-none">Price ($)</span></label>
                                    <input type="number" step="0.01" class="form-control" name="num_precio" id="num_precio">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label"><span class="lang-es">Medidas</span><span class="lang-en d-none">Measures</span></label>
                                    <input type="text" class="form-control" name="txt_medidas" placeholder="ej: 2m x 1m">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"><span class="lang-es">Cantidad</span><span class="lang-en d-none">Stock</span></label>
                                    <input type="number" class="form-control" name="num_cantidad" id="num_cantidad" value="1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><span class="lang-es">Foto del producto</span><span class="lang-en d-none">Product's Photo</span></label>
                                    <input type="file" class="form-control" name="foto_producto" id="foto_producto" accept="image/*">
                                </div>

                                <div class="col-12">
                                    <label class="form-label"><span class="lang-es">Descripcion</span><span class="lang-en d-none">Description</span></label>
                                    <textarea class="form-control" name="txt_descripcion" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-lg"><span class="lang-es">Guardar producto</span><span class="lang-en d-none">Save Product</span></button>
                                <a href="adm_producto.php" class="btn btn-secondary btn-lg"><span class="lang-es">Cancelar</span><span class="lang-en d-none">Cancel</span></a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="js/validar_producto.js"></script>

</body>
</html>