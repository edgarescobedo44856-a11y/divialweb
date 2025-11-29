<?php 
session_start();
include("php/conexion.php"); 

if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}

// Obtener la conexión global para sanitizar (asumiendo que conexion.php la establece)
global $conexion; 

// 1. Obtener y Sanitizar variables del formulario
$var_email_original = mysqli_real_escape_string($conexion, $_POST['hid_email_original']); // Email/ID original (para el WHERE)

// Tabla Proveedores
$nombre_empresa     = mysqli_real_escape_string($conexion, $_POST['pro_nombre_empresa']);
$contacto_principal = mysqli_real_escape_string($conexion, $_POST['pro_contacto_principal']); 
$telefono           = mysqli_real_escape_string($conexion, $_POST['pro_telefono']);
$email_nuevo        = mysqli_real_escape_string($conexion, $_POST['pro_email']); // El nuevo correo (puede ser igual al original)

$pagina_web         = mysqli_real_escape_string($conexion, $_POST['pro_pagina_web']); 
$password           = mysqli_real_escape_string($conexion, $_POST['pas_password']); 

// Tabla Domicilios
$calle              = mysqli_real_escape_string($conexion, $_POST['dom_calle']);
$numero             = mysqli_real_escape_string($conexion, $_POST['dom_numero']);
$colonia            = mysqli_real_escape_string($conexion, $_POST['dom_colonia']);
$ciudad             = mysqli_real_escape_string($conexion, $_POST['dom_ciudad']);
$estado             = mysqli_real_escape_string($conexion, $_POST['dom_estado']);
$cp                 = mysqli_real_escape_string($conexion, $_POST['dom_cp']);

// 2. Sentencia de Actualización para la tabla PROVEEDORES
$cons_proveedor = update( 
    "proveedores",
    "pro_nombre_empresa     = '$nombre_empresa',
     pro_contacto_principal = '$contacto_principal',
     pro_telefono           = '$telefono',
     pro_email              = '$email_nuevo',
    
     pro_pagina_web         = '$pagina_web',
     pro_password           = '$password'",
    "pro_email              = '$var_email_original'" // Condición WHERE
);

// 3. Sentencia de Actualización para la tabla DOMICILIOS
// Usamos el email original en el WHERE, y el nuevo email en el SET si ha cambiado.
$cons_domicilio = update( 
    "domicilios",
    "usu_correo     = '$email_nuevo',
     dom_calle      = '$calle',
     dom_numero     = '$numero',
     dom_colonia    = '$colonia',
     dom_ciudad     = '$ciudad',
     dom_estado     = '$estado',
     dom_cp         = '$cp'",
    "usu_correo     = '$var_email_original'" // Condición WHERE
);

// 4. Resultado y redirección
// Se considera éxito si ambas actualizaciones se ejecutaron (incluso si no hubo cambios en los datos)
if($cons_proveedor && $cons_domicilio) {
?>
    <script>
        alert("¡Proveedor y Domicilio modificados correctamente!");
        window.location = "adm_proveedor.php";
    </script> 
<?php
} else {
    // Nota: Es difícil determinar cuál falló sin lógica de transacciones avanzada.
    // Un error común es que el email nuevo ya exista.
?>
    <script>
        alert("Error: No se pudo modificar el proveedor. Verifique que el nuevo Email o RFC no estén duplicados y que los datos de domicilio existan.");
        window.history.back();
    </script>
<?php
}
?>