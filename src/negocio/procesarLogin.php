<?php
session_start();

require_once 'loginManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $passwd = $_POST["passwd"];

    $loginManager = new LoginManager();
    $loginExitoso = $loginManager->iniciarSesion($correo, $passwd);

    $datosUsuario = new Usuario();

    if ($loginExitoso) {
        if ($_SESSION['tipoUsuario'] == 'admin') {
            $token = $loginManager->generarToken(32);
            $loginManager->enviarToken($correo, $token);
            
            $datosUsuario = new Usuario();
            $datosUsuario->almacenarToken($correo, $token);
            //header("Location: ../presentacion/ingresarToken.php");
        } else {
            header("Location: ../presentacion/landing.php");
        }
        exit();
    } else {
        echo "Email y/o contraseña incorrectos.";
    }
}
?>