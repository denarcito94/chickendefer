<?php
require_once "config/datos_conexion.php";
session_start();
$errors = $_SESSION['errors'] ?? [];
$status = $_SESSION['status'] ?? null;
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

$peticion = "SELECT * FROM productos";
$resultado = mysqli_query(
	$conexion,
	$peticion
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
			<main class="main col pl-3">
				<div class="row text-center">
					<div class="columna col-12">
						<!-- FORM -->
						<div class="mb-3" align="center">
							<div class="w-75 border shandow rounded p-3">
								<div class="container">
									<h4 align="center">Registro Productos</h4>
									<form class="was-validated" action="php/insertar_producto.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<input class="form-control" type="text" name="nombre" placeholder="Ingrese un nombre" required>
											<br>
											<input class="form-control" type="text" name="cod" placeholder="Ingrese codigo" required>
											<br>
											<input class="form-control" type="text" name="precio" placeholder="Ingrese precio" required>
											<br>
											<input type="file" name="imagen"><br><br>
											<input type="submit" name="reg_producto" value="Registrar" class="btn btn-primary">
										</div>
										<?php if ($errors) : ?>
											<div class="card-footer bg-white text-danger">
												<ul>
													<?php foreach ($errors as $e) : ?>
														<li><i class="fas fa-times"></i> <?= $e ?></li>
													<?php endforeach ?>
												</ul>
											</div>
										<?php endif ?>
										<?php if ($status) : ?>
											<div class="card-footer bg-white text-success">
												<span><?= $status ?> <i class="fas fa-check-circle"></i></span>
											</div>
										<?php endif ?>
									</form>
								</div>
							</div>
						</div>
						<!-- FORM -->

						<!-- TABLE -->
						<div class="card shadow">
							<table class="table table-sm .table-responsive">
								<thead>
									<tr>
										<th scope="col">#</td>
										<th scope="col">Producto</td>
										<th scope="col">Codigo</th>
										<th scope="col">Precio</th>
										<th scope="col">Imagen</th>
										<th scope="col">Actualizar</th>
										<th scope="col">Borrar</th>
									</tr>
								</thead>
								<tbody>
									<?php while ($p = mysqli_fetch_array($resultado)) : ?>
										<tr>
											<form action="php/actualizar_producto.php?id=<?= $p['id'] ?>" method="post">
												<th scope="row"><?= $p['id'] ?></th>
												<td><input class="form-control" type="text" name="nombre" value="<?= $p['nombre'] ?>"></td>
												<td><input class="form-control" type="text" name="cod" value="<?= $p['codigo'] ?>"></td>
												<td><input class="form-control" type="text" name="precio" value="<?= $p['precio'] ?>"></td>
												<td><img class="img-fluid rounded" width=" 80" src="imagen/<?= $p['imagen'] ?>" alt="image product"></td>
												<td><button type="submit" class="btn btn-outline-success btn-sm">Actualizar</button></td>
											</form>
											<td><a href="php/eliminar_producto.php?id=<?= $p['id'] ?>" class="btn btn-outline-danger btn-sm">Borrar</a></td>
										</tr>
									<?php endwhile ?>
								</tbody>
							</table>
						</div>
						<!-- TABLE -->
					</div>
				</div>
			</main>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/646c794df3.js"></script>
	<script src="./codigo.js"></script>
</body>

</html>
<?php
unset($_SESSION['errors'], $_SESSION['status']);
