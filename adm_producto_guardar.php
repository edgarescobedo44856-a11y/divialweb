<?php
session_start();
include("php/conexion.php");

if(!isset($_SESSION['usuario'])){ header('Location: login.php'); exit(); }

// 1. Recibir Datos
$nombre      = $_POST['txt_nombre'];
$tipo        = $_POST['lst_tipo'];
$precio      = $_POST['num_precio'];
$medidas     = $_POST['txt_medidas'];
$cantidad    = $_POST['num_cantidad'];
$descripcion = $_POST['txt_descripcion'];

// 2. Manejo de la Imagen
$nombre_imagen = $_FILES['foto_producto']['name'];
$temporal      = $_FILES['foto_producto']['tmp_name'];
$carpeta       = "img/productos/";

// Generamos nombre único para no sobreescribir fotos (ej: 8329_silla.jpg)
$nombre_final_foto = rand(1000,9999) . "_" . $nombre_imagen;

// Si se subió archivo, lo movemos
if ($nombre_imagen != "") {
    move_uploaded_file($temporal, $carpeta . $nombre_final_foto);
} else {
    $nombre_final_foto = ""; // O una imagen default
}

// 3. Insertar en BD
// Usamos las columnas de tu tabla: nombre, tipo_mueble, medidas, cantidad, descripcion, prod_foto, precio
$sql = "INSERT INTO productos 
        (prod_nombre, prod_tipo, prod_medidas, cantidad, descripcion, prod_foto, precio) 
        VALUES 
        ('$nombre', '$tipo', '$medidas', '$cantidad', '$descripcion', '$nombre_final_foto', '$precio')";

$resultado = db_query($sql);

if($resultado){
    echo "<script>alert('Producto guardado correctamente'); window.location='adm_producto.php';</script>";
} else {
    echo "<script>alert('Error al guardar producto'); window.history.back();</script>";
}
?>