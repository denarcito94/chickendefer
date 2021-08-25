
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
		<div style="width: 800px;margin: auto;background: white;padding: 15px;box-shadow: 0px 10px 15px #9e9e9e;">
			<nav class="nav">Sistema de Gestion Chickendefer</nav>
			
			<p><strong>¿Ya eres cliente?</strong></p>
		<form class="was-validated"  action="log_cliente.php" method="POST" style="margin-top: 20px;">
			<input type="text" style="width: 350px;" class="form-control" name="nit" placeholder="Usuario" required><br>
			<input type="text" style="width: 350px;" class="form-control" name="telef" placeholder="Contraseña" required><br>
			<input type="submit" class="btn btn-primary">
		</form>
		<p><strong>¿Eres nuevo cliente?</strong></p>
		<form class="was-validated"  action="insertar_cliente.php" method="get">
			<input class="form-control" type="text" name="nit" placeholder="Ingrese un nit" required><br><br>
			<input class="form-control" type="text" name="nombre" placeholder="Ingrese un nombre" required ><br><br>
			<input class="form-control" type="text" name="ape_paterno" placeholder="Ingrese un apellido paterno" required><br><br>
			<input class="form-control" type="text" name="ape_materno" placeholder="Ingrese un apellido materno" required><br><br>
			<input class="form-control" type="text" name="direccion" placeholder="Ingrese su direccion" required><br><br>
			<input class="form-control" type="text" name="telef" placeholder="Ingrese su telefono" required><br><br>
			<input type="submit" name="reg_cliente" value="Registrar" class="btn btn-primary">

		</form>
	</div>
	</body>
</html>