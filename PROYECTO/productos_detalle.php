<html>
<head>
    <title>Detalle de Producto</title>
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cell {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .cell:hover {
            transform: translateY(-5px);
        }
        .cell img {
            width: 250px;
            height: 250px;
            margin-bottom: 20px;
        }
        .cell h2 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .cell p {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }
        .cell p strong {
            color: #333;
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
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
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
                $codigo = $row["codigo"];
                $descripcion = $row["descripcion"];
                $costo = $row["costo"];
                $productos = $row["archivo"];
        ?>
        <div class="cell">
            <img src="ADMIN/imgProductos/<?php echo $productos; ?>" alt="<?php echo $nombre; ?>">
            <h2><?php echo $nombre; ?></h2>
            <p><strong>Código:</strong> <?php echo $codigo; ?></p>
            <p><strong>Costo:</strong> $<?php echo $costo; ?></p>
            <p><strong>Descripción:</strong><br><?php echo nl2br($descripcion); ?></p>
            <a class="btn" href="comprar_producto.php?id=<?php echo $id; ?>">Comprar</a>
        </div>
        <?php } ?>
    </div>
    <?php include ('piePagina.php'); ?>
</body>
</html>
