<?php 
session_start();
include("php/conexion.php"); 

// 1. Validar sesión
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}

// 2. RECIBIR DATOS DEL FORMULARIO
// Tabla Usuarios
$nombre   = $_POST['usu_nombre'];
$ap_pat   = $_POST['usu_ap_pat'];
$ap_mat   = $_POST['usu_ap_mat']; // Corregido el nombre del input
$edad     = $_POST['usu_edad'];
$sexo     = $_POST['usu_sexo'];
$tipo     = $_POST['tipo'];
$correo   = $_POST['usu_correo']; // PRIMARY KEY
$password = $_POST['usu_password'];

// Tabla Domicilios
$calle    = $_POST['dom_calle'];
$numero   = $_POST['dom_numero'];
$colonia  = $_POST['dom_colonia'];
$ciudad   = $_POST['dom_ciudad'];
$estado   = $_POST['dom_estado'];
$cp       = $_POST['dom_cp'];

// ---------------------------------------------------------
// PASO 1: INSERTAR EL USUARIO
// ---------------------------------------------------------
// Usamos tu función db_query() directamente.
// Nota: Es importante poner los nombres de las columnas para evitar errores.

$sql_usuario = "INSERT INTO usuarios 
                (usu_correo, usu_nombre, usu_ap_pat, usu_ap_mat, usu_password, tipo) 
                VALUES 
                ('$correo', '$nombre', '$ap_pat', '$ap_mat', '$password', '$tipo')";

// CAMBIO AQUÍ: Usamos db_query en lugar de mysqli_query
$resultado_usuario = db_query($sql_usuario);

if ($resultado_usuario) {
    
    // ---------------------------------------------------------
    // PASO 2: INSERTAR EL DOMICILIO
    // ---------------------------------------------------------
    
    $sql_domicilio = "INSERT INTO domicilios 
                      (usu_correo, dom_calle, dom_numero, dom_colonia, dom_ciudad, dom_estado, dom_cp) 
                      VALUES 
                      ('$correo', '$calle', '$numero', '$colonia', '$ciudad', '$estado', '$cp')";
                      
    // CAMBIO AQUÍ: Usamos db_query
    $resultado_domicilio = db_query($sql_domicilio);

    if ($resultado_domicilio) {
        // ÉXITO TOTAL
        ?>
        <script>
            alert("¡Registro Completo! Usuario y Domicilio guardados exitosamente.");
            window.location = "adm_usuario.php";
        </script>
        <?php
    } else {
        // Falló el domicilio
        ?>
        <script>
            alert("El usuario se creó, pero hubo un error al guardar el domicilio.");
            window.location = "adm_usuario.php";
        </script>
        <?php
    }

} else {
    // Falló el usuario (probablemente correo duplicado)
    ?>
    <script>
        alert("Error: No se pudo registrar el usuario. Verifique que el correo no esté repetido.");
        window.history.back(); 
    </script>
    <?php
}
?>