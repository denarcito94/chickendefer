<?php
session_start();
if (isset($_POST)) {
  $path = $_SERVER['HTTP_REFERER'];
  if (!$_POST['username'] || !$_POST['password']) {
    $_SESSION['errors'] = [
      'El usuario y la contraseña son requeridos'
    ];
    header("location:" . $path);
    exit();
  }

  require_once "../config/datos_conexion.php";

  $conexion = mysqli_connect($db_host, $db_user, $db_pass);
  mysqli_select_db($conexion, $db_nombre) or die("no se encontro ninguna base de datos");
  mysqli_set_charset($conexion, "utf8");
  if (mysqli_connect_errno()) {
    echo "no se puede conectar a la base de datos";
    exit();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = '${username}'";
  $result = mysqli_query($conexion, $sql);
  $rows = mysqli_num_rows($result);
  $record = mysqli_fetch_assoc($result);

  if ($rows == 0 || sha1($password) != $record['_password']) {
    $path = $_SERVER['HTTP_REFERER'];
    $_SESSION['errors'] = [
      'Usuario y/o contraseña invalidas'
    ];
    header("location:" . $path);
    exit();
  }

  $_SESSION['user'] = $record;
  header("location:" . $path . 'admin');
}
