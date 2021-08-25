<?php 
session_start();

require_once "../config/datos_conexion.php";
$contador=0;
$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {	
	echo "no se puede conectar a la base de datos";	
	exit();
}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");



//if ($contador > 0) {
	$consulta="INSERT INTO pedidos (id_cliente,fecha) VALUES ('".$_SESSION['suma']."','".date("Y-m-d")."')";
		$resultado=mysqli_query($conexion, $consulta);

		$id=mysqli_insert_id($conexion);
	for ($i=0; $i<$_SESSION['contador']; $i++) { 
		
	$consulta2="SELECT * FROM productos WHERE id='".$_SESSION['producto'][$i]."' ";
	$resultado2=mysqli_query($conexion, $consulta2);
	while($fila2= mysqli_fetch_array($resultado2)){
		$product=$fila2['nombre'];

	 }		

			$consulta="INSERT INTO detalle_pedidos (id_pedido,id_producto,cantidad,detalle) VALUES ('$id','".$_SESSION['producto'][$i]."',".$_SESSION['cantidad'][$i].",'".$product."')";
			$resultado=mysqli_query($conexion, $consulta);
	}
	echo "Tu pedido se ha realizado satisfactoriamente. Redirigiendo a la pagina principal....";
	session_destroy();
	echo "<meta http-equiv='refresh' content='5; url=../index.php'> ";
/*}else{
	echo'no existe productos....';
}*/

 ?>