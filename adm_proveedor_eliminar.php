<?php 
session_start();
include("php/conexion.php"); 

// 1. Validar sesión y tipo de usuario
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    // Si no está logueado, redirigir a login
    header('Location: login.php'); 
    exit();
}

// 2. Validamos que llegue el ID (Email del proveedor)
if(!isset($_GET['id'])){
    // Si no llega el ID, redirigir a la lista de proveedores
    header('Location: adm_proveedor.php');
    exit();
}

// 3. Obtener el ID/Email a eliminar (y sanitizar si fuera necesario, aunque delete() lo manejaría)
$var_email = $_GET['id'];
// Para mayor seguridad en la eliminación, siempre es bueno asegurar que es el ID correcto
// Aunque la función delete() debería encargarse de armar la consulta segura.

$eliminado_domicilio = false;
$eliminado_proveedor = false;

// ---------------------------------------------------------
// PASO 1: ELIMINAR EL DOMICILIO ASOCIADO
// ---------------------------------------------------------
// Asumimos que la clave externa en 'domicilios' es 'usu_correo' y guarda el email del proveedor.
// Esto debe hacerse PRIMERO si la tabla Proveedores tiene una restricción de clave foránea.
$result_domicilio = delete("domicilios", "usu_correo = '$var_email'");

if ($result_domicilio) {
    $eliminado_domicilio = true;
} else {
    // Manejo de error si el domicilio falla (por ejemplo, si no existía o error de BD)
    // No detenemos el script, intentamos borrar el proveedor
}

// ---------------------------------------------------------
// PASO 2: ELIMINAR EL PROVEEDOR
// ---------------------------------------------------------
// El email es la Primary Key/identificador
$result_proveedor = delete("proveedores", "pro_email = '$var_email'");

if ($result_proveedor) {
    $eliminado_proveedor = true;
}

// ---------------------------------------------------------
// 4. Mostrar resultado y redireccionar
// ---------------------------------------------------------
if($eliminado_proveedor) {
    // Éxito: El proveedor fue eliminado (incluso si el domicilio ya no existía)
    // El mensaje debe reflejar que el principal (el proveedor) se borró.
    if($eliminado_domicilio) {
        $mensaje = "El Proveedor y su Domicilio SE BORRARON CORRECTAMENTE de la base de datos.";
    } else {
        $mensaje = "El Proveedor SE BORRÓ CORRECTAMENTE. (Advertencia: No se encontró o falló la eliminación del Domicilio asociado).";
    }
?>
    <script languaje="javascript" >
        alert("<?php echo $mensaje; ?>");
    </script> 
<?php
} else {
    // Error: El proveedor NO pudo ser eliminado (probablemente no existía o error de BD)
?>
    <script languaje="javascript" >
        alert("Error: No se pudo eliminar el Proveedor. Verifique la clave o contacte a soporte.");
        window.history.back();
    </script> 
<?php
    exit();
}
?>

<meta http-equiv="refresh" content="0;URL=adm_proveedor.php" >