<?php

echo $path  = $_SERVER['HTTP_HOST'] . $_SERVER['HTTP_HOST'];

echo explode('/', $_REQUEST['PHP_SELF']);

?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="<?= $path ?>/css/main.css">