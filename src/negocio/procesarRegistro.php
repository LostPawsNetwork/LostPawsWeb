<?php
    session_start();

    require_once 'loginManager.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $correo = $_POST['correo'];
        $passwd = $_POST['passwd'];
        $confirmPassword = $_POST['confirmPassword'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $nummeroDocumento = $_POST['dni'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $tipoUsuario = 1;

        if ($passwd !== $confirmPassword) 
        {
            echo "Las contraseñas no coinciden.";
            exit();
        }

        $user = new Usuario();
        $registroExitoso = $user->registrarUsuario($correo, $passwd, $nombre, $apellido, $tipoDocumento, $nummeroDocumento, $fechaNacimiento, $tipoUsuario);
        
        if ($registroExitoso)
        {
            $contrasenaRegistrada = $user->obtenerContrasena($correo);

            $loginManager = new LoginManager();
            $loginExitoso = $loginManager->iniciarSesion($correo, $contrasenaRegistrada);
            
            if ($loginExitoso) 
            {
                if ($_SESSION['tipoUsuario'] == 'admin') {
                    $token = $loginManager->generarToken(32);
                    $loginManager->enviarToken($correo, $token);
                    
                    $datosUsuario = new Usuario();
                    $datosUsuario->almacenarToken($correo, $token);
                    //header("Location: ../presentacion/ingresarToken.php");
                } else {
                    //header("Location: ../presentacion/landing.php");
                }
            } 
            else 
            {
                echo "Email y/o contraseña incorrectos.";
            }
        } 
        else 
        {
            echo "Error al registrar el usuario.";
        }
    }
?>