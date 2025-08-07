<?php
//promociones_salva.php
require "funciones/conecta.php";
$con = conecta();

$nombre      = $_REQUEST['nombre'];
$archivo   = $_FILES['archivo']['name'];
$file_tmp    = $_FILES['archivo']['tmp_name'];

//archivos
$arreglo    = explode(".", $archivo);
$len        = count($arreglo);
$pos        = $len-1;
$ext        = $arreglo[$pos];
$dir        = "imgPromociones/";
$file_enc   = md5_file($file_tmp);
$archivo = "$file_enc.$ext";
$resp = 0;
$sql = "SELECT * FROM promociones
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);

while($row = $res->fetch_array()) {
        $name = $row["nombre"];
        if($nombre == $name){
            $resp = 1;
        }
}
if($resp==0){
        copy($file_tmp, $dir.$archivo);
        $insertaProducto = "INSERT INTO promociones
        (nombre, archivo) 
        VALUES ('$nombre','$archivo')";
        $con->query($insertaProducto);  
}
echo $resp;
?>