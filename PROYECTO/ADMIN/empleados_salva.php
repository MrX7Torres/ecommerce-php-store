<?php
//empleados_salva.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
$nombre    = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo    = $_REQUEST['correo'];
$pass      = $_REQUEST['pass'];
$rol       = $_REQUEST['rol'];
$archivo_n = $_FILES['archivo']['name'];
$file_tmp  = $_FILES['archivo']['tmp_name'];

//archivos
$arreglo    = explode(".", $archivo_n);
$len        = count($arreglo);
$pos        = $len-1;
$ext        = $arreglo[$pos];
$dir        = "imgEmpleados/";
$file_enc   = md5_file($file_tmp);
$archivo_f = "$file_enc.$ext";
//informacion general (Empleado)
$passEnc   = md5($pass);
$resp = 0;
$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);

while($row = $res->fetch_array()) {
        $mail = $row["correo"];
        if($correo == $mail){
            $resp = 1;
        }
}
if($resp==0){
        copy($file_tmp, $dir.$archivo_f);
        $insertaEmpleado = "INSERT INTO empleados
        (nombre,  apellidos, correo, pass, rol, archivo_nombre, archivo_file) 
        VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$archivo_n', '$archivo_f')";
        $con->query($insertaEmpleado);  
}
echo $resp;
?>