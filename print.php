<?php
$data = $_GET ?? null;
$body = [];
$products = [];
$total = 0;

if (isset($_GET) && $data) {

  $code = $_GET['code'];
  $code = base64_decode($code);

  require_once __DIR__ . '/config/datos_conexion.php';
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

  $query = "SELECT dp.id_producto, pr.nombre , dp.precio, dp.cantidad FROM detalle_pedido as dp
            INNER JOIN productos as pr
              ON pr.id = dp.id_producto
            WHERE dp.id_pedido = $code
  ";
  $rs = mysqli_query($conexion, $query);
  $row = mysqli_num_rows($rs);

  if ($row < 0) $products = [];

  $records = mysqli_fetch_all($rs, MYSQLI_ASSOC);

  $products = $records;
  mysqli_close($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del Pedido</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>

<body>
  <div class="container px-5 pt-3">
    <div class="card border-0" id="print-card">
      <div class="card-header pt-3 bg-white border-0">
        <h1 class="h4 text-center">Pedido</h1>
        <p class="h6 "><b>Pedido:</b> <?= $body['id'] ?>|<?= sha1($body['id']) ?></p>
        <p class="h6 "><b>Fecha:</b> <?= $body['fecha'] ?></p>
        <hr>
        <h1 class="h4 text-center p-3">Datos del Cliente</h1>
        <div class="d-flex justify-content-between">
          <span class="h6 m-0"><b>NIT:</b> <?= $body['nit'] ?></span>
          <span class="h6 m-0"><b>Cliente:</b> <?= $body['nombres'] ?></span>
          <span class="h6 m-0"><b>Teléfono:</b> <?= $body['telefono'] ?></span>
          <span class="h6 m-0"><b>Dirección:</b> <?= $body['direccion'] ?></span>
        </div>
        <hr>
      </div>
      <div class="card-body">
        <ul id="cart-list" class="list-group">
          <?php foreach ($products as $p) : ?>
            <li class="list-group-item mb-2 border-0">
              <div class="d-flex justify-content-between">
                <span class="d-block"><b>Nombre</b></span>
                <span class="d-block"><b>Precio</b></span>
                <span class="d-block"><b>Cantidad</b></span>
                <span class="d-block"><b>Total</b></span>
              </div>
              <div class="d-flex justify-content-between">
                <span><?= $p['nombre'] ?></span>
                <span><?= $p['precio'] ?>Bs.</span>
                <span><?= $p['cantidad'] ?></span>
                <span><?= $p['cantidad'] * $p['precio']  ?>Bs.</span>
              </div>
            </li>
            <?php $total += $p['cantidad'] * $p['precio'] ?>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="card-footer bg-white border-0">
        <p><b>Productos:</b> <?= count($products) ?></p>
        <p><b>Total:</b> <?= $total ?>Bs.</p>
        <button onclick="print(event)" class="btn btn-primary">Imprimir</button>
      </div>
    </div>
  </div>
  <script src="./html2pdf.bundle.min.js"></script>
  <script>
    const print = (e) => {
      const $print = document.querySelector('#print-card')
      const $target = e.target
      const opt = {
        margin: 1,
        filename: 'pedido.pdf',
        image: {
          type: 'jpeg',
          quality: 0.98
        },
        html2canvas: {
          scale: 1
        },
        jsPDF: {
          unit: 'in',
          format: 'letter',
          orientation: 'portrait'
        }
      };
      $target.remove()

      html2pdf()
        .set(opt)
        .from($print)
        .save()
        .catch(err => {
          console.error("Error print document:" + err)
        })

      let interval = setInterval(() => {
        window.location = "pedidos.php#pedidos"
        clearInterval(interval)
      }, 3000)


    }
  </script>
</body>

</html>