<?php
// procesar_editar_usuario.php

require_once "../config/neon.php";
require_once "../datos/usuario.php";

// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION["idusuario"])) {
    die("Acceso denegado. Por favor, inicia sesión.");
}

// Obtiene el idUsuario de la sesión
$idUsuario = $_SESSION["idusuario"];

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $correo = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];

    // Crea una instancia de la clase Usuario
    $usuario = new Usuario();

    // Llama a la función editarUsuario
    $resultado = $usuario->editarUsuario(
        $idUsuario,
        $correo,
        $nombre,
        $apellido
    );

    // Verifica si la actualización fue exitosa
    if ($resultado) {
        header("Location: /lostpaws/presentacion/landingPage.php");
        exit();
    } else {
        echo "Error al actualizar el perfil.";
    }
}
?>
