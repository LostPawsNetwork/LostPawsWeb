<?php
session_start();

include '../data/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $datos = new Datos();
    $usuarioValido = $datos->validarUsuario($email, $password);
    
    if ($usuarioValido) 
    {
        $_SESSION['email'] = $email;
        
        header("Location: ../presentacion/postLogin.php");

        exit();
    } 
    else 
    {
        echo "Email y/o contraseña incorrectos.";
    }
}
?>