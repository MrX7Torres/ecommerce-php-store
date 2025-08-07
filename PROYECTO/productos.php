<html>
<head>
    <title>Menu principal</title>
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
        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .productos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .producto {
            flex: 0 1 calc(33% - 10px);
            box-sizing: border-box;
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .producto:hover {
            transform: translateY(-10px);
        }
        .producto img {
            width: 150px; 
            height: 150px; 
            display: block;
            margin: 20px 0;
        }
        .producto-detalles {
            padding: 15px;
            text-align: center;
        }
        .producto-detalles h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #007bff;
        }
        .producto-detalles p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .producto-detalles .precio {
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }
        .btn-container {
            text-align: center;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="ADMIN/funciones/jquery-3.3.1.min.js"></script>
</head>
<body>
<?php include ('menu_clientes.php'); ?>
    <div class="container">
        <div class="title">Productos</div>
        <div class="productos">
            <?php
                require "ADMIN/funciones/conecta.php";
                $con = conecta();
                
                $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
                $res = $con->query($sql);

                while ($row = $res->fetch_array()) {
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $codigo = $row["codigo"];
                    $costo = $row["costo"];
                    $productos = $row["archivo"];
            ?>
            <div class="producto">
                <a href="productos_detalle.php?id=<?php echo $id; ?>">
                    <img src="ADMIN/imgProductos/<?php echo $productos; ?>" alt="<?php echo $nombre; ?>">
                </a>
                <div class="producto-detalles">
                    <h3><?php echo $nombre; ?></h3>
                    <p>Código: <?php echo $codigo; ?></p>
                    <p class="precio">$<?php echo $costo; ?></p>
                    <div class="btn-container">
                        <a class="btn" href="comprar_producto.php?id=<?php echo $id; ?>">Comprar</a>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php include ('piePagina.php'); ?>
</body>
</html>
