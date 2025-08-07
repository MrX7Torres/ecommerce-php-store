<?php
require "sesion_iniciada.php";
if ($_SESSION['clienteID'] == '') {
    header("Location: login_cliente.php");
}
$idCliente = $_SESSION['clienteID'];
require "ADMIN/funciones/conecta.php";
$con = conecta();

if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $estado = "SELECT id FROM pedidos WHERE status = 0 AND id_cliente = '$idCliente'";
    $est = $con->query($estado);

    if ($est->num_rows > 0) {
        $pedido = $est->fetch_array();
        $idPedido = $pedido['id'];

        $actualizaCarrito = "UPDATE pedidos_productos SET cantidad = '$cantidad' WHERE id_pedido = '$idPedido' AND id_producto = '$id_producto'";
        $con->query($actualizaCarrito);
    }
}

header("Location: carrito01.php");
?>
