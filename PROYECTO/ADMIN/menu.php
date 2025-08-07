<html>
<head>
    <title>Menu</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .menu {
            width: 100%;
            background-color: #fff;
            margin: 20px 0;
            padding: 10px 0;
            text-align: center;
        }
        .menu table {
            margin: 0 auto;
            max-width: 1400px;
        }
        .menu td {
            padding: 20px;
            font-size: 18px;
        }
        .menu a {
            color: #457845;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }
        .menu a:hover {
            background-color: #f0f0f0;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="menu">
        <table border="1">
            <tr height="30">
                <td colspan="2" align="center" ><a href="bienvenido.php">Inicio</a>
                <td colspan="2" align="center"><a href="empleados_lista.php">Empleados</a>
                <td colspan="2" align="center"><a href="productos_lista.php">Productos</a>
                <td colspan="2" align="center"><a href="promociones_lista.php">Promociones</a>
                <td colspan="2" align="center"><a href="pedidos_lista.php">Pedidos</a>
                <td colspan="2" align="center">Bienvenido <?php echo $nombre;?>
                <td colspan="2" align="center"><a href="salir.php">Cerrar sesion</a>
            </tr>
        </table>
    </div>
</body>
</html>
