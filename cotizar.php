<?php
session_start();
include('php/conexion.php');

// 1. SEGURIDAD: Verificar si el usuario está logueado
// NOTA: Asegúrate de que en tu Login estés guardando el correo en una variable de sesión.
// Si en tu login usas $_SESSION['usuario'] para el nombre, necesitamos el correo.
// Aquí asumo que $_SESSION['email_cliente'] contiene el correo. 
// Si no lo tienes así, cambia 'email_cliente' por la variable donde guardes el email (ej: $_SESSION['usuario'] si ahí guardas el correo).

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Vamos a obtener el correo. 
// SI TU LOGIN GUARDA EL NOMBRE EN 'usuario', NECESITAMOS BUSCAR EL CORREO O GUARDARLO DESDE EL LOGIN.
// Para este ejemplo, voy a asumir que necesitamos buscar los datos del usuario basándonos en su sesión actual.
$usuario_actual = $_SESSION['usuario']; 

// Consultamos los datos del usuario para pre-llenar el formulario
// OJO: Si tu tabla usuarios tiene 'usu_correo' como PK, ajusta esta consulta según qué guardaste en la sesión.
// Voy a asumir que en $_SESSION['usuario'] guardaste el CORREO. Si guardaste el Nombre, avísame.
$sql_datos = "SELECT * FROM usuarios WHERE usu_correo = '$usuario_actual' OR usu_nombre = '$usuario_actual' LIMIT 1";
$query_datos = mysqli_query($conexion, $sql_datos);
$datos_user = mysqli_fetch_array($query_datos);

// Si no encontramos al usuario, algo anda mal
if (!$datos_user) {
    echo "<script>alert('Error al identificar al usuario.'); window.location='login.php';</script>";
    exit();
}

$correo_cliente = $datos_user['usu_correo']; // Este es el dato CLAVE para la base de datos
$nombre_cliente = $datos_user['usu_nombre'] . " " . $datos_user['usu_ap_pat'];

// 2. PROCESAR EL FORMULARIO (GUARDAR DATOS)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $telefono       = $_POST['telefono'];
    $tipo_mueble    = $_POST['tipo_mueble'];
    $acabado        = $_POST['acabado_resina'];
    $medidas        = $_POST['medidas'];
    $detalles       = $_POST['detalles_extra'];

    // Sentencia SQL para insertar (según la tabla que creamos)
    $sql_insert = "INSERT INTO cotizaciones 
                   (usu_correo, telefono, tipo_mueble, acabado_resina, medidas, detalles_extra) 
                   VALUES 
                   ('$correo_cliente', '$telefono', '$tipo_mueble', '$acabado', '$medidas', '$detalles')";

    if (mysqli_query($conexion, $sql_insert)) {
        echo "<script>
                alert('¡Cotización enviada con éxito! Nos pondremos en contacto contigo.');
                window.location = 'cli_index.php'; 
              </script>";
    } else {
        echo "<script>alert('Error al guardar: " . mysqli_error($conexion) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Cotización - Mueblería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .card-cotizacion { border: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .header-form { background: linear-gradient(45deg, #A0522D, #8B4513); color: white; border-radius: 15px 15px 0 0; padding: 20px; }
    </style>
</head>
<body>

    <?php include('php/adm_navbar.php'); // O cli_navbar.php si tienes uno para clientes ?>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card card-cotizacion">
                    <div class="header-form text-center">
                        <h2>🛠️ Diseña tu Mueble Ideal</h2>
                        <p class="mb-0">Completa el formulario y te enviaremos un presupuesto personalizado.</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            
                            <h5 class="mb-3 text-muted">👤 Tus Datos</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control bg-light" value="<?php echo $nombre_cliente; ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo (ID de Usuario)</label>
                                    <input type="text" class="form-control bg-light" value="<?php echo $correo_cliente; ?>" readonly>
                                    <small class="text-muted">Este correo se usará para asociar tu pedido.</small>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="telefono" class="form-label">Teléfono de Contacto <span class="text-danger">*</span></label>
                                <input type="tel" name="telefono" class="form-control" required placeholder="(123) 456-7890">
                            </div>

                            <hr>

                            <h5 class="mb-3 text-muted">🪑 Detalles del Mueble</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tipo de Mueble <span class="text-danger">*</span></label>
                                    <select name="tipo_mueble" class="form-select" required>
                                        <option value="" selected disabled>Selecciona una opción...</option>
                                        <option value="Comedor Parota">Comedor de Parota</option>
                                        <option value="Mesa de Centro">Mesa de Centro</option>
                                        <option value="Credenza">Credenza / Consola</option>
                                        <option value="Escritorio">Escritorio</option>
                                        <option value="Otro">Otro (Especificar en detalles)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Acabado de Resina</label>
                                    <select name="acabado_resina" class="form-select">
                                        <option value="Sin Resina">Sin Resina (Solo madera)</option>
                                        <option value="Rio Azul">Río Azul</option>
                                        <option value="Negro Epoxico">Negro Epóxico</option>
                                        <option value="Transparente">Transparente (Cristal)</option>
                                        <option value="Humo">Humo / Gris</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Medidas Aproximadas</label>
                                <input type="text" name="medidas" class="form-control" placeholder="Ej: 2.5m de largo x 1.1m de ancho">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Detalles Extra o Comentarios</label>
                                <textarea name="detalles_extra" class="form-control" rows="4" placeholder="Describe cualquier detalle especial, tipo de patas, bordes, etc."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" style="background-color: #A0522D; border:none;">
                                    Enviar Solicitud de Cotización
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <?php include("php/footer.php"); ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>