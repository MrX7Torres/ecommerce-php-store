<?php
require "inicio_sesion.php";
if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
    header("Location: bienvenido.php");
}
?>
<html>
<head>
    <title>Login de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .login-form {
            display: flex;
            flex-direction: column;
        }
        .login-form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-form a {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }
        .login-form a:hover {
            background-color: #0056b3;
        }
        #mensaje {
            width: 100%;
            height: 25px;
            background: #EFEFEF;
            border-radius: 5px;
            color: #F00;
            font-size: 16px;
            line-height: 25px;
            text-align: center;
            margin-top: 10px;
            padding: 5px;
            display: none;
        }
    </style>
    <script src="funciones/jquery-3.3.1.min.js"></script>
    <script>
        function loginEmpleado() {
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            $('#mensaje').show();
            if (correo != '' && pass != '') {
                $.ajax({
                    url: 'valida_usuario.php',
                    type: 'post',
                    data: {
                        correo: correo,
                        pass: pass
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp == 1) {
                            window.location.href = 'bienvenido.php';
                        } else {
                            $('#mensaje').html('Correo o password incorrectos...');
                        }
                    },
                    error: function() {
                        alert('Error en la conexion...');
                    }
                });
            } else {
                $('#mensaje').html('Faltan campos por llenar');
            }
            setTimeout(function() {
                $('#mensaje').html('');
                $('#mensaje').hide();
            }, 5000);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="title">Ingresa tus datos de empleado</div>
        <form class="login-form" name="Login" method="post">
            <input type="email" id="correo" name="correo" placeholder="Escribe tu correo"><br>
            <input type="password" id="pass" name="pass" placeholder="Escribe tu password"><br>
            <a href="javascript:void(0);" onclick="loginEmpleado();">Login de Empleado</a>
            <div id="mensaje"></div>
        </form>
    </div>
</body>
</html>
