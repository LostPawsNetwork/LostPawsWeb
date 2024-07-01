<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    ($_SESSION["tipoUsuario"] !== "admin" &&
        $_SESSION["tipoUsuario"] !== "superadmin")
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

require_once "../config/neon.php";

// Obtener la conexión PDO
$pdo = getPDOConnection();

if ($pdo) {
    // Consulta para obtener los contactos
    $stmt = $pdo->prepare(
        "SELECT idContacto, nombre, email, mensaje FROM Contacto"
    );
    $stmt->execute();
    $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $contactos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilo para el header */
        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff; /* Color de fondo del header */
            z-index: 9999; /* Asegura que el header esté por encima del contenido */
        }

        /* Estilo para el contenido principal */
        #main-content {
            margin-top: 60px; /* Ajusta el margen superior para que empiece después del header */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Contactos</h1>
                <div>
                    <a href="dashAdmin.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>
                    <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=new"><button class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md">Responder</button></a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b">ID Contacto</th>
                            <th class="py-2 px-4 border-b">Nombre</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contactos as $contacto) {
                            echo "<tr>";
                            echo "<td class='py-2 px-4 border-b'>{$contacto["idcontacto"]}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$contacto["nombre"]}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$contacto["email"]}</td>";
                            echo "<td class='py-2 px-4 border-b'>{$contacto["mensaje"]}</td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>
</body>
</html>
