<?php

require_once "../config/datos_conexion.php";
session_start();

$user = $_SESSION['user'] ?? ['username' => null];

$conexion = mysqli_connect($db_host, $db_user, $db_pass);
$countProducts = 0;
$sum = 0;
if (mysqli_connect_errno()) {

  echo "no se puede conectar a la base de datos";

  exit();
}
mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");
$query = "SELECT p.id, date_format(p.fecha, '%d/%m/%Y') as fecha, dp.id_producto,pro.nombre,
           sum(dp.cantidad)as cantidad_platos , sum(dp.precio * dp.cantidad) as vendido 
           FROM detalle_pedido as dp 
           INNER JOIN productos as pro ON pro.id = dp.id_producto 
           INNER JOIN pedidos as p ON p.id = dp.id_pedido 
           WHERE date_format(p.fecha, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d') 
           GROUP BY(dp.id_producto) order by cantidad_platos desc
";
$rs = mysqli_query($conexion, $query);
include_once '../views/app.view.php';
mysqli_close($conexion);
