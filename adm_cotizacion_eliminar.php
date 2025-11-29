<?php
session_start();
// 1. Validar sesión de administrador
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) ){
    header('Location: login.php'); 
    exit();
}

include("php/conexion.php");

// 2. Validar que recibimos un ID
if (isset($_GET['id'])) {
    $id_borrar = $_GET['id'];

    // 3. Ejecutar el borrado usando tu función personalizada 'delete'
    // La función delete("tabla", "condición") está en tu conexion.php
    $resultado = delete("pedidos", "id_pedido = $id_borrar");

    if ($resultado) {
        echo "<script>
                alert('El pedido ha sido eliminada correctamente.');
                window.location = 'adm_cotizaciones.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: No se pudo eliminar el registro.');
                window.location = 'adm_cotizaciones.php';
              </script>";
    }

} else {
    // Si intentan entrar sin ID, los regresamos
    header('Location: adm_cotizaciones.php');
}
?>