<?php
require "inicio_sesion.php";
if($_SESSION['nombreUser']==''){
    header("Location: index.php");
}
?>
<html>
<head>
    <title>Alta de Empleados</title>
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
        input[type="email"],
        input[type="password"],
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
        function altaEmpleado() {
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            var rol = $('#rol').val();
            var archivo = $('#archivo')[0].files[0];

            var formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('apellidos', apellidos);
            formData.append('correo', correo);
            formData.append('pass', pass);
            formData.append('rol', rol);
            formData.append('archivo', archivo);

            $('#mensaje').show();
            if(nombre !='' && apellidos !='' && correo !='' && rol != 2 && archivo !=''){
                $.ajax({
                    url: 'empleados_salva.php',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        console.log(resp); 
                        if (resp == 0) {
                            window.location.href = 'empleados_lista.php';
                        }
                        else{
                            sale();
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

        function sale() {    
            var correo = $('#correo').val();    
            if(correo !=''){
                $.ajax({
                    url: 'valida_correo.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'correo='+ correo, 
                    success: function(resp) {
                        console.log(resp);
                        $('#mensaje').show();
                        if (resp == 1) {
                            $('#mensaje').html('Correo ' + correo + ' ya existe');
                        }
                        setTimeout("$('#mensaje').html('');", 5000);
                    },error: function(){
                        alert('Error en la conexion...');
                    }
                });
            }
        }
    </script>
<body>
    <?php
        include ('menu.php');
    ?>
    <div class="btnvolver">
        <form action="empleados_lista.php">
            <input type="submit" value="Regresar">
        </form>
    </div>
    <div class="container">
        <h2 class="title">Alta de Empleados</h2>
        <form enctype="multipart/form-data" name="altaDEmpleado" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre">
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" placeholder="Escribe tus apellidos">
            </div>
            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input onblur="sale();" type="email" id="correo" name="correo" placeholder="Escribe tu correo">
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" id="pass" name="pass" placeholder="Escribe tu contraseña">
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select name="rol" id="rol">
                    <option value="2" selected>Selecciona</option>
                    <option value="1">Gerente</option>
                    <option value="0">Ejecutivo</option>			
                </select>
            </div>
            <div class="form-group">
                <label for="archivo">Sube tu foto aquí:</label>
                <input type="file" id="archivo" name="archivo">
            </div>
            <div class="form-group">
                <a href="javascript:void(0);" onclick="altaEmpleado();" class="btn">Alta de Empleado</a>
            </div>
            <div id="mensaje" class="message"></div>
        </form>
    </div>

</body>
</html>
