<?php
require "sesion_iniciada.php";
if($_SESSION['clienteID'] == ''){
    header("Location: login_cliente.php");
}
require "ADMIN/funciones/conecta.php";
$con = conecta();
$resp = 0;

$sql = "UPDATE pedidos SET status = 1 WHERE id_cliente = '$idCliente'";
if ($con->query($sql) === TRUE) {
    $resp = 1;
} else {
    echo "Error al actualizar el estado del pedido: " . $con->error;
}
echo $resp;
?>
