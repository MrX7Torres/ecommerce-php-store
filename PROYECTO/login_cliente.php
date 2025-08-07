<?php
require "sesion_iniciada.php";
if(isset($_SESSION['clienteID']) && $_SESSION['clienteID'] == ''){
    header("Location: home.php");
}
?>
<html>
<head>
    <title>Login de Clientes</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
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
        .register-section {
            margin-top: 20px;
            font-size: 16px;
        }
        .register-section a {
            color: #007bff;
            text-decoration: none;
        }
        .register-section a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="ADMIN/funciones/jquery-3.3.1.min.js"></script>
    <script>
        function loginCliente() {
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            $('#mensaje').show();
            if (correo != '' && pass != '') {
                $.ajax({
                    url: 'valida_cliente.php',
                    type: 'post',
                    data: {
                        correo: correo,
                        pass: pass
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp == 1) {
                            window.location.href = 'home.php';
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
    <div style="text-align:center;">
        <?php
            include ('menu_clientes.php');
        ?>
    </div>
    <div class="container">
        <div class="title">Ingresa tus datos</div>
        <form class="login-form" name="Login" method="post">
            <input type="email" id="correo" name="correo" placeholder="Escribe tu correo"><br>
            <input type="password" id="pass" name="pass" placeholder="Escribe tu password"><br>
            <a href="javascript:void(0);" onclick="loginCliente();">Login</a>
            <div id="mensaje"></div>
        </form>
        <div class="register-section">
            ¿No tienes cuenta? <a href="registro_cliente.php">Crear cuenta</a>
        </div>
    </div>
    <?php include ('piePagina.php'); ?>
</body>
</html>