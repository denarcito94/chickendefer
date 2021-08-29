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
        <h4 class="text-light">Logo</h4>
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
          <a id="go" href=".#go"><i class="fas fa-home"></i><span>Inicio</span></a>
          <a id="productos" href="../Registro_producto.php#productos"><i class="fas fa-store"></i><span>Productos</span></a>
          <a id="clientes" href="../Registro_cliente.php#clientes"><i class="fas fa-users"></i><span>Clientes</span></a>
          <a id="pedidos" href="../Registro_pedidos.php#pedidos"><i class="fas fa-list"></i><span>Pedidos</span></a>
        </nav>
      </div>
      <main class="main col">
        <div class="row justify-content-center align-content-center text-center">
          <div class="columna col-lg-6">
            CONTENIDO
          </div>

        </div>

      </main>
    </div>
  </div>





  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/646c794df3.js"></script>
  <script src="../codigo.js"></script>
</body>

</html>