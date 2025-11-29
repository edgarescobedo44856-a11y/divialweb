<?php 
session_start();
include("php/conexion.php"); 

// 1. Validar sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}

// 2. Verificar que se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: adm_proveedor_registrar.php');
    exit();
}

// 3. Obtener la conexión global
global $conexion; 

if (!isset($conexion)) {
    // Si la conexión global no está definida, algo falló en php/conexion.php
    die("<script>console.error('Error: La base de datos no está disponible.'); window.location='adm_proveedor.php';</script>");
}

// ==========================================================
// 4. INICIO DE TRANSACCIÓN 🚦
// Deshabilitar el autocommit para controlar la inserción
// ==========================================================
mysqli_autocommit($conexion, FALSE);
$commit_exitoso = TRUE; // Bandera para saber si hacer COMMIT o ROLLBACK

// 5. RECIBIR Y SANITIZAR DATOS DEL FORMULARIO
// Usando el operador ?? para manejar campos opcionales sin errores.
$nombre_empresa     = mysqli_real_escape_string($conexion, $_POST['pro_nombre_empresa']);
$contacto_principal = mysqli_real_escape_string($conexion, $_POST['pro_contacto_principal']); 
$telefono           = mysqli_real_escape_string($conexion, $_POST['pro_telefono']);
$email              = mysqli_real_escape_string($conexion, $_POST['pro_email']);
$pagina_web         = mysqli_real_escape_string($conexion, $_POST['pro_pagina_web'] ?? ''); // Uso seguro

$calle              = mysqli_real_escape_string($conexion, $_POST['dom_calle']);
$numero             = mysqli_real_escape_string($conexion, $_POST['dom_numero']);
$colonia            = mysqli_real_escape_string($conexion, $_POST['dom_colonia']);
$ciudad             = mysqli_real_escape_string($conexion, $_POST['dom_ciudad']);
$estado             = mysqli_real_escape_string($conexion, $_POST['dom_estado']);
$cp                 = mysqli_real_escape_string($conexion, $_POST['dom_cp']);

// ---------------------------------------------------------
// PASO 1: INSERTAR EL PROVEEDOR
// ---------------------------------------------------------

$sql_proveedor = "INSERT INTO proveedores 
    (pro_nombre_empresa, pro_contacto_principal, pro_telefono, pro_email, pro_pagina_web) 
    VALUES 
    ('$nombre_empresa', '$contacto_principal', '$telefono', '$email', '$pagina_web')";

// CORRECCIÓN LÍNEA 58: Usamos la función correcta mysqli_query()
$resultado_proveedor = mysqli_query($conexion, $sql_proveedor);

if (!$resultado_proveedor) {
    $commit_exitoso = FALSE;
}

// ---------------------------------------------------------
// PASO 2: INSERTAR EL DOMICILIO (Solo si el proveedor se insertó bien)
// ---------------------------------------------------------

if ($commit_exitoso) {
    // Usando 'pro_email' como clave foránea (asumida)
    $sql_domicilio = "INSERT INTO domicilios 
        (pro_email, dom_calle, dom_numero, dom_colonia, dom_ciudad, dom_estado, dom_cp) 
        VALUES 
        ('$email', '$calle', '$numero', '$colonia', '$ciudad', '$estado', '$cp')";
                        
    $resultado_domicilio = mysqli_query($conexion, $sql_domicilio);

    if (!$resultado_domicilio) {
        $commit_exitoso = FALSE;
    }
}

// ==========================================================
// 6. GESTIÓN DE LA TRANSACCIÓN (COMMIT O ROLLBACK) 💾
// ==========================================================
?>
<script>
<?php
if ($commit_exitoso) {
    // Si todo fue exitoso, guardamos los cambios.
    mysqli_commit($conexion);
    echo "console.log('¡Registro Completo! Transacción exitosa.');";
    echo "alert(\"¡Registro Completo! El Proveedor '$nombre_empresa' ha sido guardado exitosamente.\");";
    echo "window.location = 'adm_proveedor.php';";
} else {
    // Si algo falló en cualquier INSERT, deshacemos ambos.
    mysqli_rollback($conexion);
    
    $error_sql = htmlspecialchars(mysqli_error($conexion));

    if (!$resultado_proveedor) {
        // Falló la primera inserción (Proveedor)
        $error_mensaje = "Error al registrar el proveedor. (Verifique si Email o Teléfono están duplicados. Error SQL: $error_sql)";
    } elseif (!$resultado_domicilio) {
        // Falló la segunda inserción (Domicilio)
        $error_mensaje = "Error al guardar el domicilio. Se deshizo el registro completo. (Error SQL: $error_sql)";
    } else {
        $error_mensaje = "Error de transacción desconocido. (Error SQL: $error_sql)";
    }

    echo "console.error(\"$error_mensaje\");";
    echo "alert(\"$error_mensaje\");";
    echo "window.history.back();"; 
}
// Volvemos a habilitar el autocommit
mysqli_autocommit($conexion, TRUE);
?>
</script>