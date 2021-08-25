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
<title>Registro_Producto</title>
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
	<div align="center" style="padding: 20px; color:black ; width:550px; border: 1px solid #aeadad;box-shadow: 0px 10px 15px #d9d0d0; ">
		<div class="container">
		<h4 align="center">Registro Productos</h4>
		<form class="was-validated" action="php/insertar_producto.php" method="post" enctype="multipart/form-data" >
			<div class="form-group">
				<input class="form-control" type="text" name="nombre" placeholder="Ingrese un nombre" required>
				<br>
				<input class="form-control" type="text" name="cod" placeholder="Ingrese codigo" required>
      			<br>
				<input class="form-control" type="text" name="precio" placeholder="Ingrese precio" required>
      			<br>
				<input type="file" name="imagen"><br><br>
				<a class="btn btn-primary" href="menu.php"><i class='fas fa-arrow-left'></i> Volver</a>
				<input type="submit" name="reg_producto" value="Registrar" class="btn btn-primary">	
			</div>	
	</form>
	</div>
	</div>
	</div>
	<div class="container" style="margin-right: 2px;margin-left: 2px;">
<table style="margin-top: 25px;" class="table table-bordered">
	<tr>
	<td><strong>Producto</strong></td>
	<td><strong>Codigo</strong></td>
	<td><strong>Precio</strong></td>
	<td><strong>Imagen</strong></td>
	<td><strong>Actualizar</strong></td>
	<td><strong>Borrar</strong></td>
</tr>
<?php
$peticion="SELECT * FROM productos";
$resultado=mysqli_query($conexion,$peticion);
while ($fila = mysqli_fetch_array($resultado)) {
	echo '<tr>
	<form action="php/actualizar_producto.php?id='.$fila['id'].'" method="post" >
		<td><input class="lbl_text" type="text" name="nombre" value="'.$fila['nombre'].'" ></td>	
		<td><input class="lbl_text" type="text" name="cod" value="'.$fila['codigo'].'"></td>	
		<td><input class="lbl_text" type="text" name="precio" value="'.$fila['precio'].'"></td>
		<td><img src="imagen/'.$fila['imagen'].'"  width=100px height=100px style="border: 2px solid #ffffff;box-shadow: 0px 10px 15px rgba(0,0,0,0.4);" ></td>
		<td><input type="submit" value="Actualizar" class="btn btn-primary"></td>		
	</form>
		<td><a href="php/eliminar_producto.php?id='.$fila['id'].'"><button class="btn btn-danger">Borrar</buton></td>
	</tr>
	';
}
	
?>
	</table>
</div>
</body>
</html>