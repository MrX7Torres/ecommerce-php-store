<?php
require "sesion_iniciada.php";
if($_SESSION['clienteID'] == ''){
    header("Location: login_cliente.php");
}
?>
<html>
<head>
    <title>Compra de Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .cell {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            border: 3px solid #fff;
            text-align: center;
            margin-bottom: 20px;
        }
        .cell img {
            width: 150px;
            height: 150px;
            margin-bottom: 10px;
        }
        .btn {
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
        .form-group {
            margin-top: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input {
            padding: 12px 22px;
            font-size: 16px;
            
        }
    </style>
</head>
<body>
    <?php include('menu_clientes.php'); ?>
    <div class="container">
        <?php
            require "ADMIN/funciones/conecta.php";
            $con = conecta();
            $id = $_REQUEST['id'];
            
            $sql = "SELECT * FROM productos WHERE id = $id";
            $res = $con->query($sql);

            while ($row = $res->fetch_array()) {
                $nombre = $row["nombre"];
                $costo = $row["costo"];
                $codigo = $row["codigo"];
                $stock = $row["stock"];
                $productos = $row["archivo"];
        ?>
        <div class="cell">
            <img src="ADMIN/imgProductos/<?php echo $productos; ?>" alt="<?php echo $nombre; ?>">
            <h2><?php echo $nombre; ?></h2>
            <p><strong>Costo:</strong> $<?php echo $costo; ?></p>
            <form action="agregar_carrito.php?id=<?php echo $id; ?>" method="POST" class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="<?php echo $stock?>">
                <input type="hidden" name="id_producto" value="<?php echo $id; ?>">
                <br><br><input type="submit" class="btn" value="Agregar al carrito">
            </form>
        </div>
        <?php } ?>
    </div>
    <?php include ('piePagina.php'); ?>
</body>
</html>