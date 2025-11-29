<?php 
session_start();
include("php/conexion.php"); 

if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}

// 1. Obtener variables del formulario
$var_id_original = $_POST['hid_id']; // El correo original (para el WHERE)

$var_nombre = $_POST['txt_Nombre'];

$var_apPat  = $_POST['txt_ApPat'];
$var_apMat  = $_POST['txt_ApMat'];

$var_email  = $_POST['ema_email']; // El nuevo correo
$var_pass   = $_POST['pas_password'];
$var_tipo   = $_POST['lst_Tipo'];

// 2. Crear la sentencia de actualización
// Nota: Actualizamos todos los campos usando los nombres correctos de la BD

$cons = update( 
      "usuarios",
      "usu_correo   = '$var_email',
       usu_nombre   = '$var_nombre',
       usu_ap_pat   = '$var_apPat',
       usu_ap_mat   = '$var_apMat',
      
       usu_password = '$var_pass',
       tipo         = '$var_tipo'",
      "usu_correo   = '$var_id_original'" // Condición WHERE usando el correo original
);

if($cons) {
?>
    <script>
        alert("¡Usuario modificado correctamente!");
        window.location = "adm_usuario.php";
    </script> 
<?php
} else {
?>
    <script>
        alert("Error: No se pudo modificar el usuario.");
        window.history.back();
    </script>
<?php
}
?>