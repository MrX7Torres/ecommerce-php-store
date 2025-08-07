<?php
require "ADMIN/funciones/conecta.php";
session_start();
$con = conecta();

$sql = "SELECT * FROM clientes";
$res = $con->query($sql);
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$resp = 0;

while($row = $res->fetch_array()) {
    $mail = $row["correo"];
    $pasw = $row["pass"];
    $id   = $row["id"];
    if($correo == $mail && $pass == $pasw){
        $resp = 1;
        $_SESSION['clienteID'] = $id;
    }
}
echo $resp;
?>