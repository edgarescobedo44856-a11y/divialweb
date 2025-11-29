<?php session_start();   
include('php/conexion.php'); 
/*obtenemos las variables*/ 
$var_email = $_POST['ema_email'];   
$var_password = $_POST['pas_password'];
/*imprimir las variables 
echo "$var_email, $var_password";*/

//Select para verificar si existe el usuario 
$result = select_where("usuarios","usu_correo='$var_email'");

if(mysqli_num_rows($result) > 0){ // compara si existe el usuario 
	 while($row = mysqli_fetch_object($result)){ // Realizamos un bucle utilizando while.
		if($row->usu_password == $var_password){ //compara el pass
            //Almacenamos el nombre de usuario en una variable de sesión usuario
            $_SESSION['tipo'] = $row->tipo;
            $_SESSION['usuario'] = $row->usu_nombre;
            $_SESSION['id_usuario'] = $row->usu_correo;
            //echo $_SESSION['usuario'].$_SESSION['tipo'];
            $var_id=$_SESSION['usu_correo'];
            ?>
            <script languaje="javascript" >alert("<?php echo "Bienvenido ".$row->usu_nombre." ".$row->usu_ap_pat; ?>");</script>
            <?php 

            switch ($_SESSION['tipo']) {
                case 'admin':
                    ?> <meta http-equiv="refresh" content="0;URL=adm_index.php" > <?php 
                    break;
                case "gerente":
                    ?> <meta http-equiv="refresh" content="0;URL=ger_index.php" > <?php 
                    break;
                case "cliente":
                    ?> <meta http-equiv="refresh" content="0;URL=cli_index.php" > <?php 
                    break;
            }
		    } else{
                ?> <script languaje="javascript" >alert("Acceso Incorrecto");</script> 
                <meta http-equiv="refresh" content="0;URL=login.php" >
                <?php 
                //exit();
		    }
	    }
} else{
    ?>  <script languaje="javascript" >alert("Usuario o Contraseña incorrecto!");</script> 
        <meta http-equiv="refresh" content="0;URL=login.php" >
    <?php 
    //exit();
}
?>