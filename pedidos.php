<?php
require_once "config/datos_conexion.php";
session_start();

$user = $_SESSION['user'] ?? ['username' => null];
if (!$user["username"]) {
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(
			session_name(),
			'',
			time() - 42000,
			$params["path"],
			$params["domain"],
			$params["secure"],
			$params["httponly"]
		);
	}
	session_destroy();
	echo "<script>window.location = './'</script>";
	exit;
}
$conexion = mysqli_connect($db_host, $db_user, $db_pass);

if (mysqli_connect_errno()) {

	echo "no se puede conectar a la base de datos";

	exit();
}
mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");

mysqli_set_charset($conexion, "utf8");

$query = "SELECT p.id, date_format(p.fecha, '%d/%m/%Y %H:%i %p') as fecha, p.total,c.nit, CONCAT(c.nombre, ' ', c.apellido_paterno) as nombres, c.direccion, c.telefono FROM pedidos as p INNER JOIN clientes as c ON c.id = p.id_cliente ORDER BY fecha DESC";

$resultado = mysqli_query(
	$conexion,
	$query
);

mysqli_close($conexion);


?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registro_Producto</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/main.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

<body x-data="setup()">

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
					<a id="newpedidos" href="Registro_pedidos.php#newpedidos"><i class="fas fa-plus"></i><span> Nuevo Pedido</span></a>
					<a id="pedidos" href="pedidos.php#pedidos"><i class="fas fa-clipboard-list"></i><span>Pedidos</span></a>
				</nav>
			</div>
			<main class="main col pt-4 px-4">
				<span class="d-block h4">Pedidos</span>
				<!-- TABLE -->
				<div class="card shadow p-3">
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th scope="col">#</td>
								<th scope="col">Fecha</td>
								<th scope="col">Total</th>
								<th scope="col">Nit</th>
								<th scope="col">Nombres</th>
								<th scope="col">Dirrección</th>
								<th scope="col">Detalles</th>
								<th scope="col">Exportar

								</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($p = mysqli_fetch_array($resultado)) : ?>
								<tr>
									<th scope="row"><?= $p['id'] ?></th>
									<td><?= $p['fecha'] ?></td>
									<td><?= $p['total'] ?> Bs.</td>
									<td><?= $p['nit'] ?></td>
									<td><?= $p['nombres'] ?></td>
									<td><?= $p['direccion'] ?></td>
									<td><button x-on:click="openDetail(<?= $p['id'] ?>)" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button></td>
									<td><a href="print.php?code=<?= base64_encode($p['id']) ?>" class="btn btn-primary btn-sm"><i class="far fa-file-pdf"></i></a></td>
								</tr>
							<?php endwhile ?>
						</tbody>
					</table>
				</div>
				<!-- TABLE -->
			</main>
		</div>
	</div>
	<!-- BOX SEARCH CLIENTES -->
	<div id="modal-detail" class="modal-detail card shadow rounded" x-transition x-show="showModal">
		<!-- <div class="card-loader d-flex">
			<span class="card-spinner"></span>
		</div> -->
		<div class="card-header">
			<div class="d-flex justify-content-between">
				<span class=" d-block h5" x-text="'Pedido N°' + detail.id"></span>
				<button x-on:click="showModal = false" class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></button>
			</div>
			<hr>
			<span class="d-block" x-text="'Cliente: ' + detail.nombres"></span>
			<span class="d-block" x-text="'Telefono: ' + detail.telefono"></span>
			<span class="d-block" x-text="'Direccion: ' + detail.direccion"></span>
		</div>

		<div class="card-body" style="overflow-x: hidden; overflow-y: auto;">
			<ul id="cart-list" class="list-group">
				<template x-for="p in products">
					<li class="list-group-item mb-2">
						<div class="d-flex justify-content-between">
							<span class="d-block">Nombre</span>
							<span class="d-block">Precio</span>
							<span class="d-block">Cantidad</span>
							<span class="d-block">Total</span>
						</div>
						<div class="d-flex justify-content-between">
							<span x-text="p.nombre"></span>
							<span x-text="p.precio+'Bs.'"></span>
							<span x-text="p.cantidad"></span>
							<span x-text="p.cantidad * p.precio + 'Bs.'"></span>
						</div>

					</li>
				</template>
			</ul>
		</div>
		<div class="card-footer d-flex flex-column">
			<span x-text="'Productos: ' + products.length"></span>
			<span x-text="'Total: ' + detail.total + 'Bs.'"></span>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/646c794df3.js"></script>
	<script src="./codigo.js"></script>
	<script>
		const setup = () => {
			return {
				init() {
					this.showModal = false
				},
				showModal: false,
				detail: {},
				products: [],
				async getItem(id) {

					const res = await axios.get(`php/ajax_pedido_get.php?code=${id}`)
					const {
						data
					} = res
					this.detail = data.body
					this.products = data.body.products

				},
				openDetail(id) {
					this.showModal = true
					this.getItem(id)
				},
				closeDetail() {
					this.detail = null
					this.showModal = false
				}
			}
		}
	</script>
</body>

</html>