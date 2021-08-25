<?php 
$nit=$_POST['nit'];
$nombre=$_POST['nombre'];
$apellido_paterno=$_POST['ape_paterno'];
$apellido_materno=$_POST['ape_materno'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telef'];

require_once "../config/datos_conexion.php";

$conexion=mysqli_connect($db_host, $db_user, $db_pass);
if (mysqli_connect_errno()) {
	echo "no se puede conectar a la base de datos";
	exit();
}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");

$peticion="UPDATE clientes SET 
		 nit='".$_POST['nit']."',
		 nombre='".$_POST['nombre']."',
		 apellido_paterno='".$_POST['ape_paterno']."',
		 apellido_materno='".$_POST['ape_materno']."',
		 direccion='".$_POST['direccion']."',
		 telefono='".$_POST['telef']."'

		 where id=".$_GET['id']."
		 ";
$resultado=mysqli_query($conexion, $peticion);
mysqli_close($conexion);

?>
<script type="text/javascript">
	window.location="../Registro_cliente.php";
</script>