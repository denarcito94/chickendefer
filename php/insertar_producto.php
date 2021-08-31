<?php
session_start();
$path = $_SERVER['HTTP_REFERER'];
$nombre = $_POST['nombre'];
$codigo = $_POST['cod'];
$precio = $_POST['precio'];

require_once "../config/datos_conexion.php";



$conexion = mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {

	echo "no se puede conectar a la base de datos";

	exit();
}
mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");

if ($_FILES['imagen']['type'] == "image/gif" || $_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
	move_uploaded_file($_FILES['imagen']['tmp_name'], "../imagen/" . $_FILES['imagen']['name']);
}

$consulta = "INSERT INTO productos (nombre,codigo, precio, imagen) VALUES ('$nombre','$codigo', $precio, '" . $_FILES['imagen']['name'] . "')";
$checkProduct = "SELECT id, codigo FROM productos WHERE codigo = '${codigo}'";

$resultado = mysqli_query($conexion, $checkProduct);

$row = mysqli_num_rows($resultado);

if ($row > 0) {
	$_SESSION['errors'] = [
		'El código ' . mysqli_fetch_assoc($resultado)['codigo'] . ' ya esta asociado a un producto'
	];
	mysqli_close($conexion);
	header("location:" . $path . "#productos");
	exit;
}

$resultado = mysqli_query($conexion, $consulta);
if (!$resultado) {
	$_SESSION['errors'] = [
		'No se pudo agregar el producto verifique sus datos e intente de nuevo'
	];
	mysqli_close($conexion);
	header("location:" . $path . "#productos");
	exit;
}

$_SESSION['status'] = "El producto agregado con exito";
mysqli_close($conexion);
header("location:" . $path . "#productos");
