<?php session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'gerente'){ 
    header('Location: login.php'); exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>verificar Producto - pedios</title>
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
                    <h2 class="text-dark mb-0">Alta de Mercancía</h2>
                    <a href="ger_inventario.php" class="btn btn-outline-secondary btn-sm">Volver</a>
                </div>

                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="m-0">Registrar Nuevo pedido</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <form method="post" action="ger_producto_guardar.php" enctype="multipart/form-data" onsubmit="return validarProducto(this);">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nombre del Producto</label>
                                    <input type="text" class="form-control" name="txt_nombre" id="txt_nombre">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Tipo</label>
                                    <select class="form-select" name="lst_tipo" id="lst_tipo">
                                        <option value="">Seleccione...</option>
                                        <option>Aluminio</option>
                                        <option>Herraje</option>
                                        <option>Espejos</option>
                                        <option>Vidrios</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Precio ($)</label>
                                    <input type="number" step="0.01" class="form-control" name="num_precio" id="num_precio">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Medidas</label>
                                    <input type="text" class="form-control" name="txt_medidas" placeholder="ej: 2m x 1m">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold">Cantidad</label>
                                    <input type="number" class="form-control" name="num_cantidad" id="num_cantidad" value="1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Foto</label>
                                    <input type="file" class="form-control" name="foto_producto" id="foto_producto" accept="image/*">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Descripción</label>
                                    <textarea class="form-control" name="txt_descripcion" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <a href="ger_inventario.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary px-4">Guardar en Inventario</button>
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