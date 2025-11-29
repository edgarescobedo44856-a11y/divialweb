<?php 
session_start();
include("php/conexion.php");

// 1. RECIBIR DATOS
$correo   = $_POST['usu_correo'];
$telefono = $_POST['telefono'];
$tipo     = $_POST['tipo_mueble'];
$acabado  = $_POST['acabado_resina'];
$medidas  = $_POST['medidas'];
$detalles = $_POST['detalles_extra'];
$fecha    = date("Y-m-d H:i"); // Fecha actual para mostrar

// 2. GUARDAR EN BASE DE DATOS
// Nota: No pasamos 'id_cotizacion' porque es AUTO_INCREMENT
$sql = "INSERT INTO cotizaciones 
        (usu_correo, telefono, tipo_mueble, acabado_resina, medidas, detalles_extra) 
        VALUES 
        ('$correo', '$telefono', '$tipo', '$acabado', '$medidas', '$detalles')";

// Ejecutamos con tu función
$resultado = db_query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Cotización</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para que parezca una hoja de papel */
        .hoja-pedido {
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 40px;
            position: relative;
        }
        .hoja-header {
            border-bottom: 2px solid #333;
            margin-bottom: 30px;
            padding-bottom: 20px;
        }
        .dato-label {
            font-weight: bold;
            color: #555;
            font-size: 0.9rem;
        }
        .dato-valor {
            font-size: 1.1rem;
            margin-bottom: 15px;
            border-bottom: 1px dotted #ccc;
            padding-bottom: 5px;
        }
        .status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2rem;
            border: 2px solid #198754;
            color: #198754;
            padding: 5px 15px;
            transform: rotate(-10deg);
            border-radius: 5px;
            font-weight: bold;
            opacity: 0.8;
        }
    </style>
</head>
<body class="bg-light">

    <?php include 'php/adm_navbar.php'; ?>

    <div class="container my-5">
        
        <?php if($resultado) { ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="alert alert-success text-center mb-4">
                <span class="lang-es">¡Tu solicitud ha sido guardada correctamente!</span>
                <span class="lang-en d-none">Your request has been saved successfully!</span>
            </div>

            <div class="hoja-pedido">
                <div class="status-badge">
                    <span class="lang-es">SOLICITUD ENVIADA</span>
                    <span class="lang-en d-none">REQUEST SENT</span>
                </div>
                
                <div class="hoja-header d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="h3 fw-bold text-dark">Mueblería Residencial</h1>
                        <p class="mb-0 text-muted">
                            <span class="lang-es">Comprobante de Solicitud de Cotización</span>
                            <span class="lang-en d-none">Quote Request Receipt</span>
                        </p>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">
                            <span class="lang-es">Fecha</span>
                            <span class="lang-en d-none">Date</span>
                        </small><br>
                        <strong><?php echo $fecha; ?></strong>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="dato-label">
                            <span class="lang-es">CLIENTE / EMAIL</span>
                            <span class="lang-en d-none">CLIENT / EMAIL</span>
                        </div>
                        <div class="dato-valor"><?php echo $correo; ?></div>

                        <div class="dato-label">
                            <span class="lang-es">TELÉFONO</span>
                            <span class="lang-en d-none">PHONE</span>
                        </div>
                        <div class="dato-valor"><?php echo $telefono; ?></div>

                        <div class="dato-label">
                            <span class="lang-es">TIPO DE MUEBLE</span>
                            <span class="lang-en d-none">FURNITURE TYPE</span>
                        </div>
                        <div class="dato-valor"><?php echo $tipo; ?></div>
                    </div>

                    <div class="col-md-6">
                        <div class="dato-label">
                            <span class="lang-es">ACABADO / RESINA</span>
                            <span class="lang-en d-none">FINISH / RESIN</span>
                        </div>
                        <div class="dato-valor"><?php echo $acabado; ?></div>

                        <div class="dato-label">
                            <span class="lang-es">MEDIDAS SOLICITADAS</span>
                            <span class="lang-en d-none">REQUESTED DIMENSIONS</span>
                        </div>
                        <div class="dato-valor"><?php echo $medidas; ?></div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="dato-label">
                        <span class="lang-es">DETALLES ADICIONALES</span>
                        <span class="lang-en d-none">ADDITIONAL DETAILS</span>
                    </div>
                    <div class="p-3 bg-light border rounded mt-2">
                        <?php echo empty($detalles) ? "<em>Sin detalles / No details</em>" : $detalles; ?>
                    </div>
                </div>

                <div class="mt-5 text-center text-muted small">
                    <p>
                        <span class="lang-es">Nos pondremos en contacto contigo a la brevedad para darte el precio final.<br>Guarda este comprobante para cualquier aclaración.</span>
                        <span class="lang-en d-none">We will contact you shortly to provide the final price.<br>Please keep this receipt for any inquiries.</span>
                    </p>
                </div>

            </div> 
            
            <div class="d-flex justify-content-center gap-3 mt-4">
                <button onclick="window.print()" class="btn btn-dark btn-lg">
                    <span class="lang-es">🖨️ Imprimir / Guardar PDF</span>
                    <span class="lang-en d-none">🖨️ Print / Save PDF</span>
                </button>
                <a href="cli_index.php" class="btn btn-primary btn-lg">
                    <span class="lang-es">Volver al Inicio</span>
                    <span class="lang-en d-none">Back to Home</span>
                </a>
            </div>

        </div>
    </div>

<?php } else { ?>
    <div class="alert alert-danger text-center">
        <h3>
            <span class="lang-es">Error al guardar</span>
            <span class="lang-en d-none">Error saving</span>
        </h3>
        <p>
            <span class="lang-es">Ocurrió un problema al procesar tu solicitud. Por favor intenta de nuevo.</span>
            <span class="lang-en d-none">There was a problem processing your request. Please try again.</span>
        </p>
        <a href="cli_cotizar.php" class="btn btn-secondary">
            <span class="lang-es">Regresar</span>
            <span class="lang-en d-none">Go Back</span>
        </a>
    </div>
<?php } ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>