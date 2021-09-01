<?php include_once 'layouts/header.view.php'; ?>
<div class="body-home">
  <div class="container">

    <div class="card w-50 mx-auto">
      <form method="POST" action="php/login.php" class="card-body">
        <img class="d-block mx-auto" src="./public/img/LOGO.png" width="220" alt="">
        <span class="d-block h4 mb-4">Inicio de Sesión</span>
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="johndoe95">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="*********">
        </div>
        <div class="form-group">
          <input type="submit" id="password" name="submit" class="btn btn-primary btn-block" value="login">
        </div>
      </form>
      <?php if ($errors) : ?>
        <div class="card-footer bg-white text-danger">
          <ul>
            <?php foreach ($errors as $e) : ?>
              <li><?= $e ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>
<?php include_once 'layouts/footer.view.php'; ?>