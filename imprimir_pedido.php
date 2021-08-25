<?php 
$id_cliente=$_POST['idc'];
$detalle=$_POST['detalle'];
$pp=$_POST['pp'];
$cantidad=$_POST['cantidad'];
$nombre=$_POST['nombre'];

require_once "config/datos_conexion.php";
$contador=0;
$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {	
	echo "no se puede conectar a la base de datos";	
	exit();
}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");

 ?>
<html lang="es">
	<head>
		<title>Sistema de Gestion Chikendefer</title>
	<style>
		.nav{
			background: black;
			color: white;
			padding: 10px;
			font-family: sans-serif;
			letter-spacing: 3px;
			font-size: 15px;
		}
	</style>
	<script type="text/javascript" src="../codigo.js"></script>
	<script type="text/javascript" src="../jquery.js" ></script>
	</head>
	<body>
		<div style="width: 800px;margin: auto;background: white;padding: 15px;box-shadow: 0px 10px 15px #9e9e9e;">
			<nav class="nav">Sistema de Gestion Chickendefer</nav>
			
		<form  style="margin-top: 20px;" id="from1">
			<div><h1>Detalle Pedido</h1></div>
			<div class="col-xs-6">
				<label>Nombre Completo</label>
				<?php echo "<p>".$nombre." </p>" ?>
			</div>
			<div class="col-xs-6">
				<label>Costo</label>
				<?php echo "<p>".$pp."</p>" ?>
			</div>
			<div class="col-xs-6">
				<label>Cantidad</label>
				<?php echo "<p>".$cantidad."</p>" ?>
			</div>
			<div class="col-xs-6">
				<label>Producto</label>
				<?php echo "<p>".$detalle."</p>" ?>
			</div>

		</form>
		<!--<button onclick="printer('from1')">Imprimir</button>-->
	</div>
	</body>
</html>