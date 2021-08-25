<?php 

$nombre=$_POST['nombre'];
$codigo=$_POST['cod'];
$precio=$_POST['precio'];

require_once "../config/datos_conexion.php";



$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {
	
	echo "no se puede conectar a la base de datos";
	
	exit();

}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");

if ($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ) {
	move_uploaded_file($_FILES['imagen']['tmp_name'],"../imagen/".$_FILES['imagen']['name']);
}

$consulta="INSERT INTO productos (nombre,codigo, precio, imagen) VALUES ('$nombre','$codigo', $precio, '".$_FILES['imagen']['name']."')";


$resultado=mysqli_query($conexion, $consulta);


if ($resultado==false) {
 	
 	echo"no se pudo insertar los datos";
 } else{
	/*echo "registro correctamente";*/
}

mysqli_close($conexion);

 ?>
 <script type="text/javascript">
	window.location="../Registro_producto.php";
</script>