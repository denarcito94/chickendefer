<?php



session_start();
$user = $_SESSION['user'] ?? null;


if (isset($_SESSION) && $user) {
  $path = $_SERVER['HTTP_REFERER'];
  header("location:" . $path . 'admin');
} else {
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
  $path =  $_SERVER['HTTP_REFERER'];

  header("location:" . $path);
}
