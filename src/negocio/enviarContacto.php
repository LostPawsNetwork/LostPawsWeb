<?php
require_once "../config/neon.php"; // Asegúrate de que la ruta a neon.php es correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $mensaje = trim($_POST["mensaje"]);

    // Validación básica
    if (
        empty($nombre) ||
        empty($email) ||
        empty($mensaje) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo "Por favor completa todos los campos y asegúrate de que el correo electrónico es válido.";
        exit();
    }

    // Obtener la conexión PDO
    $conn = getPDOConnection();

    if ($conn !== null) {
        try {
            // Preparar la sentencia SQL para insertar los datos
            $sql =
                "INSERT INTO Contacto (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":mensaje", $mensaje);

            // Ejecutar la sentencia
            $stmt->execute();

            // Mostrar mensaje de éxito y redirigir usando JavaScript
            echo "<script>
                    alert('Mensaje enviado con éxito.');
                    window.location.href = '../presentacion/landingPage.php';
                  </script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No se pudo conectar a la base de datos.";
    }

    // Cerrar la conexión
    $conn = null;
}
?>
