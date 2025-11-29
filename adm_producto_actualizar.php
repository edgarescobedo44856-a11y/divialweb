<?php
session_start();
include("php/conexion.php");

$id          = $_POST['id_producto'];
$nombre      = $_POST['txt_nombre'];
$precio      = $_POST['num_precio'];
$cantidad    = $_POST['num_cantidad'];
$descripcion = $_POST['txt_descripcion'];
$foto_actual = $_POST['foto_vieja'];

// Verificamos si subieron foto nueva
$foto_nueva_nombre = $_FILES['foto_nueva']['name'];

if ($foto_nueva_nombre != "") {
    // Si hay foto nueva, la subimos
    $nombre_final_foto = rand(1000,9999) . "_" . $foto_nueva_nombre;
    move_uploaded_file($_FILES['foto_nueva']['tmp_name'], "img/productos/" . $nombre_final_foto);
    // Y borramos la vieja para ahorrar espacio (opcional)
    if(file_exists("img/productos/".$foto_actual)){ unlink("img/productos/".$foto_actual); }
} else {
    // Si no hay foto nueva, usamos la vieja
    $nombre_final_foto = $foto_actual;
}

$sql = "UPDATE productos SET 
        nombre = '$nombre', 
        precio = '$precio', 
        cantidad = '$cantidad', 
        descripcion = '$descripcion', 
        prod_foto = '$nombre_final_foto'
        WHERE id_producto = $id";

if(db_query($sql)){
    echo "<script>alert('Producto actualizado'); window.location='adm_producto.php';</script>";
} else {
    echo "<script>alert('Error al actualizar'); window.history.back();</script>";
}
?>