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
        .promo {
            text-align: center;
            margin-bottom: 20px;
        }
        .promo img {
            width: 600px;
            height: 300px;
            border: 3px solid #007bff;
            display: block;
            margin: 0 auto;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .cell {
            flex: 0 1 calc(33% - 10px);
            box-sizing: border-box;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            text-align: center;
            padding: 10px;
        }
        .cell:hover {
            transform: translateY(-5px);
        }
        .cell img {
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto 10px;
        }
        .cell a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 16px;
        }
        .cell p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
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
        <?php
            require "ADMIN/funciones/conecta.php";
            $con = conecta();
            
            $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
            $res = $con->query($sql);
            $promocion = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0";
            $promos = $con->query($promocion);
            $conteo = 0;

            $promociones = [];
            while ($promo = $promos->fetch_array()) {
                $promociones[] = $promo;
            }

            if (count($promociones) > 0) {
                $laPromo = $promociones[array_rand($promociones)];
                $promoFoto = $laPromo["archivo"];
        ?>
            <div class="promo">
                <img src="ADMIN/imgPromociones/<?php echo $promoFoto; ?>">
            </div>
        <?php
            }
            while ($row = $res->fetch_array()) {
                if ($conteo >= 6){
                    break;
                }
                if ($conteo % 3 == 0) {
                    if ($conteo > 0) {
                        echo '</div>'; 
                    }
                    echo '<div class="row">'; 
                }
                $id = $row["id"];
                $nombre = $row["nombre"];
                $codigo = $row["codigo"];
                $costo = $row["costo"];
                $productos = $row["archivo"];
        ?>
            <div class="cell">
                <a href="productos_detalle.php?id=<?php echo $id; ?>">
                    <img src="ADMIN/imgProductos/<?php echo $productos; ?>">
                </a>
                <br><a href="productos_detalle.php?id=<?php echo $id; ?>"><?php echo $nombre; ?></a>
                <br><?php echo "Código: ", $codigo; ?>
                <br><?php echo "$" . $costo; ?>
                <div class="btn-container">
                    <a class="btn" href="comprar_producto.php?id=<?php echo $id; ?>">Comprar</a>
                </div>
            </div>
        <?php
                $conteo++;
            }
            if ($conteo % 3 != 0) {
                echo '</div>'; 
            }
        ?>
    </div>
    <?php include ('piePagina.php'); ?>
</body>
</html>
