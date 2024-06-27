<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'user') {
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

include_once '../datos/adopcion.php';
include_once '../datos/control.php';
require_once '../config/neon.php';

$conn = getPDOConnection();
// Consulta para verificar si el usuario tiene una adopción registrada
$stmt = $conn->prepare("SELECT COUNT(*) AS num_adopciones FROM adopcion WHERE idUsuario = :idUsuario");
$stmt->bindParam(':idUsuario', $_SESSION['idUsuario'], PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

$num_adopciones = $resultado['num_adopciones'];
// Cerrar la conexión y liberar los recursos
$stmt->closeCursor();
$conn = null;
// Si no tiene adopciones registradas, redireccionar al usuario
if ($num_adopciones == 0) {
    header("Location: /lostpaws/presentacion/landingPage.php");
    exit;
}

//-----------------------------------------------------------------------------------

$idUsuario = $_SESSION['idUsuario'];

$adopcion = new Adopcion();
$idAdopcion = $adopcion->obtenerAdopcion($idUsuario);

if ($idAdopcion !== null) {
    $control = new Control();
    $controles = $control->listarControles($idAdopcion);
} else {
    echo "No se encontró una adopción para el usuario actual.";
}

usort($controles, function($a, $b) {
    return $a['nrocontrol'] <=> $b['nrocontrol'];
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Controles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-bluey-light {
            background-color: #d4eaf7; /* Color del primer bloque */
        }

        .bg-bluey-medium {
            background-color: #80c4f4; /* Color del segundo bloque */
        }

        .bg-bluey-dark {
            background-color: #4a4e78; /* Color del tercer bloque */
        }

        .hover-lighten:hover {
            filter: brightness(1.1); /* Aclara el elemento un 10% */
        }

        .text-bluey-dark {
            color: #4a4e78;
        }

        body {
            background-color: #f0f0f0;
        }

        .subir-control-btn {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .subir-control-btn:hover {
            background-color: #45a049;
        }

        .subir-control-btn[disabled] {
            background-color: #cccccc;
            color: #666666;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="bg-bluey-dark h-screen font-sans relative overflow-hidden">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br><br><br><br>
    <div class="flex h-full overflow-hidden">
        <?php include "../components/sidebar2.php"; ?>
        <div class="flex-1 overflow-y-auto p-4">
            <h1 class="text-3xl font-bold mb-4 text-white">Mis Controles</h1>
            <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
                <table class="min-w-full border border-gray-200 rounded-lg text-center">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b">Número de Control</th>
                            <th class="py-2 px-4 border-b">Fecha de Control</th>
                            <th class="py-2 px-4 border-b">Estado</th>
                            <th class="py-2 px-4 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($controles)) : ?>
                            <?php foreach ($controles as $control) : ?>
                                <?php
                                    $fechaControl = new DateTime($control['fechacontrol']);
                                    $fechaActual = new DateTime();
                                    $estado = $control['estado'];
                                    $deshabilitarBoton = $fechaControl > $fechaActual || $estado === 'En revisión' || $estado === 'Aceptado';
                                    if ($estado === 'Aceptado') {
                                        $textoBoton = 'Aceptado';
                                    } elseif ($estado === 'En revisión') {
                                        $textoBoton = 'En revisión';
                                    } else {
                                        $textoBoton = 'Subir Control';
                                    }
                                ?>
                                <tr class="<?php echo $estado === 'Aceptado' ? 'bg-green-100' : ($estado === 'En revisión' ? 'bg-yellow-100' : 'bg-white'); ?>">
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($control['nrocontrol']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($control['fechacontrol']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($control['estado']); ?></td>
                                    <td class="py-2 px-4 border-b">
                                        <?php if ($deshabilitarBoton) : ?>
                                            <button class="subir-control-btn" disabled><?php echo htmlspecialchars($textoBoton); ?></button>
                                        <?php else : ?>
                                            <a href="subirControl.php?idControl=<?php echo htmlspecialchars($control['idcontrol']); ?>&nroControl=<?php echo htmlspecialchars($control['nrocontrol']); ?>" class="subir-control-btn">Subir Control</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="py-2 px-4 border-b">No hay controles registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "../components/footer.html"; ?>
    <script src="../scripts/dynamic.js"></script>
</body>
</html>