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

require_once "../datos/can.php";

$canObj = new Can();
$idCan = $_GET["idcan"];
$can = $canObj->listarCanPorId($idCan);

if (!$can) {
    echo "Can no encontrado";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-bluey-light {
            background-color: #d4eaf7;
        }

        .bg-bluey-medium {
            background-color: #80c4f4;
        }

        .bg-bluey-dark {
            background-color: #4a4e78;
        }

        .hover-lighten:hover {
            filter: brightness(1.1);
        }

        .text-bluey-dark {
            color: #4a4e78;
        }

        .form-container {
            max-height: calc(100vh - 10rem);
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-bluey-dark h-screen font-sans relative overflow-hidden">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br><br><br><br>
    <div class="container mx-auto p-4 form-container"><br>
        <h1 class="text-3xl font-bold mb-4 text-white">Editar Can</h1>
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded"><?php echo $error; ?></div>
        <?php endif; ?>
        <form id="perroForm" action="../negocio/editarPerro.php" method="post" enctype="multipart/form-data" class="bg-bluey-light p-6 rounded-lg shadow-md space-y-4">
            <input type="hidden" name="idCan" value="<?php echo $can[
                "idcan"
            ]; ?>">
            <div>
                <label for="nombre" class="block text-sm font-medium text-bluey-dark">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $can[
                    "nombre"
                ]; ?>" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
            </div>
            <div>
                <label for="edad" class="block text-sm font-medium text-bluey-dark">Edad</label>
                <input type="number" name="edad" id="edad" value="<?php echo $can[
                    "edad"
                ]; ?>" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
            </div>
            <div>
                <label for="tamano" class="block text-sm font-medium text-bluey-dark">Tamaño</label>
                <select name="tamano" id="tamano" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    <option value="grande" <?php echo $can["tamano"] == "grande"
                        ? "selected"
                        : ""; ?>>Grande</option>
                    <option value="mediano" <?php echo $can["tamano"] ==
                    "mediano"
                        ? "selected"
                        : ""; ?>>Mediano</option>
                    <option value="toy" <?php echo $can["tamano"] == "toy"
                        ? "selected"
                        : ""; ?>>Toy</option>
                </select>
            </div>
            <div>
                <label for="genero" class="block text-sm font-medium text-bluey-dark">Género</label>
                <input type="text" name="genero" id="genero" value="<?php echo $can[
                    "genero"
                ]; ?>" readonly class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark bg-gray-100">
            </div>
            <div>
                <label for="observacionesMedicas" class="block text-sm font-medium text-bluey-dark">Observaciones Médicas</label>
                <textarea name="observacionesMedicas" id="observacionesMedicas" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark"><?php echo $can[
                    "observacionesmedicas"
                ]; ?></textarea>
            </div>
            <div>
                <label for="descripcion" class="block text-sm font-medium text-bluey-dark">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark"><?php echo $can[
                    "descripcion"
                ]; ?></textarea>
            </div>
            <div>
                <label for="foto1" class="block text-sm font-medium text-bluey-dark">Foto del can</label>
                <img src="<?php echo $can[
                    "foto1"
                ]; ?>" alt="Foto del can" class="mb-2 w-32 h-32">
            </div>
            <div>
                <label for="raza" class="block text-sm font-medium text-bluey-dark">Raza</label>
                <input type="text" name="raza" id="raza" value="<?php echo $can[
                    "raza"
                ]; ?>" readonly class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark bg-gray-100">
            </div>
            <div class="flex justify-end space-x-2">
                <a href="gestionarCan.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <?php include "../components/footer.html"; ?>

</body>
</html>
