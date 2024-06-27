<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'user') {
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

// Verificar si los parámetros idControl y nroControl están presentes en la URL
if (!isset($_GET['idControl']) || !isset($_GET['nroControl'])) {
    echo "Parámetros inválidos.";
    exit;
}

$idControl = $_GET['idControl'];
$nroControl = $_GET['nroControl'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Controles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #main-content {
            margin-top: 80px; 
            padding: 20px;
            min-height: calc(100vh - 80px); 
        }
 .container {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 10px auto;
        }

        .table-container {
            overflow-x: auto;
            margin-bottom: 20px; 
        }

  
       .control-section {
            margin-bottom: 20px;
        }
        .control-section label {
            display: block;
            margin-bottom: 5px;
        }
        .control-section input[type="file"] {
            margin-bottom: 10px;
        }
        .control-section textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        .submit-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class='flex '>

        <?php include "../components/header2.html"; ?>

        <div class="flex-1 ">

            <?php include "../components/sidebar2.php"; ?>

            <div class="container mx-auto p-4">
                <br>
                <br>
                <br>
                <br>
<div class="container mx-auto p-4">
        <h1>Subir Control <?php echo htmlspecialchars($nroControl); ?></h1>
        <form action="../negocio/procesarControl.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idControl" value="<?php echo htmlspecialchars($idControl); ?>">
            <input type="hidden" name="nroControl" value="<?php echo htmlspecialchars($nroControl); ?>">

            <div class="control-section">
                <label for="fotoCan">1. Sube una foto de tu can donde se vea junto a ti, sosteniendo un letrero que indique el número del control.</label>
                <input type="file" name="fotoCan" id="fotoCan" required>
            </div>

            <div class="control-section">
                <label for="archivoVacunas">2. Sube un archivo de constancia de las vacunas puestas a la fecha. Además de sus datos de salud actualizados (Peso, dolencias, etc).</label>
                <input type="file" name="archivoVacunas" id="archivoVacunas" accept=".pdf,.doc,.docx" required>
            </div>

            <div class="control-section">
                <label for="fotosHogar">3. Por último, muéstranos un poco del hogar de tu can. (Sube 3 fotos)</label>
                <input type="file" name="fotosHogar[]" id="fotosHogar" multiple required>
            </div>

            <button type="submit" class="submit-btn">Enviar</button>
        </form>
    </div>



                        </div>

            <a href="dashAdmin.php"><button class="mt-5 px-4 py-2 bg-white hover:bg-gray-200 rounded-md">Volver</button></a>

        </div>
        <?php include "../components/footer.html"; ?>
        <script src="../scripts/dynamic.js"></script>
    </div>

</body>
</html>