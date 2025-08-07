<?php
require "sesion_iniciada.php";
if ($_SESSION['clienteID'] == '') {
    header("Location: login_cliente.php");
}
require "ADMIN/funciones/conecta.php";
$con = conecta();

if (isset($_POST['cantidad'])) {
    $cantidad = $_POST['cantidad'];
    $id = $_REQUEST['id'];

    $estado = "SELECT * FROM pedidos WHERE status = 0 AND id_cliente = '$idCliente'";
    $est = $con->query($estado);

    if ($est->num_rows > 0) {
        $pedido = $est->fetch_array();
        $idPedido = $pedido['id'];
    } else {
        $fecha = date('Y-m-d H:i:s');
        $insertaPedido = "INSERT INTO pedidos (fecha, id_cliente, status) VALUES (NOW(), '$idCliente', 0)";
        $con->query($insertaPedido); 
        $idPedido = $con->insert_id;
    }

    $sql = "SELECT * FROM productos WHERE id = $id";
    $res = $con->query($sql);

    if ($row = $res->fetch_array()) {
        $costo = $row["costo"];

        $verificaProducto = "SELECT * FROM pedidos_productos WHERE id_pedido = '$idPedido' AND id_producto = '$id'";
        $verificaRes = $con->query($verificaProducto);

        if ($verificaRes->num_rows > 0) {
            $productoCarrito = $verificaRes->fetch_array();
            $nuevaCantidad = $productoCarrito['cantidad'] + $cantidad;
            $actualizaCarrito = "UPDATE pedidos_productos SET cantidad = '$nuevaCantidad' WHERE id_pedido = '$idPedido' AND id_producto = '$id'";
            $con->query($actualizaCarrito);
        } else {
            $insertaCarrito = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ('$idPedido', '$id', '$cantidad', '$costo')";
            $con->query($insertaCarrito);  
        }
    }
} 
include ('piePagina.php'); 
header("Location: home.php");
?>
