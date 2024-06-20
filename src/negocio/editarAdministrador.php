<?php
// Incluir archivo de configuración de base de datos
include_once '../config/neon.php'; // Ajusta la ruta según sea necesario

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $correoAdmin = $_POST['correoAdmin'];

    // Validar que el campo no esté vacío
    if (empty($correoAdmin)) {
        echo "El correo no puede estar vacío.";
        exit();
    }

    try {
        // Obtener la conexión PDO
        $conn = getPDOConnection();

        // Preparar la consulta para actualizar el correo del administrador
        $sql = "UPDATE usuario SET email = :correo WHERE tipoUsuario = 'admin' AND email = :correoOriginal";
        $stmt = $conn->prepare($sql);

        // Reemplazar :correoOriginal con el correo del administrador original
        // Debes asegurarte de enviar también el correo original del administrador
        // desde el modal para identificar correctamente el registro a actualizar.
        // Aquí, se asume que el correo original se pasa como un campo oculto en el formulario.
        $correoOriginal = $_POST['correoOriginal']; // Añade este campo oculto en el formulario

        // Vincular los parámetros
        $stmt->bindParam(':correo', $correoAdmin);
        $stmt->bindParam(':correoOriginal', $correoOriginal);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: ../presentacion/gestionarAdministradores.php");
            exit;
        } else {
            echo "Error al actualizar el correo del administrador.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
?>