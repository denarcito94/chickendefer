<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro_Restaurante</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

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
	<div align="center" style="margin-top: 80px;">
	<div align="center" style="background: #F1EDED; padding: 10px; color:black ; width: 400px; ">
		<h4 align="center">Registro del restaurante</h4>
		<form action="" method="post" >

			<input class="lbl_text" type="text" name="nombre" placeholder="nombre del restaurante"><br><br>
			<input class="lbl_text" type="text" name="cod" placeholder="direccion del restaurante"><br><br>
			<input class="lbl_text" type="text" name="precio" placeholder="telefono"><br><br>
			

			
			<input type="submit" name="reg_Restaurante" value="Registrar" class="btn_res">
	
	</form>
	</div>
	</div>




</body>
</html>