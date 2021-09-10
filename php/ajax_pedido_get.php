<?php
$data = $_GET ?? null;



if (isset($_GET) && $data) {

  $code = intval($_GET['code']);
  require_once __DIR__ . '/../config/datos_conexion.php';
  $conexion = mysqli_connect($db_host, $db_user, '');
  if (mysqli_connect_errno()) {
    echo json_encode([
      "statusCode" => 500,
      "body" => "Servidor fuera de Línea"
    ]);

    exit;
  }

  mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");
  mysqli_set_charset($conexion, "utf8");
  $query = "SELECT p.id, date_format(p.fecha, '%d/%m/%Y %H:%i %p') as fecha, p.total,c.nit, CONCAT(c.nombre, ' ', c.apellido_paterno) as nombres, c.direccion, c.telefono FROM pedidos as p INNER JOIN clientes as c ON c.id = p.id_cliente WHERE p.id = '$code'";
  $rs = mysqli_query($conexion, $query);
  $row = mysqli_num_rows($rs);
  if ($row < 1) {
    echo json_encode([
      "statusCode" => 500,
      "body" => "No se pudo completar su operación, verifique sus datos e intente de nuevo",
    ]);
    exit;
  }

  $body = mysqli_fetch_all($rs, MYSQLI_ASSOC)[0];
  $body['products'] = [];

  $query = "SELECT dp.id_producto, pr.nombre , dp.precio, dp.cantidad FROM detalle_pedido as dp
            INNER JOIN productos as pr
              ON pr.id = dp.id_producto
            WHERE dp.id_pedido = $code
  ";
  $rs = mysqli_query($conexion, $query);
  $row = mysqli_num_rows($rs);

  if ($row < 0) $body['products'] = [];

  $records = mysqli_fetch_all($rs, MYSQLI_ASSOC);

  $body['products'] = $records;

  header("Content-Type: application/json");
  echo json_encode([
    "statusCode" => 200,
    "body" => $body,
  ]);
  mysqli_close($conexion);
  exit;
}

header("Content-Type: application/json");
echo json_encode([
  "statusCode" => 404,
  "body" => $_GET
]);
