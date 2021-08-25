<?php 

$id_cliente=$_POST['nombre']; 
$id_productos=$_POST['productos']; 
$fecha=$_POST['fecha']; 
$hora=$_POST['hora']; 

require_once "../config/datos_conexion.php";

$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {
	
	echo "no se puede conectar a la base de datos";	
	exit();
}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");

if ($_POST['nombre'] != '' and $_POST['hora'] != '') {


	
	$consulta="INSERT INTO pedidos (id_cliente,fecha, hora) VALUES ('$id_cliente','$fecha', $hora)";
	$resultado=mysqli_query($conexion, $consulta);

	$id=mysqli_insert_id($conexion);

	$consulta="INSERT INTO detalle_pedidos (id_pedido,id_producto) VALUES ('$id','$id_productos')";
	$resultado=mysqli_query($conexion, $consulta);

	if ($resultado==false) {
	 	
	 	echo"no se pudo insertar los datos";


	 } else{

		echo "registro correctamente";
		?>
		<a href="../Registro_pedidos.php">Volver</a>
		<?php
		//header("Location:../Registro_producto.php");
	}

}else{
	echo "Ingrese datos";
	echo "<a href='../Registro_pedidos.php'>Volver</a>";
	}
mysqli_close($conexion);

 ?>