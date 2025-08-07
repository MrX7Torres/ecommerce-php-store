<?php 
require "inicio_sesion.php";
if ($_SESSION['nombreUser'] == '') {
    header("Location: index.php");
}
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM promociones
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Promociones</title>
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
        .header, .producto {
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
            padding: 5px;
            text-align: center;
        }
        .acciones-container {
            display: flex;
            justify-content: center;
            padding: 5px;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            font-size: 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin: 0 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include ('menu.php'); ?>
    <div class="container">
        <h2 class="title">Lista de Promociones (<?php echo $num; ?>)</h2>
        <div class="btn-container">
            <a href="promocion_alta.php" class="btn">Agregar Promocion</a>
        </div>
        <div class="header">
            <div class="cell">ID</div>
            <div class="cell">Nombre</div>
        </div>
        <?php while ($row = $res->fetch_array()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
        ?>
        <div class="producto">
            <div class="cell"><?php echo $id; ?></div>
            <div class="cell"><?php echo $nombre; ?></div>
        </div>
        <div class="acciones-container">
            <a href="promocion_elimina.php?id=<?php echo $id; ?>" class="btn">Eliminar</a>
            <a href="promocion_detalles.php?id=<?php echo $id; ?>" class="btn">Ver Detalles</a>
            <a href="promocion_editar.php?id=<?php echo $id; ?>" class="btn">Editar</a>
        </div>
        <?php } ?>
    </div>
</body>
</html>
