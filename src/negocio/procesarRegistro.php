<?php
session_start();

require_once '../datos/usuario.php';

$user = 'user';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $passwd = $_POST['passwd'];
    $confirmPassword = $_POST['confirmPassword'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $nummeroDocumento = $_POST['dni'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $tipoUsuario = $user;

    if ($passwd !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    $user = new Usuario();
    $registroExitoso = $user->registrarUsuario($correo, $passwd, $nombre, $apellido, $tipoDocumento, $nummeroDocumento, $fechaNacimiento, $tipoUsuario);

    if ($registroExitoso) {
        $_SESSION["loggedin"] = true;
        $_SESSION["correo"] = $correo;
        $_SESSION["idUsuario"] = $user->obtenerIdUsuarioPorCorreo($correo);
        $_SESSION["tipoUsuario"] = $tipoUsuario;
        header("Location: ../presentacion/landingPage.php");
        exit();
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
