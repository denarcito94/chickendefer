<?php
session_start();

if (isset($_SESSION) && $_SESSION['user']) {
  $path = $_SERVER['HTTP_REFERER'];
  header("location:" . $path . 'menu.php');
} else {
  $errors = $_SESSION['errors'] ?? [];
  include_once 'views/home.view.php';

  unset($_SESSION['errors']);
  session_destroy();
}
