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
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

//-----------------------------------------------------------------------------------

$adopcion = new Adopcion();
$control = new Control();

$idUsuario = $_SESSION['idUsuario'];

$idAdopcion = $adopcion->obtenerAdopcion($idUsuario);

// Verificar si se obtuvo la idAdopcion correctamente
if ($idAdopcion !== null) {
    // Obtener los controles asociados a la idAdopcion
    $controles = $control->listarControles($idAdopcion);
} else {
    echo "No se encontró una adopción para el usuario actual.";
    // Puedes redirigir o mostrar un mensaje de error adecuado aquí
}

// Función para ordenar los controles por el número de control de manera ascendente
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
        }
        .subir-control-btn:hover {
            background-color: #45a049;
        }
        .subir-control-btn[disabled] {
            background-color: #cccccc;
            color: #666666; /* Cambia el color del texto cuando está deshabilitado */
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-blue-300 p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
        <div class="flex justify-center items-center">
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
                        // Obtener la fecha de control en formato DateTime
                        $fechaControl = new DateTime($control['fechacontrol']);
                        // Obtener la fecha actual
                        $fechaActual = new DateTime();
                        // Comparar las fechas para determinar si el botón debe estar deshabilitado
                        $deshabilitarBoton = $fechaControl > $fechaActual;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($control['nrocontrol']); ?></td>
                        <td><?php echo htmlspecialchars($control['fechacontrol']); ?></td>
                        <td><?php echo htmlspecialchars($control['estado']); ?></td>
                        <td>
                            <?php if ($deshabilitarBoton) : ?>
                                <button class="subir-control-btn" disabled>Deshabilitado</button>
                            <?php else : ?>
                                <button class="subir-control-btn">Subir Control</button>
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
    </div>
    </div>
</div>

</body>
</html>
