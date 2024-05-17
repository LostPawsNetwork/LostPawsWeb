<?php
session_start();

if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];

    echo "Bienvenido, $email. Estás logueado.";
} else {
    header("Location: ../presentacion/iniciarSesion.php");
    exit();
}
?>
