<?php
require "inicio_sesion.php";
if ($_SESSION['nombreUser'] == '') {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Producto</title>
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
            font-size: 24px;
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
    <?php include ('menu.php'); ?>
    <div class="btn-container">
        <form action="productos_lista.php">
            <input type="submit" value="Regresar" class="btn">
        </form>
    </div>
    <div class="container">
        <div class="title">
            <?php 
            $id = $_REQUEST['id'];
            echo "Detalles de producto con id: $id"; 
            ?>
        </div>
        <div class="header">
            <div class="cell">Nombre</div>
            <div class="cell">Código</div>
            <div class="cell">Descripción</div>
            <div class="cell">Costo</div>
            <div class="cell">Stock</div>
            <div class="cell">Status</div>
            <div class="cell">Foto</div>
        </div>
        <?php
            require "funciones/conecta.php";
            $con = conecta();
            
            $sql = "SELECT * FROM productos WHERE id = $id";
            $res = $con->query($sql);

            while ($row = $res->fetch_array()) {
                $nombre = $row["nombre"];
                $codigo = $row["codigo"];
                $descripcion = $row["descripcion"];
                $costo = $row["costo"];
                $stock = $row["stock"];
                $status = $row["status"] == 1 ? 'activo' : 'inactivo';
                $foto = $row["archivo"];
        ?>
        <div class="row">
            <div class="cell"><?php echo $nombre; ?></div>
            <div class="cell"><?php echo $codigo; ?></div>
            <div class="cell"><?php echo $descripcion; ?></div>
            <div class="cell"><?php echo "$" . $costo; ?></div>
            <div class="cell"><?php echo $stock; ?></div>
            <div class="cell"><?php echo $status; ?></div>
            <div class="cell"><img src="imgProductos/<?php echo $foto; ?>"></div>
        </div>
        <?php } ?>
    </div>
</body>
</html>
