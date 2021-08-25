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
<title>Sistema de Gestion Chikendefer</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<script type="text/javascript" src="codigo.js"></script>
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
	<div align="center" style="padding: 20px; color:black ; width: 550px; border: 1px solid #aeadad;box-shadow: 0px 10px 15px #d9d0d0;">
		<h4 align="center">Registrar Cliente</h4>
		<form class="was-validated" action="php/insertar_cliente.php" method="get" >
			<div class="form-group">
			<input class="form-control" type="text" name="nit" placeholder="Ingrese un nit" required>
			<br>
			<input class="form-control" type="text" name="nombre" placeholder="Ingrese un nombre" required><br>
			<input class="form-control" type="text" name="ape_paterno" placeholder="Ingrese un apellido paterno" required>
			<br>
			<input class="form-control" type="text" name="ape_materno" placeholder="Ingrese un apellido materno" required>
			<br>
			<input class="form-control" type="text" name="direccion" placeholder="Ingrese su direccion" required>
      		<br>
			<input class="form-control" type="text" name="telef" placeholder="Ingrese su telefono" required>
      		<br>
			<a class="btn btn-primary" href="menu.php"><i class='fas fa-arrow-left'></i> Volver</a>
			<input type="submit" name="reg_cliente" value="Registrar" class="btn btn-primary">
		</div>
	</form>
	</div>
	</div>

<table style="margin: 20px;">
	<tr>
	<td><strong>Nit</strong></td>
	<td><strong>Nombre</strong></td>
	<td><strong>Ap. Paterno</strong></td>
	<td><strong>Ap. Materno</strong></td>
	<td><strong>Direccion</strong></td>
	<td><strong>Celular</strong></td>
	<td><strong>Actualizar</strong></td>
	<td><strong>Borrar</strong></td>
</tr>
<?php
$peticion="SELECT * FROM clientes";
$resultado=mysqli_query($conexion,$peticion);
while ($fila = mysqli_fetch_array($resultado)) {
	echo '<tr>
	<form action="php/actualizar_cliente.php?id='.$fila['id'].'" method="post" >
		<td><input style="width: 216px;" class="lbl_text" type="text" name="nit" value="'.$fila['nit'].'" ></td>	
		<td><input style="width: 216px;" class="lbl_text" type="text" name="nombre" value="'.$fila['nombre'].'"></td>	
		<td><input style="width: 216px;" class="lbl_text" type="text" name="ape_paterno" value="'.$fila['apellido_paterno'].'"></td>
		<td><input style="width: 216px;" class="lbl_text" type="text" name="ape_materno" value="'.$fila['apellido_materno'].'"></td>
		<td><input style="width: 216px;" class="lbl_text" type="text" name="direccion" value="'.$fila['direccion'].'"></td>
		<td><input style="width: 216px;" class="lbl_text" type="text" name="telef" value="'.$fila['telefono'].'"></td>
		<td><input type="submit" value="Actualizar" class="btn btn-primary"></td>		
	</form>
		<td><a href="php/eliminar_cliente.php?id='.$fila['id'].'"><button class="btn btn-danger">Borrar</buton></td>
	</tr>
	';
}
	
?>
	</table>


</body>
</html>