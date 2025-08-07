<?php
//promoociones_elimina.php
require "ADMIN/funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

$sql = "DELETE FROM pedidos_productos 
        WHERE id_producto = $id";
$res = $con->query($sql);

header("Location: carrito01.php");
?>