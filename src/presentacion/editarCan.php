<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true 
|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin')) 
{
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
</head>
<body class="bg-gray-100 h-screen font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Editar Perro</h1>
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded"><?php echo $error; ?></div>
        <?php endif; ?>
        <form id="perroForm" action="../negocio/editarPerro.php" method="post" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            <input type="hidden" name="idCan" value="<?php echo $can[
                "idcan"
            ]; ?>">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $can[
                    "nombre"
                ]; ?>" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                <input type="number" name="edad" id="edad" value="<?php echo $can[
                    "edad"
                ]; ?>" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="tamano" class="block text-sm font-medium text-gray-700">Tamaño</label>
                <select name="tamano" id="tamano" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
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
                <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                <input type="text" name="genero" id="genero" value="<?php echo $can[
                    "genero"
                ]; ?>" readonly class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-100">
            </div>
            <div>
                <label for="observacionesMedicas" class="block text-sm font-medium text-gray-700">Observaciones Médicas</label>
                <textarea name="observacionesMedicas" id="observacionesMedicas" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"><?php echo $can[
                    "observacionesmedicas"
                ]; ?></textarea>
            </div>
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"><?php echo $can[
                    "descripcion"
                ]; ?></textarea>
            </div>
            <div>
                <label for="foto1" class="block text-sm font-medium text-gray-700">Foto del can</label>
                <img src="<?php echo $can[
                    "foto1"
                ]; ?>" alt="Foto del can" class="mb-2 w-32 h-32">

            </div>
            <div>
                <label for="raza" class="block text-sm font-medium text-gray-700">Raza</label>
                <input type="text" name="raza" id="raza" value="<?php echo $can[
                    "raza"
                ]; ?>" readonly class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-100">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">Guardar Cambios</button>
            </div>
        </form>
    </div>

</body>
</html>
