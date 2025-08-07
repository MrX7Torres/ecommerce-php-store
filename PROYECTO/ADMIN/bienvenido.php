<?php
require "inicio_sesion.php";
if($_SESSION['nombreUser']==''){
    header("Location: index.php");
}
?>
<html>
<head>
    <title>Menu de Empleado</title>
    <style>
            .anuncio{
                text-align: center; 
                width: 20%;  
                font-size: 20px;
            }
    </style>
    <script src="funciones/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div style="text-align:center;">
        <?php
            include ('menu.php');
        ?>
    </div>
    <div class="anuncio"> <?php echo "Hola "; echo $nombre; echo " bienvenido al sistema <br><br>"; ?> </div>
</body>
</html>
