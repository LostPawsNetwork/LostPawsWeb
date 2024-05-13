<?php
    session_start();

    include 'LoginManager.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $loginManager = new LoginManager();
        $loginExitoso = $loginManager->iniciarSesion($email, $password);

        if ($loginExitoso) 
        {
            header("Location: ../presentacion/postLogin.php");
            exit();
        } 
        else 
        {
            echo "Email y/o contraseña incorrectos.";
        }
    }
?>