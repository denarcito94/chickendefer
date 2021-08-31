<?php

session_start();

if (!isset($_SESSION['contador'])) {
	$_SESSION['contador'] = 0;
}

require_once "config/datos_conexion.php";

$conexion = mysqli_connect($db_host, $db_user, $db_pass);
if (mysqli_connect_errno()) {
	echo "no se puede conectar a la base de datos";
	exit();
}
mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");


?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Sistema de Gestion Chikendefer</title>
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.nav {
			background: black;
			color: white;
			padding: 10px;
			font-family: sans-serif;
			letter-spacing: 3px;
			font-size: 20px;
		}
	</style>
</head>

<body style="background: #64B5F6;">
	<div style="width: 800px;margin: auto;background: white;padding: 15px;box-shadow: 0px 10px 15px #9e9e9e;">
		<nav class="nav">Sistema de Gestion Chickendefer</nav>
		<a class="btn btn-light" href="menu.php"><i class='fas fa-arrow-left'></i> Volver</a>

		<?php include "cabecera.php"; ?>
		<h1>Pedidos</h1>

		<?php
		$peticion = "SELECT * FROM productos ";
		$resultado = mysqli_query($conexion, $peticion);
		while ($fila = mysqli_fetch_array($resultado)) {
			echo "
			<div style='border-top: 1px dashed;padding-top: 15px;padding-bottom: 15px;''>
				<img src='imagen/" . $fila['imagen'] . "' width='100px' height='100px' style='margin-right: 10px;border: 5px solid white;float: left;box-shadow: 0px 10px 15px rgba(0,0,0,0.4);' >
				<a href='#' style='color:black;text-decoration:none;'><h4 style='margin-bottom:5px;'>" . $fila['nombre'] . "</h4></a>
				<input type='number' value='1' max='5' min='1' id='num" . $fila['id'] . "'>
				<p style='margin:0px; padding:0px;font-size: 22px;color: grey;'><strong>" . $fila['precio'] . "  Bs.</strong></p>
				<button value='" . $fila['id'] . "' class='botoncompra btn btn-outline-primary'>Comprar ahora</button>
			</div>
			";
		}
		mysqli_close($conexion);
		?>

	</div>
	<script src="./jquery.js"></script>
	<script src="./codigo.js"></script>
</body>

</html>