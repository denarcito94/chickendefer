<?php


session_start();
$user = $_SESSION['user'] ?? null;
$errors = $_SESSION['errors'] ?? [];

if (isset($_SESSION) && $user) {
  $path = $_SERVER['HTTP_REFERER'];
  header("location:" . $path . 'admin');
} else {

  include_once 'views/home.view.php';
  unset($_SESSION);
  session_destroy();
}
