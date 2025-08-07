<?php 
require "inicio_sesion.php";
if($_SESSION['nombreUser']==''){
    header("Location: index.php");
}
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .empleado {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .listaEmpleados {
            flex: 1;
        }
        .botonEmpleados {
            flex-shrink: 0;
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
            margin-left: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
        include ('menu.php');
    ?>
    <div class="container">
        <h2 class="title">Lista de Empleados (<?php echo $num; ?>)</h2>
        <a href="empleados_alta_Final.php" class="btn">Agregar Registro</a>
        <br><br>
        <?php
        while($row = $res->fetch_array()) {
            $id         = $row["id"];
            $nombre     = $row["nombre"];
            $apellidos  = $row["apellidos"];
            $correo     = $row["correo"];
        ?>
        <div class="empleado">
            <div class="listaEmpleados">
                <span><?php echo "$id $nombre $apellidos $correo"; ?></span>
            </div>
            <div class="botonEmpleados">
                <a href="empleados_elimina.php?id=<?php echo $id; ?>" class="btn">Eliminar</a>
                <a href="empleados_detalle.php?id=<?php echo $id; ?>" class="btn">Ver Detalles</a>
                <a href="empleados_editar.php?id=<?php echo $id; ?>" class="btn">Editar</a>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>