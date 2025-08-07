<?php
require "funciones/conecta.php";
session_start();
$con = conecta();

$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$resp = 0;

while($row = $res->fetch_array()) {
    $mail = $row["correo"];
    $pasw = $row["pass"];
    $nombre = $row["nombre"]. ' '.$row["apellidos"];
    if($correo == $mail && $pass == $pasw){
        $resp = 1;
        $_SESSION['nombreUser'] = $nombre;
    }
}

echo $resp;
?>