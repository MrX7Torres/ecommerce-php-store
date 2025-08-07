<?php
require "sesion_iniciada.php";
if($_SESSION['clienteID'] == ''){
    header("Location: login_cliente.php");
}
?>
<html>
<head>
    <title>Contacto cliente</title>
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
            max-width: 75%;
            max-height: 75%;
        }
        .btn-container {
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
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
    <?php
    include ('menu_clientes.php');
    ?>
    <div class="container" >
        <div class="row">
            <div class="cell">
                 <a>Nombre</a>
            </div>
            <div class="cell">
                <a>Correo</a>
             </div>
        </div>
        <?php
            require "ADMIN/funciones/conecta.php";
            $con = conecta();
            
            $sql = "SELECT * FROM clientes
                    WHERE id = '$idCliente'"; 
            $res = $con->query($sql);

            while($row = $res->fetch_array()) {
                $nombre     = $row["nombre"];
                $apellidos  = $row["apellidos"];
                $correo     = $row["correo"];
        ?>
        <div class="row">
            <div class="cell">
                <?php  echo "$nombre $apellidos <br>";?>
            </div>
            <div class="cell">
                <?php  echo "$correo <br>";?>
            </div>
        </div>
        <div class="btn-container">
            <form action="cerrar_sesion.php">
                <input type="submit" value="Cerrar sesion" class="btn">
            </form>
        </div>
        
     <?php
        }
        include ('piePagina.php'); 
    ?>

</body>
</html>