<?php
session_start();
require_once '../datos/control.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

// Obtener el idUsuario desde la sesión
$idUsuario = $_SESSION['idUsuario'];

// Crear una instancia de la clase Control
$control = new Control();

// Obtener la adopción asociada al usuario actual (suponiendo que existe un método en la clase Adopcion para esto)
require_once '../datos/adopcion.php';
$adopcion = new Adopcion();
$idAdopcion = $adopcion->obtenerAdopcion($idUsuario);

if ($idAdopcion !== null) {
    // Obtener los controles asociados a la adopción
    $controles = $control->listarControles($idAdopcion);
} else {
    echo "No se encontró una adopción para el usuario actual.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Controles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            margin-bottom: 20px;
        }
        .control-section {
            margin-bottom: 20px;
        }
        .control-section img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación de Control</h1>
        <?php if (!empty($controles)) : ?>
            <?php foreach ($controles as $control) : ?>
                <div class="control-section">
                    <h2>Control <?php echo htmlspecialchars($control['nrocontrol']); ?></h2>
                    <?php if ($control['foto1']) : ?>
                        <img src="<?php echo htmlspecialchars($control['foto1']); ?>" alt="Foto del Can con Letrero">
                    <?php endif; ?>
                    <?php if ($control['foto2']) : ?>
                        <img src="<?php echo htmlspecialchars($control['foto2']); ?>" alt="Foto del Hogar 1">
                    <?php endif; ?>
                    <?php if ($control['foto3']) : ?>
                        <img src="<?php echo htmlspecialchars($control['foto3']); ?>" alt="Foto del Hogar 2">
                    <?php endif; ?>
                    <?php if ($control['foto4']) : ?>
                        <img src="<?php echo htmlspecialchars($control['foto4']); ?>" alt="Foto del Hogar 3">
                    <?php endif; ?>
                    <?php if ($control['archivo']) : ?>
                        <p><a href="<?php echo htmlspecialchars($control['archivo']); ?>" target="_blank">Ver archivo de constancia de vacunas</a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay controles registrados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
