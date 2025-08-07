<?php
require "inicio_sesion.php";
if($_SESSION['nombreUser']==''){
    header("Location: index.php");
}
?>
<html>
<head>
    <title>Edicion de Productos</title>
</head>
    <style>
        #mensaje {
            width: 200px;
            height: 25px;
            background: #EFEFEF;
            border-radius: 5px;
            color: #F00;
            font-size: 16px;
            line-height: 25px;
            text-align: center;
            margin-top: 20px;
            padding: 5px;
            display: none;
        }
        body {
            font-family: Arial;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            border: 3px solid #ccc;
        }
        .title{
            text-align: center; 
            font-size: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .formulario{
            margin: 0 auto; 
            width: 10%; 
            text-align: center;
            font-size: 15px;
        }
        label {
            font-weight: bold;
            display: block; 
            margin-bottom: 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"],
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;          
            text-decoration: none;
        }
        .volver{
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="funciones/jquery-3.3.1.min.js"></script>
    <script>
        function editarProducto(id) {
            var nombre = $('#nombre').val();
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();
            var archivo = $('#archivo')[0].files[0];
            
            var formData = new FormData();
            formData.append('id', id);
            formData.append('nombre', nombre);
            formData.append('codigo', codigo);
            formData.append('descripcion', descripcion);
            formData.append('costo', costo);
            formData.append('stock', stock);
            formData.append('archivo', archivo);

            $('#mensaje').show();
            if(nombre !='' && codigo !='' && descripcion !='' && costo != '' && stock != ''){
                $.ajax({
                    url: 'productos_verifica.php',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        console.log(resp); 
                        if (resp == 0) {
                            window.location.href = 'productos_lista.php';
                        }
                        else{
                            $('#mensaje').html('Codigo ya existente...');
                        }
                    },error: function(){
                        alert('Error en la conexion...');
                    }
                });  
            } else{
                $('#mensaje').html('Faltan campos por llenar');
            } 
            setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
        }

    </script>
<body>
    <?php
        include ('menu.php');
        require "funciones/conecta.php";
        $con = conecta();
        $id = $_REQUEST['id'];
            
        $sql = "SELECT * FROM productos
                WHERE id = $id";
        $res = $con->query($sql);

        while($row = $res->fetch_array()) {
            $nombre      = $row["nombre"];
            $codigo      = $row["codigo"];
            $descripcion = $row["descripcion"];
            $costo       = $row["costo"];
            $stock       = $row["stock"];
            $archivo     = $row["archivo_n"];
        ?>

    <div class="btnvolver">
        <form action="productos_lista.php">
            <input type="submit" value="Regresar">
        </form>
    </div>
    <div class="container">
        <h2 class="title">Edicion de Productos</h2>
        <form enctype="multipart/form-data" name="editarElProducto" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre del producto">
            </div>
            <div class="form-group">
                <label for="codigo">codigo:</label>
                <input type="text" id="codigo" name="codigo" value="<?php echo $codigo; ?>" placeholder="Codigo del producto">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" placeholder="Describe el producto">
            </div>
            <div class="form-group">
                <label for="costo">Costo:</label>
                <input type="text" id="costo" name="costo" value="<?php echo $costo; ?>" placeholder="Costo del producto">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="text" id="stock" name="stock" value="<?php echo $stock; ?>" placeholder="Cantidad en stock">
            </div>
            <div class="form-group">
                <label for="archivo">Sube tu foto aquí:</label>
                <input type="file" id="archivo" name="archivo" value="<?php echo $archivo; ?>">
            </div>
            <div class="form-group">
                <a href="javascript:void(0);" onclick="editarProducto(<?php echo $id ?>);" class="btn">Actualizar</a>
            </div>
            <div id="mensaje" class="message"></div>
        </form>
        <?php } ?>
    </div>
</body>
</html>
