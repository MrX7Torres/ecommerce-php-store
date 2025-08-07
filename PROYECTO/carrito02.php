<?php
require "sesion_iniciada.php";
if($_SESSION['clienteID'] == ''){
    header("Location: login_cliente.php");
}
?>
<html>
<head>
    <title>Carrito N1</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            border: 3px solid #ccc;
        }
        .title {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        .header, .row {
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .header {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .cell {
            flex: 1;
            padding: 10px;
            text-align: center;
        }
        .cell img {
            max-width: 100%;
            max-height: 100%;
        }
        .btn-container {
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<script src="ADMIN/funciones/jquery-3.3.1.min.js"></script>
    <script>
        function finalizarPedido() {
            $.ajax({
                url: 'pedir_carrito.php',
                type: 'post',
                dataType: 'text',
                success: function(resp) {
                    console.log(resp);
                    if (resp == 1) {
                        alert('Pedido finalizado correctamente');
                        window.location.href = 'home.php'; 
                    } else {
                        alert('Error al finalizar el pedido');
                    }
                },
                error: function() {
                    alert('Error en la conexión');
                }
            });
        }
    </script>
    <?php include ('menu_clientes.php'); ?>
    <div class="container">
        <h2 class="title">Pedido 2/2</h2>
        <div class="header">
            <div class="cell">Producto</div>
            <div class="cell">Cantidad</div>
            <div class="cell">Costo unitario</div>
            <div class="cell">Subtotal</div>
        </div>
        <?php
            require "ADMIN/funciones/conecta.php";
            $con = conecta();
            $total = 0;

        $estado = "SELECT id FROM pedidos WHERE status = 0 AND id_cliente = '$idCliente'";
        $est = $con->query($estado);

        if ($est->num_rows > 0) {
            $pedidoAct = $est->fetch_array();
            $idPedido = $pedidoAct['id'];

            $pedidos = "SELECT * FROM pedidos_productos WHERE id_pedido = '$idPedido'";
            $pedido = $con->query($pedidos);

            while ($ped = $pedido->fetch_array()) {
                $cantidad = $ped["cantidad"];
                $id_producto = $ped["id_producto"];

                $sql = "SELECT * FROM productos WHERE id = $id_producto";
                $res = $con->query($sql);

                if ($res->num_rows > 0) {
                    $row = $res->fetch_array();
                    $nombre = $row["nombre"];
                    $costo = $row["costo"];
                    $stock = $row["stock"];
                    $subtotal = $costo * $cantidad;
                    $total += $subtotal;
        ?>
        <div class="row">
            <div class="cell"><?php echo $nombre; ?></div>
            <div class="cell"><?php echo $cantidad; ?></div>
            <div class="cell"><?php echo "$" . $costo; ?></div>
            <div class="cell"><?php echo "$" . $subtotal; ?></div>
        </div>
        <?php 
                }
            }
        } else {
            echo "<div class='row'><div class='cell'>No hay productos en el carrito.</div></div>";
        }
        ?>
        <div class="row">
            <div class="cell">Total: <?php echo "$" . $total; ?></div>
        </div>
    </div>
    <div class="cell">
        <a class="btn" href="carrito01.php">Volver</a>
        <a class="btn" href="javascript:void(0);" onclick="finalizarPedido()">Enviar pedido</a>
    </div>
    <?php include ('piePagina.php'); ?>
</body>
</html>