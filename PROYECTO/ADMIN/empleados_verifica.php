<?php
//empleados_verifica.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
$id             = $_REQUEST['id'];
$nombre         = $_REQUEST['nombre'];
$apellidos      = $_REQUEST['apellidos'];
$correo         = $_REQUEST['correo'];
$pass           = $_REQUEST['pass'];
$rol            = $_REQUEST['rol'];
$archivo_n = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : '';
$file_tmp  = isset($_FILES['archivo']['tmp_name']) ? $_FILES['archivo']['tmp_name'] : '';

$resp = 0;
$verificaCorreo = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0 AND id = $id";
$verifica = $con->query($verificaCorreo);
$ver = $verifica->fetch_array();

$passEnc   = md5($pass);
$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);

if($correo == $ver["correo"]){
    if($archivo_n != ''){
        //archivos
        $arreglo    = explode(".", $archivo_n);
        $len        = count($arreglo);
        $pos        = $len-1;
        $ext        = $arreglo[$pos];
        $dir        = "imgEmpleados/";
        $file_enc   = md5_file($file_tmp);
        $archivo_f = "$file_enc.$ext";
        copy($file_tmp, $dir.$archivo_f);

        $actualizaImg = "UPDATE empleados SET
        archivo_nombre = '$archivo_n', archivo_file = '$archivo_f'
        WHERE id = $id";
        $con->query($actualizaImg);
    }
    $actualizaEmpleado = "UPDATE empleados SET
    nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', rol = $rol
    WHERE id = $id";
    $con->query($actualizaEmpleado);
}
else{
    while($row = $res->fetch_array()) {
        $mail = $row["correo"];
        if($correo == $mail){
            $resp = 1;
        }
        else{
            if($archivo != ''){
                //archivos
                $arreglo    = explode(".", $archivo_n);
                $len        = count($arreglo);
                $pos        = $len-1;
                $ext        = $arreglo[$pos];
                $dir        = "imgEmpleados/";
                $file_enc   = md5_file($file_tmp);
                $archivo_f = "$file_enc.$ext";
                copy($file_tmp, $dir.$archivo_f);
        
                $actualizaImg = "UPDATE empleados SET
                archivo_nombre = '$archivo_n', archivo_file = '$archivo_f'
                WHERE id = $id";
                $con->query($actualizaImg);
            }
            $actualizaEmpleado = "UPDATE empleados SET
            nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', rol = $rol
            WHERE id = $id";
            $con->query($actualizaEmpleado);
        }
    }
} 
echo $resp;
?>