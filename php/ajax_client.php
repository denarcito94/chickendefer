<?php
$q = $_GET['q'] ?? null;
if (isset($_GET) && $q) {
  require_once __DIR__ . '/../config/datos_conexion.php';
  $conexion = mysqli_connect($db_host, $db_user, $db_pass);

  if (mysqli_connect_errno()) {
    echo "no se puede conectar a la base de datos";
    exit();
  }
  mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");
  mysqli_set_charset($conexion, "utf8");
  $consulta = "SELECT * FROM clientes WHERE nombre LIKE '%${q}%' OR nit LIKE '${q}%'";
  $result = mysqli_query($conexion, $consulta);
  $body = [];

  foreach (mysqli_fetch_all($result) as $i) {

    $body[] = [
      'id' => $i[0],
      'nit' => $i[1],
      'names' => $i[2],
      'last_name' => $i[3] . ' ' . $i[4],
      'address' => $i[5],
      'phone' => $i[6]
    ];
  }




  header("Content-Type: application/json");

  echo json_encode([
    "statusCode" => 200,
    "body" => $body
  ]);

  exit();
}

header("Content-Type: application/json");
echo json_encode([
  "statusCode" => 500,
  "body" => "SERVER INTERNAL ERROR"
]);
