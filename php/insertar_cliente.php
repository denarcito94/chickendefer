<?php
session_start();
$path = $_SERVER['HTTP_REFERER'];
$isFieldEmpty = 0;
$nit = $_POST['nit'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['ape_paterno'];
$apellido_materno = $_POST['ape_materno'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telef'];


require_once "../config/datos_conexion.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {

	echo "no se puede conectar a la base de datos";

	exit();
}
mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");

$consulta = "INSERT INTO clientes (nit, nombre, apellido_paterno, apellido_materno, direccion, telefono) 
							VALUES ('$nit', '$nombre', '$apellido_paterno', '$apellido_materno', '$direccion', '$telefono')";


$checkNit = "SELECT id FROM clientes WHERE nit = '${nit}'";
$resultado = mysqli_query($conexion, $checkNit);
$record = mysqli_num_rows($resultado);

if ($record > 0) {
	$_SESSION['errors'] = [
		'NIT ya registrado'
	];
	mysqli_close($conexion);
	header("location:" . $path . "#clientes");
	exit();
}


$resultado = mysqli_query($conexion, $consulta);
echo json_encode($resultado);


if (!$resultado) {
	$_SESSION['errors'] = [
		'No se pudo completar su operacion, verifique su datos e intente de nuevo'
	];
	mysqli_close($conexion);
	header("location:" . $path . "#clientes");
	exit();
}

$_SESSION['status'] = 'Registro completado';
header("location:" . $path . "#clientes");
exit();
