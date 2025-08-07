<?php
require "inicio_sesion.php";
if($_SESSION['nombreUser']==''){
    header("Location: index.php");
}
?>
<html>
<head>
    <title>Alta de Promociones</title>
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
        function altaPromocion() {
            var nombre = $('#nombre').val();
            var archivo = $('#archivo').val();

            var formData = new FormData();
            formData.append('nombre', $('#nombre').val());
            formData.append('archivo', $('#archivo')[0].files[0]);

            $('#mensaje').show();
            if(nombre !='' && archivo !=''){
                $.ajax({
                    url: 'promocion_salva.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        console.log(resp); 
                        if (resp == 0) {
                            window.location.href = 'promociones_lista.php';
                        }
                        else{
                            $('#mensaje').html('Etiqueta ya existente...');
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
    ?>
    <div class="btnvolver">
        <form action="promociones_lista.php">
            <input type="submit" value="Regresar">
        </form>
    </div>
    <div class="container">
        <h2 class="title">Alta de Promociones</h2>
        <form enctype="multipart/form-data" name="altaDePromocion" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="" placeholder="Nombre de la promocion">
            </div>
            <div class="form-group">
                <label for="archivo">Sube tu foto aquí:</label>
                <input type="file" id="archivo" name="archivo" value="">
            </div>
            <div class="form-group">
                <a href="javascript:void(0);" onclick="altaPromocion();" class="btn">Alta de Promocion</a>
            </div>
            <div id="mensaje" class="message"></div>
        </form>
    </div>

</body>
</html>
