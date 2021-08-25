<?php 
require_once "../config/datos_conexion.php";

$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {	
	echo "no se puede conectar a la base de datos";	
	exit();
}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");

$peticion="DELETE FROM clientes WHERE id=".$_GET['id']." ";
$resultado=mysqli_query($conexion, $peticion);
mysqli_close($conexion);
?>
<script type="text/javascript">
	window.location="../Registro_cliente.php";
</script>