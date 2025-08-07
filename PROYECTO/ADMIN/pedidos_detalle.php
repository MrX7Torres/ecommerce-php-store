<?php
require "inicio_sesion.php";
if ($_SESSION['nombreUser'] == '') {
    header("Location: index.php");
}
require "funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];
?>
<html>
<head>
    <title>Detalle de pedido</title>
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
            border: 3px solid #fff;
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
    <?php include('menu.php'); ?>
    <div class="container">
        <h2 class="title">Detalles de pedido: <?php echo $id ?></h2>
        <div class="header">
            <div class="cell">id_producto</div>
            <div class="cell">cantidad</div>
            <div class="cell">Costo unitario</div>
            <div class="cell">Subtotal</div>
        </div>
        <?php
        
        $total = 0;

        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id'";
        $res = $con->query($sql);

        while ($row = $res->fetch_array()) {
            $idProducto = $row["id_producto"];
            $cantidad = $row["cantidad"];
            $costo    = $row["precio"];
            $subtotal = $costo * $cantidad;
            $total   += $subtotal;
        ?>
        <div class="row">
            <div class="cell"><?php echo $idProducto; ?></div>
            <div class="cell"><?php echo $cantidad; ?></div>
            <div class="cell"><?php echo "$" . $costo; ?></div>
            <div class="cell"><?php echo "$" . $subtotal; ?></div>
        </div>
        <?php }?>
        <div class="row">
            <div class="cell">Total: <?php echo "$" . $total; ?></div>
        </div>
        <div class="cell">
            <a class="btn" href="pedidos_lista.php">Volver</a>
        </div>
</body>
</html>