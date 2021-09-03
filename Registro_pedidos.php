<?php
require_once "config/datos_conexion.php";

session_start();
$errors = $_SESSION['errors'] ?? [];
$status = $_SESSION['status'] ?? null;
$user = $_SESSION['user'] ?? ['username' => null];
$conexion = mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {
	echo "no se puede conectar a la base de datos";
	exit();
}
mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");
mysqli_set_charset($conexion, "utf8");
$consulta = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $consulta);
?>
<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Sistema de Gestion Chikendefer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/main.css">


</head>
<style>
	.btn_reg {
		background: #0C6094;
		color: white;
		width: 100px;
		padding: 10px;
		font-family: sans-serif;
		font-size: 20px;
		border-radius: 5px;

	}

	.lbl_text {
		width: 350px;
		padding: 10px;
		font-family: sans-serif;
		font-size: 15px;
	}
</style>

<body style="overflow-x: hidden;">
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
							<a class="dropdown-item menuperfil cerrar" href="php/logout.php"><i class="fas fa-sign-out-alt m-1"></i>Salir
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
					<a id="go" href="admin/#go"><i class="fas fa-home"></i><span>Inicio</span></a>
					<a id="productos" href="Registro_producto.php#productos"><i class="fas fa-store"></i><span>Productos</span></a>
					<a id="clientes" href="Registro_cliente.php#clientes"><i class="fas fa-users"></i><span>Clientes</span></a>
					<a id="pedidos" href="Registro_pedidos.php#pedidos"><i class="fas fa-list"></i><span>Pedidos</span></a>
				</nav>
			</div>
			<main class="main col px-5 row justify-content-between">
				<!-- GRID PEDIDOS -->
				<div id="shop-card" class="col-6 h-75 card pt-3">
					<h5 class="mb-3">Lista de productos</h5>
					<?php while ($p = mysqli_fetch_array($resultado)) : ?>
						<div class="card shadow mb-3 rounded" style="max-width: 540px;">
							<div class="row no-gutters">
								<div class="col-md-4">
									<img class="img-fluid h-100" src="imagen/<?= $p['imagen'] ?>" alt="image product">
								</div>
								<div class="col-md-8">
									<form onsubmit="getItemForm(event)" method="POST" class="card-body">
										<input type="hidden" name="id" value="<?= $p['id'] ?>">
										<input type="hidden" name="name" value="<?= $p['nombre'] ?>">
										<input type="hidden" name="codigo" value="<?= $p['codigo'] ?>">
										<input type="hidden" name="price" value="<?= $p['precio'] ?>">
										<h5 class="card-title"><?= $p['nombre'] ?> - COD <?= $p['codigo'] ?></h5>
										<p class="card-text">Precio: <span class="text-success"><?= $p['precio'] ?> Bs.</span></p>
										<p class="card-text">
											<input class="form-control mb-2" type="number" name="count" value="0">
											<button type="submit" class="btn btn-sm btn-success">Agregar</button>
										</p>
									</form>
								</div>
							</div>
						</div>
					<?php endwhile ?>
				</div>
				<div class="col-5 h-75 card p-0">
					<div class="card-header">
						<div class="header-CTA d-flex justify-content-between">
							<h5>Carrito</h5>
							<div>
								<button class="btn btn-sm btn-danger" onclick="cleanCart()">Vaciar lista <i class="fas fa-trash"></i></button>
								<button class="btn btn-sm btn-success">Procesar <i class="fas fa-check"></i></button>
							</div>
						</div>
						<hr>
						<div class="header-datail d-flex justify-content-between">
							<span class="text-dark">Nombre</span>
							<span class="text-dark">Precio</span>
							<span class="text-dark">Cantidad</span>
							<span class="text-dark">Total</span>
						</div>
					</div>
					<div class="card-body" style="overflow-y: auto;">
						<ul id="cart-list" class="list-group">
							<li class="list-group-item">Carrito Vacio :(</li>
						</ul>
					</div>
					<div class="card-footer">
						<span id="total">Total a pagar: 0 Bs.</span><br>
						<span id="count-products">Total de Productos : 0</span>
					</div>
				</div>
				<!-- GRID PEDIDOS -->
			</main>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/646c794df3.js"></script>
	<script src="./codigo.js"></script>
	<script src="./cart.js"></script>


</body>

</html>

<?php

unset($_SESSION['errors'], $_SESSION['status']);
