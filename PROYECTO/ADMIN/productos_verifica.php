<?php
//empleados_verifica.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
$id          = $_REQUEST['id'];
$nombre      = $_REQUEST['nombre'];
$codigo      = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo       = $_REQUEST['costo'];
$stock       = $_REQUEST['stock'];
$archivo_n   = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : '';
$file_tmp    = isset($_FILES['archivo']['tmp_name']) ? $_FILES['archivo']['tmp_name'] : '';

$resp = 0;
$verificaCodigo = "SELECT * FROM productos
        WHERE status = 1 AND eliminado = 0 AND id = $id";
$verifica = $con->query($verificaCodigo);
$ver = $verifica->fetch_array();

$sql = "SELECT * FROM productos
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);

if($codigo == $ver["codigo"]){
    if($archivo_n != ''){
        //archivos
        $arreglo    = explode(".", $archivo_n);
        $len        = count($arreglo);
        $pos        = $len-1;
        $ext        = $arreglo[$pos];
        $dir        = "imgProductos/";
        $file_enc   = md5_file($file_tmp);
        $archivo_f = "$file_enc.$ext";
        copy($file_tmp, $dir.$archivo_f);

        $actualizaImg = "UPDATE productos SET
        archivo_n = '$archivo_n', archivo = '$archivo_f'
        WHERE id = $id";
        $con->query($actualizaImg);
    }
    $actualizaProducto = "UPDATE productos SET
    nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', costo = '$costo', stock = '$stock'
    WHERE id = $id";
    $con->query($actualizaProducto);
}
else{
    while($row = $res->fetch_array()) {
        $code = $row["codigo"];
        if($codigo == $code){
            $resp = 1;
        }
        else{
            if($archivo != ''){
                //archivos
                $arreglo    = explode(".", $archivo_n);
                $len        = count($arreglo);
                $pos        = $len-1;
                $ext        = $arreglo[$pos];
                $dir        = "imgProductos/";
                $file_enc   = md5_file($file_tmp);
                $archivo_f = "$file_enc.$ext";
                copy($file_tmp, $dir.$archivo_f);
        
                $actualizaImg = "UPDATE productos SET
                archivo_n = '$archivo_n', archivo = '$archivo_f'
                WHERE id = $id";
                $con->query($actualizaImg);
            }
            $actualizaProducto = "UPDATE productos SET
            nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', costo = '$costo', stock = '$stock'
            WHERE id = $id";
            $con->query($actualizaProducto);
        }
    }
} 
echo $resp;
?>