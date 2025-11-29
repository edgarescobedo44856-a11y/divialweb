<?php 
session_start();
include("php/conexion.php");

// 1. Validar sesión
if(!isset($_SESSION['usuario'])){
    header('Location: login.php'); 
    exit();
}

// 2. Obtener datos del usuario actual para pre-llenar el formulario
// Asumimos que en $_SESSION['usuario'] guardaste el nombre o el correo.
// Vamos a buscar por el correo o nombre que tengas en sesión.
$usuario_actual = $_SESSION['usuario'];

// Buscamos los datos completos en la BD
$sql_user = "SELECT * FROM usuarios WHERE usu_correo = '$usuario_actual' OR usu_nombre = '$usuario_actual'";
$res_user = db_query($sql_user);
$datos_user = mysqli_fetch_object($res_user);

// Si no encuentra datos, evitamos errores
if(!$datos_user) {
    echo "Error: No se encontraron datos del usuario.";
    exit();
}

$nombre_completo = $datos_user->usu_nombre . " " . $datos_user->usu_ap_pat . " " . $datos_user->usu_ap_mat;
$correo_cliente = $datos_user->usu_correo; // IMPORTANTE: Esta es la llave para la tabla cotizaciones
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Cotización</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php include 'php/cli_navbar.php'; // O tu navbar de cliente ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-dark text-white text-center py-3">
                        <h3 class="m-0"><span class="lang-es">Solicitar Cotización</span><span class="lang-en d-none">Request Quote</span></h3>
                    </div>
                    <div class="card-body p-4">
                        
                        <form action="cli_cotizar_guardar.php" method="POST">
    
    <h5 class="text-muted mb-3">
        <span class="lang-es">Datos del Cliente</span>
        <span class="lang-en d-none">Client Details</span>
    </h5>

    <div class="row mb-4">
        
        <div class="col-md-6">
            <label class="form-label">
                <span class="lang-es">Nombre</span>
                <span class="lang-en d-none">Name</span>
            </label>
            <input type="text" class="form-control" 
                value="<?php echo $nombre_completo; ?>" 
                readonly 
                style="background-color: #e9ecef; cursor: not-allowed; color: #6c757d;">
        </div>

        <div class="col-md-6">
            <label class="form-label">
                <span class="lang-es">Correo (ID Cliente)</span>
                <span class="lang-en d-none">Email (Client ID)</span>
            </label>
            <input type="text" class="form-control" 
                name="usu_correo" 
                value="<?php echo $correo_cliente; ?>" 
                readonly 
                style="background-color: #e9ecef; cursor: not-allowed; color: #6c757d; font-weight: bold;">
        </div>

    </div>

    <h5 class="text-muted mb-3">
        <span class="lang-es">Detalles del Mueble</span>
        <span class="lang-en d-none">Furniture Details</span>
    </h5>
    
    <div class="mb-3">
        <label class="form-label">
            <span class="lang-es">Teléfono de Contacto</span>
            <span class="lang-en d-none">Contact Phone</span> 
            <span class="text-danger">*</span>
        </label>
        <input type="text" name="telefono" class="form-control" required placeholder="Ej / Ex: 443 123 4567">
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">
                <span class="lang-es">Tipo de Mueble</span>
                <span class="lang-en d-none">Furniture Type</span> 
                <span class="text-danger">*</span>
            </label>
            <select name="tipo_mueble" class="form-select" required>
                <option value="" selected disabled>Selecciona... / Select...</option>
                <option value="Comedor">Comedor / Dining Room</option>
                <option value="Mesa de Centro">Mesa de Centro / Coffee Table</option>
                <option value="Credenza">Credenza</option>
                <option value="Escritorio">Escritorio / Desk</option>
                <option value="Silla Clasica">Silla Clásica / Classic Chair</option>
                <option value="Silla Moderna">Silla Moderna / Modern Chair</option>
                <option value="Otro">Otro / Other</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">
                <span class="lang-es">Acabado / Resina</span>
                <span class="lang-en d-none">Finish / Resin</span>
            </label>
            <select name="acabado_resina" class="form-select">
                <option value="Sin Resina">Madera Natural / Natural Wood</option>
                <option value="Rio Azul">Río Azul / Blue River</option>
                <option value="Negro Epoxico">Negro Epóxico / Black Epoxy</option>
                <option value="Transparente">Cristal Transparente / Clear</option>
                <option value="Humo">Humo / Smoke</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">
            <span class="lang-es">Medidas Aproximadas</span>
            <span class="lang-en d-none">Approx. Dimensions</span>
        </label>
        <input type="text" name="medidas" class="form-control" placeholder="Ej / Ex: 2.40m x 1.10m">
    </div>

    <div class="mb-4">
        <label class="form-label">
            <span class="lang-es">Detalles Extra / Descripción</span>
            <span class="lang-en d-none">Extra Details / Description</span>
        </label>
        <textarea name="detalles_extra" class="form-control" rows="3" placeholder="Describe detalles especiales... / Describe special details..."></textarea>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">
            <span class="lang-es">Generar Pedido</span>
            <span class="lang-en d-none">Submit Order</span>
        </button>
    </div>

</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>