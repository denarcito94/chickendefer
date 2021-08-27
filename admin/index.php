<?php

session_start();

$user = $_SESSION['user'];

include_once '../views/app.view.php';
