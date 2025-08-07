<?php
require "inicio_sesion.php";
if($_SESSION['nombreUser']==''){
    header("Location: index.php");
}
?>
<html>
<head>
    <title>Detalle de Empleado</title>
    <style>
        .container {
                border: 5px solid black;
                border-color: blue;
                width: 60%;
                height: 300px;
                margin: 0 auto;
                background-color: #79D551;
                display: table;
                padding: 2px;
            }
            .row {
                display: table-row;
                align-items: center;
                border-bottom: 1px solid black;
                padding: 10px;
                height: 120px;
            }
            .cell{
                text-align: center; 
                flex-grow: 1; 
                display: table-cell;
                border: 3px solid black;
                border-color: white;
                width: 20%;
                font-size: 20px;
            }
            .cell img {
                max-width: 70%;
                max-height: 70%;
            }
            .first-row {
                height: 10%; 
            }
    </style>
</head>
<body>
    <?php
    include ('menu.php');
    ?>
    <form action="empleados_lista.php">
        <input type="submit" value="Regresar">
    </form>
    <div class="cell"> <?php $id = $_REQUEST['id'];
     echo "Detalles de empleado con id: $id <br><br>"; 
    ?> </div>
    <div class="container" >
        <div class="row">
            <div class="cell">
                 <a>Nombre</a>
            </div>
            <div class="cell">
                <a>Correo</a>
             </div>
             <div class="cell">
                <a>Rol</a>
            </div>
            <div class="cell">
                <a>Status</a>
            </div>
            <div class="cell">
                <a>Foto</a>
            </div>
        </div>
        <?php
            require "funciones/conecta.php";
            $con = conecta();
            
            $sql = "SELECT * FROM empleados
                    WHERE id = $id";
            $res = $con->query($sql);

            while($row = $res->fetch_array()) {
                $nombre     = $row["nombre"];
                $apellidos  = $row["apellidos"];
                $correo     = $row["correo"];
                $rol        = $row["rol"];
                $status     = $row["status"];
                $foto       = $row["archivo_file"];
            if ($rol==1){
                $rol = 'gerente';
            }else{
                $rol = 'ejecutivo';
            }
            if ($status==1){
                $status = 'activo';
            }else{
                $status = 'inactivo';
            }
        ?>
        <div class="row">
            <div class="cell">
                <?php  echo "$nombre $apellidos <br>";?>
            </div>
            <div class="cell">
                <?php  echo "$correo <br>";?>
            </div>
            <div class="cell">
                <?php  echo "$rol  <br>";?>
            </div>
            <div class="cell">
                <?php  echo "$status  <br>";?>
            </div>
            <div class="cell">
                <?php  echo '<img src="imgEmpleados/' . $foto . '">';?>
            </div>
        </div>
        
     <?php
        }
    ?>

</body>
</html>
