<?php
session_start();

require_once '../datos/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $tokenIngresado = $_POST["token"];

    $usuario = new Usuario();
    $tokenEnviado = $usuario->obtenerToken($_SESSION["correo"]);

    if ($tokenIngresado === $tokenEnviado) {
        // El token ingresado es válido
        $_SESSION["correo"];
        header("Location: ../presentacion/dashboard.php");
        exit();
    } 
    else 
    {
        echo "El token ingresado es incorrecto. Por favor, inténtalo de nuevo.";
    }
} 
else 
{
    header("Location: ../presentacion/login.php");
    exit();
}
?>
