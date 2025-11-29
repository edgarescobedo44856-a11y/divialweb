<?php 
session_start();

// Validamos si se ha hecho o no el inicio de sesion correctamente
if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) {
    echo "Usuario no Logueado";
    header('Location: login.php'); 
    exit();
}

// Incluimos la conexión. ¡Ahora $conexion es una variable global válida!
include("php/conexion.php"); 

// Obtenemos el ID del usuario a eliminar (Viene de la URL: $_GET)
$var_id = $_GET['id'];
// La variable $conexion está disponible aquí gracias al include/global.

// ==========================================================
// USO DE SENTENCIAS PREPARADAS (CORRECCIÓN DE SEGURIDAD)
// ==========================================================

// Preparamos la consulta con un marcador de posición '?'
if ($stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?")) {
    
    
    $stmt->bind_param("s", $var_id);
    
    // Ejecutamos la consulta de borrado
    $stmt->execute();
    
    // Verificamos si se borró al menos una fila
    if ($stmt->affected_rows > 0) {
        $mensaje = "El Usuario SE BORRÓ CORRECTAMENTE de la base de datos.";
    } else {
        $mensaje = "ADVERTENCIA: No se encontró un usuario con ese ID o ya fue borrado.";
    }

    // Cerramos la sentencia
    $stmt->close();

} else {
    // Si falla la preparación (error de sintaxis en el SQL, etc.)
    $mensaje = "ERROR al preparar la consulta: " . $conexion->error;
}


// Mensaje de alerta y Redirección
?>
<script languaje="javascript" >
    alert("<?php echo $mensaje; ?>");
</script> 

<meta http-equiv="refresh" content="0;URL=adm_usuario.php" >