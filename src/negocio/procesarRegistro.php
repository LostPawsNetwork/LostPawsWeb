<?php
    session_start();

    require_once '../datos/usuario.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $correo = $_POST['correo'];
        $passwd = $_POST['passwd'];
        $confirmPassword = $_POST['confirmPassword'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $dni = $_POST['dni'];
        $tipoUsuario = 1;

        if ($passwd !== $confirmPassword) 
        {
            echo "Las contraseñas no coinciden.";
            exit();
        }

        $user = new Usuario();
        $registroExitoso = $user->registrarUsuario($correo, $passwd, $nombre, $apellido, $fechaNacimiento, $dni, $tipoUsuario);

        if ($registroExitoso) 
        {
            echo "Registro exitoso.";
        } 
        else 
        {
            echo "Error al registrar el usuario.";
        }
    }
?>