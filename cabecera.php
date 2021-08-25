<?php
session_start();

if(!isset($_SESSION['contador'])){$_SESSION['contador']=0;}
?>

<script type="text/javascript" src="codigo.js"></script>
<script type="text/javascript" src="jquery.js" ></script>
<div style="position: absolute;margin-left: 470px;top: 75px;clear: both;width: 300px;float: right;padding: 15px;border-radius: 5px;box-shadow: 0px 10px 15px #d9d0d0;
    border: 1px solid #c8c7c7;">
<div id="carrito" style="background:white;color:black;">Carrito</div>
<br>
<a href="php/destruir.php"><button class="btn btn-danger">Vaciar carrito</button></a>
<a href="php/confirmar.php"><button class="btn btn-success">Confirmar</button></a>
</div>