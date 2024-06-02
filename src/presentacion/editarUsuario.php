<?php
// editarUsuario.php

// Incluye la conexión a la base de datos y la clase que contiene el método editarUsuario
// require_once "../config/conexion.php"; // Asegúrate de que este archivo contiene la conexión a la base de datos
require_once "../datos/usuario.php"; // Asegúrate de que este archivo contiene la clase con el método editarUsuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipoDocumento = $_POST["tipoDocumento"];
    $numeroDocumento = $_POST["numeroDocumento"];
    $fechaNacimiento = $_POST["fechaNacimiento"];

    // Crea una instancia de la clase que contiene el método editarUsuario
    $usuario = new Usuario();
    // Llama al método editarUsuario
    $resultado = $usuario->editarUsuario(
        $correo,
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $fechaNacimiento
    );

    if ($resultado) {
        echo "Usuario actualizado con éxito.";
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>
