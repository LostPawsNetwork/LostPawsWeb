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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .subir-control-btn {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none; /* Eliminar el subrayado */
            display: inline-block; /* Asegurar que se comporte como un botón */
            text-align: center; /* Centrar el texto */
        }
        .subir-control-btn:hover {
            background-color: #45a049;
        }
        .subir-control-btn[disabled] {
            background-color: #cccccc;
            color: #666666;
            cursor: not-allowed;
        }

        .sidebar {
            background-color: #4a4e78;
            color: white;
            min-height: 100vh;
            width: 250px;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px 0;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #80c4f4;
        }

    </style>
</head>
<body>
    <h1>Mis Controles</h1>
    <table>
        <thead>
            <tr>
                <th>Número de Control</th>
                <th>Fecha de Control</th>
                <th>Estado</th>
                <th>Acciones</th>
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
                    <tr>
                        <td><?php echo htmlspecialchars($control['nrocontrol']); ?></td>
                        <td><?php echo htmlspecialchars($control['fechacontrol']); ?></td>
                        <td><?php echo htmlspecialchars($control['estado']); ?></td>
                        <td>
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
                    <td colspan="4">No hay controles registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>