<?php 
require_once "config/datos_conexion.php";

$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {
	
	echo "no se puede conectar a la base de datos";
	
	exit();

}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro_Pedidos</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<style>
	.btn_reg{
		background: #0C6094;
		color: white;
		width: 100px;
		padding: 10px;
		font-family: sans-serif;
		font-size: 20px;
		border-radius: 5px;

	}
	.lbl_text{
		width: 350px;
		padding: 10px;
		font-family: sans-serif;
		font-size: 15px;
	}
</style>

<body>
	<div align="center" style="margin-top: 50px;">
	<div align="center" style="padding: 10px; color:black ; width: 400px; ">
		<h2 align="center">Detalle Pedidos</h2>
		<a class="btn btn-primary" href="menu.php"><i class='fas fa-arrow-left'></i> Volver</a>
	
	</div>
	</div>


<table style="margin: 20px;">
	<tr>
	<td><strong>Producto</strong></td>
	<td><strong>Costo</strong></td>
	<td><strong>cantidad</strong></td>
	<td><strong>Cliente</strong></td>
	<td><strong>Imprimir</strong></td>
</tr>
<?php
$peticion3="SELECT concat(c.nombre, ' ',c.apellido_paterno, ' ',c.apellido_materno) as persona, c.id as idcliente,p.producto_preparado as produpre,dp.cantidad as cant,dp.detalle as detallprod FROM pedidos p, detalle_pedidos dp,clientes c where p.id=dp.id_pedido and c.id=p.id_cliente";
$resultado3=mysqli_query($conexion,$peticion3);
while ($fila3 = mysqli_fetch_array($resultado3)) {
	echo '<tr>
	<form action="imprimir_pedido.php" method="post" >
	<td hidden><input hidden class="lbl_text" type="text" name="idc" value="'.$fila3['idcliente'].'" ></td>
		<td><input class="lbl_text" type="text" name="detalle" value="'.$fila3['detallprod'].'" ></td>	
		<td><input class="lbl_text" type="text" name="pp" value="'.$fila3['produpre'].'"></td>	
		<td><input class="lbl_text" type="text" name="cantidad" value="'.$fila3['cant'].'"></td>
		<td><input class="lbl_text" type="text" name="nombre" value="'.$fila3['persona'].'"></td>	
		<td><input type="submit" name="reg_detalle" value="Imprimir" class="btn btn-secondary"></td>	
	</form>
	
	</tr>
	';
}
	
?>
	</table>

</body>
</html>