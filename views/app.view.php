<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/main.css">
</head>

<body>

  <div class="container-fluid">
    <div class="row justify-content-center align-content-center">
      <div class="col-8 barra">
        <h4 class="text-light mb-o">Chickender</h4>
      </div>
      <div class="col-4 text-right barra">
        <ul class="navbar-nav mr-auto">
          <li>
            <span href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle user mr-2"></i>
              <?= $user['username'] ?>
            </span>

            <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
              <a class="dropdown-item menuperfil cerrar" href="../php/logout.php"><i class="fas fa-sign-out-alt m-1"></i>Salir
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="barra-lateral col-12 col-sm-auto">
        <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
          <a id="go" href="./#go"><i class="fas fa-home"></i><span>Inicio</span></a>
          <a id="productos" href="../Registro_producto.php#productos"><i class="fas fa-store"></i><span>Productos</span></a>
          <a id="clientes" href="../Registro_cliente.php#clientes"><i class="fas fa-users"></i><span>Clientes</span></a>
          <a id="newpedidos" href="../Registro_pedidos.php#newpedidos"><i class="fas fa-plus"></i><span> Nuevo Pedido</span></a>
          <a id="pedidos" href="../pedidos.php#pedidos"><i class="fas fa-clipboard-list"></i><span>Pedidos</span></a>
        </nav>
      </div>
      <main class="main col pt-4 px-4">
        <!-- TABLE -->
        <div id="print-card" class="card shadow">
          <div class="card-header">
            <span class="d-block h4">Resumen de Hoy <?= date("d/m/Y") ?></span>
            <button onclick="print()" class="btn btn-danger btn-sm" href="#">Exportar <i class="far fa-file-pdf"></i></button>
          </div>
          <div class="card-body">
            <img src="../imagen/LOGO.png" alt="Brand Chicken">
            <?php if (mysqli_num_rows($rs) > 0) : ?>
              <table class="table table-sm table-hover">
                <thead>
                  <tr>
                    <th scope="col">° Pedido</td>
                    <th scope="col">Fecha</td>
                    <th scope="col">Producto</th>
                    <th scope="col">Realizados</th>
                    <th scope="col">Total Vendido</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($p = mysqli_fetch_array($rs)) : ?>
                    <tr>
                      <th scope="row"><?= $p['id'] ?></th>
                      <td><?= $p['fecha'] ?></td>
                      <td><?= $p['nombre'] ?></td>
                      <td><?= $p['cantidad_platos'] ?></td>
                      <td><?= $p['vendido'] ?> Bs.</td>
                    </tr>
                    <?php $countProducts += $p['cantidad_platos'];
                    $sum += $p['vendido'] ?>
                  <?php endwhile ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total: <?= $countProducts ?></b></td>
                    <td><b>Total: <?= $sum ?>Bs.</b></td>
                  </tr>
                </tbody>
                <tfoot>

                </tfoot>
              </table>
            <?php else : ?>
              <span class="d-block h3">No se han encontrados ventas hoy.</span>
            <?php endif ?>
          </div>
        </div>
        <!-- TABLE -->
      </main>
    </div>
  </div>





  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/646c794df3.js"></script>
  <script src="../html2pdf.bundle.min.js"></script>
  <script src="../codigo.js"></script>
  <script>
    const print = () => {

      const $print = document.querySelector('#print-card')
      $print.classList.remove('shadow')
      $print.classList.add('border-0')
      const opt = {
        margin: 1,
        filename: 'summary.pdf',
        image: {
          type: 'jpeg',
          quality: 1
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

      html2pdf()
        .set(opt)
        .from($print)
        .save()
        .catch(err => {
          console.error("Error print document:" + err)
        })

      const interval = setInterval(() => {
        $print.classList.remove('border-0')
        $print.classList.add('shadow')
        clearInterval(interval)
      })
    }
  </script>
</body>

</html>