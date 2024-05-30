<?php
    session_start();

    include 'loginManager.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $correo = $_POST['correo'];
        $passwd = $_POST['passwd'];

        $loginManager = new LoginManager();
        $loginExitoso = $loginManager->iniciarSesion($correo, $passwd);

        if ($loginExitoso) 
        {
            header("Location: ../presentacion/dashboard.php");
            exit();
        } 
        else 
        {
            echo "Email y/o contraseña incorrectos.";
        }
    }
?>