<?php
session_start();

include "loginManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["correo"];
    $password = $_POST["passwd"];

    $loginManager = new LoginManager();
    $loginExitoso = $loginManager->iniciarSesion($email, $password);

    if ($loginExitoso) {
        header("Location: ../presentacion/postLogin.php");
        exit();
    } else {
        echo "Email y/o contraseña incorrectos.";
    }
}
?>
