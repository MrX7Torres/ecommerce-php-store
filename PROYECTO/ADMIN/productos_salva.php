<?php
//productos_salva.php
require "funciones/conecta.php";
$con = conecta();

$nombre      = $_REQUEST['nombre'];
$codigo      = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo       = $_REQUEST['costo'];
$stock       = $_REQUEST['stock'];
$archivo_n   = $_FILES['archivo']['name'];
$file_tmp    = $_FILES['archivo']['tmp_name'];

//archivos
$arreglo    = explode(".", $archivo_n);
$len        = count($arreglo);
$pos        = $len-1;
$ext        = $arreglo[$pos];
$dir        = "imgProductos/";
$file_enc   = md5_file($file_tmp);
$archivo_f = "$file_enc.$ext";
//informacion general (Producto)
$resp = 0;
$sql = "SELECT * FROM productos
        WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);

while($row = $res->fetch_array()) {
        $code = $row["codigo"];
        if($codigo == $code){
            $resp = 1;
        }
}
if($resp==0){
        copy($file_tmp, $dir.$archivo_f);
        $insertaProducto = "INSERT INTO productos
        (nombre, codigo, descripcion, costo, stock, archivo_n, archivo) 
        VALUES ('$nombre', '$codigo', '$descripcion', '$costo', '$stock', '$archivo_n', '$archivo_f')";
        $con->query($insertaProducto);  
}
echo $resp;
?>