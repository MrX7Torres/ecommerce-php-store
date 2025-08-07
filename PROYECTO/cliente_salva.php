<?php
require "ADMIN/funciones/conecta.php";
$con = conecta();

$nombre    = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo    = $_REQUEST['correo'];
$pass      = $_REQUEST['pass'];

$resp = 0;
$sql = "SELECT * FROM clientes";
$res = $con->query($sql);

$to = $correo;
$asunto = "Nuevo cliente registrado";
$mensaje = "Se ha registrado un nuevo cliente";
$mensaje .= "Nombre completo: $nombre $apellidos\n";
$mensaje .= "Correo electrónico: $correo\n";
$headers = 'From: jesusantoniotc77@gmail.com' . "\r\n".
        'Reply-To: jesusantoniotc77@gmail.com' . "\r\n".
        'X-Mailer: PHP/' . phpversion();

while($row = $res->fetch_array()) {
        $mail = $row["correo"];
        if($correo == $mail){
            $resp = 1;
        }
}
if($resp==0){
    mail($to, $asunto, $mensaje, $headers); 
    $insertaCliente = "INSERT INTO clientes
    (nombre,  apellidos, correo, pass) 
    VALUES ('$nombre', '$apellidos', '$correo', '$pass')";
    $con->query($insertaCliente);  
}
echo $resp;
?>