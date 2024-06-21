<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $mensaje = trim($_POST["mensaje"]);

    // Validación básica
    if (empty($nombre) || empty($email) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor completa todos los campos y asegúrate de que el correo electrónico es válido.";
        exit();
    }

    // Configuración del correo
    $to = "xo2021071080@virtual.upt.pe";
    $subject = "Nuevo mensaje de contacto de $nombre";
    $body = "Nombre: $nombre\nEmail: $email\n\nMensaje:\n$mensaje";
    $headers = "From: $email";

    // Enviar correo
    if (mail($to, $subject, $body, $headers)) {
        echo "Tu mensaje ha sido enviado con éxito.";
    } else {
        echo "Hubo un problema al enviar tu mensaje. Por favor intenta de nuevo.";
    }
}
?>
