<?php
//empleados_verifica.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
$id          = $_REQUEST['id'];
$nombre      = $_REQUEST['nombre'];
$archivo   = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : '';
$file_tmp    = isset($_FILES['archivo']['tmp_name']) ? $_FILES['archivo']['tmp_name'] : '';

$resp = 0;
$verificaNombre = "SELECT * FROM promociones
        WHERE status = 1 AND eliminado = 0 AND id = $id";
$verifica = $con->query($verificaNombre);
$ver = $verifica->fetch_array();

$sql = "SELECT * FROM promociones
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);

if($nombre == $ver["nombre"]){
    if($archivo != ''){
        $arreglo    = explode(".", $archivo);
        $len        = count($arreglo);
        $pos        = $len-1;
        $ext        = $arreglo[$pos];
        $dir        = "imgPromociones/";
        $file_enc   = md5_file($file_tmp);
        $archivo = "$file_enc.$ext";
        copy($file_tmp, $dir.$archivo);

        $actualizaImg = "UPDATE promociones SET
        archivo = '$archivo'
        WHERE id = $id";
        $con->query($actualizaImg);
    }
    $actualizaPromocion = "UPDATE promociones SET
    nombre = '$nombre',
    WHERE id = $id";
    $con->query($actualizaPromocion);
}
else{
    while($row = $res->fetch_array()) {
        $name = $row["nombre"];
        if($nombre == $name){
            $resp = 1;
        }
        else{
            if($archivo != ''){
                $arreglo    = explode(".", $archivo);
                $len        = count($arreglo);
                $pos        = $len-1;
                $ext        = $arreglo[$pos];
                $dir        = "imgPromociones/";
                $file_enc   = md5_file($file_tmp);
                $archivo = "$file_enc.$ext";
                copy($file_tmp, $dir.$archivo);
        
                $actualizaImg = "UPDATE promociones SET
                archivo = '$archivo'
                WHERE id = $id";
                $con->query($actualizaImg);
            }
            $actualizaPromocion = "UPDATE promociones SET
            nombre = '$nombre'
            WHERE id = $id";
            $con->query($actualizaPromocion);
        }
    }
} 
echo $resp;
?>