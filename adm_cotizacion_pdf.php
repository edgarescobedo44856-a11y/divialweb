<?php
session_start();
if(!isset($_SESSION['usuario'])){ header('Location: login.php'); exit(); }
include("php/conexion.php");

if(!isset($_GET['id'])){ header('Location: adm_cotizaciones.php'); exit(); }

$id = $_GET['id'];

// Consulta JOIN para obtener todos los detalles para el reporte
$sql = "SELECT 
            p.*, 
            u.usu_nombre, u.usu_ap_pat, u.usu_ap_mat, u.usu_correo,
            d.dom_calle, d.dom_colonia, d.dom_ciudad, d.dom_estado, d.dom_cp
        FROM pedidos
        INNER JOIN usuarios u ON p.usu_correo = u.usu_correo
        LEFT JOIN domicilios d ON p.usu_correo = d.usu_correo
        WHERE p.id_cotizacion = $id";

$res = db_query($sql);
$row = mysqli_fetch_object($res);

// Si no existe
if(!$row){ echo "Cotización no encontrada."; exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido #<?php echo $row->id_pedido; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #555; padding: 30px 0; }
        .hoja-carta {
            background: white;
            width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            padding: 2cm;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            position: relative;
        }
        .brand-title { color: #A0522D; font-weight: bold; font-size: 24px; }
        .table-bordered th, .table-bordered td { border-color: #ddd !important; }
        .bg-custom { background-color: #f8f9fa; }
        
        /* Estilos solo para impresión */
        @media print {
            body { background: white; padding: 0; }
            .hoja-carta { box-shadow: none; width: 100%; margin: 0; padding: 20px; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="container mb-4 text-center no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg shadow"> Imprimir / Guardar PDF</button>
    </div>

    <div class="hoja-carta">
        
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-3">
            <div>
                
                <div class="brand-title"><img src="img/logo.jpeg" alt="logo" style="width:120px;">MUEBLERÍA RESIDENCIAL</div>
                <small class="text-muted">Orden de Producción / Cotización</small>
            </div>
            <div class="text-end">
                <h3 class="m-0">Folio: #<?php echo str_pad($row->id_pedido, 4, "0", STR_PAD_LEFT); ?></h3>
                <p class="mb-0">Fecha: <?php echo date("d/m/Y", strtotime($row->fecha_pedido)); ?></p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <h6 class="fw-bold text-uppercase bg-custom p-2 border">Datos del Cliente</h6>
                <ul class="list-unstyled ps-2">
                    <li><strong>Nombre:</strong> <?php echo $row->usu_nombre." ".$row->usu_ap_pat." ".$row->usu_ap_mat; ?></li>
                    <li><strong>Email:</strong> <?php echo $row->usu_correo; ?></li>
                    <li><strong>Teléfono:</strong> <?php echo $row->telefono; ?></li>
                </ul>
            </div>
            <div class="col-6">
                <h6 class="fw-bold text-uppercase bg-custom p-2 border">Dirección de Entrega</h6>
                <ul class="list-unstyled ps-2">
                    <?php if($row->dom_calle) { ?>
                        <li><?php echo $row->dom_calle . ", " . $row->dom_colonia; ?></li>
                        <li><?php echo $row->dom_ciudad . ", " . $row->dom_estado; ?></li>
                        <li>C.P. <?php echo $row->dom_cp; ?></li>
                    <?php } else { ?>
                        <li class="text-muted text-center py-3"><em>(Sin dirección registrada)</em></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <h6 class="fw-bold text-uppercase bg-custom p-2 border mt-5">Detalle del Mueble</h6>
        <table class="table table-bordered mb-4">
            <thead class="table-light">
                <tr>
                    <th>Concepto</th>
                    <th>Especificación</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="30%" class="fw-bold">Tipo de Material</td>
                    <td><?php echo $row->tipo_material; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">Terminado</td>
                    <td><?php echo $row->Terminado; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">Medidas Solicitadas</td>
                    <td><?php echo $row->medidas; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">Detalles</td>
                    <td><?php echo empty($row->detalles_pedido) ? "Ninguno" : nl2br($row->detalles_pedido); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-5 pt-5">
            <div class="col-6 text-center">
                <div style="border-top: 1px solid #000; width: 80%; margin: 0 auto;"></div>
                <p class="mt-2">Firma del Cliente</p>
            </div>
            <div class="col-6 text-center">
                <div style="border-top: 1px solid #000; width: 80%; margin: 0 auto;"></div>
                <p class="mt-2">Autorización de Ventas</p>
            </div>
        </div>

        <div class="text-center mt-auto pt-5 text-muted small">
            <p>Este documento pertenece a la administracion interna de Divial.</p>
        </div>

    </div>

</body>
</html>