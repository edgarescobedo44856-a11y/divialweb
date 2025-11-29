<?php 
session_start();
// 1. Validar sesión ESPECÍFICA de Gerente
if(!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'gerente' ){
    header('Location: login.php'); 
    exit();
}

include("php/conexion.php");

// --- CONSULTAS PARA LOS INDICADORES (KPIs) ---

// 1. Total de Productos
$res_prod = select("productos");
$total_productos = mysqli_num_rows($res_prod);

// 2. Total de Cotizaciones
$res_coti = select("pedidos");
$total_cotizaciones = mysqli_num_rows($res_coti);

// 3. Usuarios (Clientes)
$res_users = select_where("usuarios", "tipo = 'cliente'");
$total_clientes = mysqli_num_rows($res_users);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cortadores - VIDRERIA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/ger_menu.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="d-flex" id="wrapper">

    <?php include 'php/ger_menu.php'; ?>

    <div id="page-content-wrapper">

        

        <div class="container-fluid px-4 py-4">
            
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-light">Pedidos pendientes</h2>
                    <p class="text-muted">Bienvenido, Cortador <strong class="text-primary"><?php echo $_SESSION['usuario']; ?></strong>.</p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                
                <div class="col-xl-4 col-md-6">
                    <div class="card card-dashboard border-left-primary shadow h-100 py-2 border-0 border-start border-4 border-primary">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cotizaciones Totales</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_cotizaciones; ?></div>
                                </div>
                                <div class="col-auto"><i class="bi bi-receipt fa-2x text-gray-300 fs-1 opacity-25"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-dashboard border-left-success shadow h-100 py-2 border-0 border-start border-4 border-success">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Productos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_productos; ?></div>
                                </div>
                                <div class="col-auto"><i class="bi bi-box-seam fa-2x text-gray-300 fs-1 opacity-25"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-dashboard border-left-info shadow h-100 py-2 border-0 border-start border-4 border-info">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Clientes Registrados</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_clientes; ?></div>
                                </div>
                                <div class="col-auto"><i class="bi bi-people fa-2x text-gray-300 fs-1 opacity-25"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Pedidos Actuales</h6>
                            <a href="ger_cotizaciones.php" class="btn btn-sm btn-primary">Ver todas</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>pedido</th>
                                            <th>Cliente</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // Traemos las últimas 5 cotizaciones
                                        $sql_last = "SELECT * FROM pedidos ORDER BY fecha_pedido DESC LIMIT 5";
                                        $res_last = db_query($sql_last);
                                        
                                        if(mysqli_num_rows($res_last) > 0){
                                            while($row = mysqli_fetch_object($res_last)){
                                        ?>
                                            <tr>
                                                <td>#<?php echo $row->id_cotizacion; ?></td>
                                                <td><?php echo date("d/m", strtotime($row->fecha_solicitud)); ?></td>
                                                <td><?php echo $row->tipo_mueble; ?></td>
                                                <td><span class="text-muted small"><?php echo $row->usu_correo; ?></span></td>
                                            </tr>
                                        <?php 
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' class='text-center p-3'>Sin movimientos recientes</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>