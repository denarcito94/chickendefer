<?php 

$nit=$_GET['nit'];
$nombre=$_GET['nombre'];
$apellido_paterno=$_GET['ape_paterno'];
$apellido_materno=$_GET['ape_materno'];
$direccion=$_GET['direccion'];
$telefono=$_GET['telef'];

require_once "../config/datos_conexion.php";



$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {
	
	echo "no se puede conectar a la base de datos";
	
	exit();

}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");



$consulta="INSERT INTO clientes (nit, nombre, apellido_paterno, apellido_materno, direccion, telefono) VALUES ($nit, '$nombre', '$apellido_paterno', '$apellido_materno', '$direccion', $telefono)";


$resultado=mysqli_query($conexion, $consulta);


if ($resultado==false) {
 	
 	echo"no se pudo insertar los datos";


 } else{ ?>

	<script type="text/javascript">
		window.location="../Registro_cliente.php";
	</script>
	
<?php
/*echo "registro correctamente"; */
}

mysqli_close($conexion);

 ?>