<?php
session_start();
$suma=0;
if (isset($_GET['p'])) {
	$_SESSION['producto'][$_SESSION['contador']]=$_GET['p'];
	$_SESSION['cantidad'][$_SESSION['contador']]=$_GET['cant'];
	$_SESSION['contador']++;
}
require_once "config/datos_conexion.php";

$conexion=mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {	
	echo "no se puede conectar a la base de datos";	
	exit();
}
mysqli_select_db($conexion, $db_nombre)or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");

echo "<table>";
echo "<tr><td style='width: 85px;'><strong>Cantidad</strong></td><td style='width: 100px;'><strong>Producto</strong></td><td><strong>Precio</strong></td></tr>
";
for($i=0; $i < $_SESSION['contador']; $i++) { 
	$peticion="SELECT * FROM productos where id=".$_SESSION['producto'][$i]."";
	$resultado=mysqli_query($conexion, $peticion);
	while($fila= mysqli_fetch_array($resultado)){
		echo "<tr>
				<td>".$_SESSION['cantidad'][$i]."</td>
				<td>".$fila['nombre']."</td>
				<td>".number_format(($_SESSION['cantidad'][$i]*$fila['precio']),2)."</td>
			  </tr>";
		$suma += $_SESSION['cantidad'][$i]*$fila['precio'];
		$_SESSION['suma']=$suma;
	}
}
echo "<tr><td><strong>Subtotal</strong></td><td>".number_format($suma,2)."</td></tr>";
echo"</table>";

?>