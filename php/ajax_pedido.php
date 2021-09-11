<?php
$data = $_POST ?? null;



if (isset($_POST) && $data) {
  require_once __DIR__ . '/../config/datos_conexion.php';

  $clientId = $_POST['client']['id'];
  $total = $_POST['total'];
  $products = ($_POST['products']);
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
  mysqli_begin_transaction($conexion);
  $query = "INSERT INTO pedidos (id_cliente, total) VALUES ('${clientId}', '${total}')";
  $rs = mysqli_query($conexion, $query);

  if (!$rs) {
    mysqli_rollback($conexion);
    mysqli_close($conexion);
    echo json_encode([
      "statusCode" => 500,
      "body" => "No se pudo completar su operación, verifique sus datos e intente de nuevo",
    ]);
    exit;
  }

  $query = "SELECT id FROM pedidos ORDER by id DESC LIMIT 1";
  $rs = mysqli_query($conexion, $query);
  $id = mysqli_fetch_assoc($rs)['id'];

  foreach ($products as $p) {
    $productId = intval($p['id']);
    $query = "INSERT INTO detalle_pedido (id_pedido, id_producto, precio, cantidad)
              VALUES ('${id}', ${productId}, " . $p['price'] . "," . $p['count'] . ")";
    $rs = mysqli_query($conexion, $query);

    if (!$rs) {
      echo json_encode([
        "statusCode" => 500,
        "body" => "No se pudo completar su operación, verifique sus datos e intente de nuevo",
      ]);

      mysqli_rollback($conexion);
      mysqli_close($conexion);
      return;
    }
  }
  mysqli_commit($conexion);
  mysqli_close($conexion);
  echo json_encode([
    "statusCode" => 201,
    "body" => "Su pedido se ha procesado correctamente con ID: ${id}",
    "code" => base64_encode($id)
  ]);

  exit;
}

header("Content-Type: application/json");
echo json_encode([
  "statusCode" => 404,
  "body" => "BAD REQUEST"
]);
