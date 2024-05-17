<?php
    session_start();

    require_once 'RegistroManager.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $celular = $_POST['celular'];
        $sexo = $_POST['sexo'];
        $idCargo = 1;

        if ($password !== $confirmPassword) 
        {
            echo "Las contraseñas no coinciden.";
            exit();
        }

        $registroManager = new RegistroManager();
        $registroExitoso = $registroManager->registrarUsuario($email, $password, $nombre, $apellido, $fechaNacimiento, $celular, $sexo, $idCargo);

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