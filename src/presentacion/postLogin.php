<?php
    session_start();

    if (isset($_SESSION['correo'])) 
    {
        $correo = $_SESSION['correo'];

        echo "Bienvenido, $correo. Estás logueado.";
    } 
    else
    {
        header("Location: ../presentacion/iniciarSesion.php");
        exit();
    }
?>