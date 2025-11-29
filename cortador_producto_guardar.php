<?php
session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'gerente'){ 
    header('Location: login.php'); exit(); 
}
include("php/conexion.php");

// 1. Recibir Datos
$nombre      = $_POST['txt_nombre'];
$tipo        = $_POST['lst_tipo'];
$precio      = $_POST['num_precio'];
$medidas     = $_POST['txt_medidas'];
$cantidad    = $_POST['num_cantidad'];
$descripcion = $_POST['txt_descripcion'];

// 2. Imagen
$nombre_imagen = $_FILES['foto_producto']['name'];
$temporal      = $_FILES['foto_producto']['tmp_name'];
$carpeta       = "img/productos/";
$nombre_final_foto = "";

if ($nombre_imagen != "") {
    $nombre_final_foto = rand(1000,9999) . "_" . $nombre_imagen;
    move_uploaded_file($temporal, $carpeta . $nombre_final_foto);
}

// 3. Insertar
$sql = "INSERT INTO productos 
        (nombre, tipo_mueble, medidas, cantidad, descripcion, prod_foto, precio) 
        VALUES 
        ('$nombre', '$tipo', '$medidas', '$cantidad', '$descripcion', '$nombre_final_foto', '$precio')";

$resultado = db_query($sql);

if($resultado){
    echo "<script>
            alert('Producto agregado al inventario correctamente.'); 
            window.location='ger_inventario.php'; // Regresa a la vista de Gerente
          </script>";
} else {
    echo "<script>
            alert('Error al guardar.'); 
            window.history.back();
          </script>";
}
?>