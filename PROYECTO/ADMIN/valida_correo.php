<?php
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
$correo = $_REQUEST['correo'];
$resp = 0;

while($row = $res->fetch_array()) {
    $mail = $row["correo"];
    if($correo == $mail){
        $resp = 1;
    }
}
echo $resp;
?>