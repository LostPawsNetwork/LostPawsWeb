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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Perro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Agregar Nuevo Perro</h1>
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded"><?php echo $error; ?></div>
        <?php endif; ?>
        <form id="perroForm" action="../negocio/registrarPerro.php" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-bluey-dark">Nombre</label>
                <input type="text" name="nombre" id="nombre" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
            </div>
            <div>
                <label for="edad" class="block text-sm font-medium text-bluey-dark">Edad</label>
                <input type="number" name="edad" id="edad" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
            </div>
            <div>
                <label for="tamano" class="block text-sm font-medium text-bluey-dark">Tamaño</label>
                <select name="tamano" id="tamano" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    <option value="">Seleccione una opción</option>
                    <option value="grande">Grande</option>
                    <option value="mediano">Mediano</option>
                    <option value="toy">Toy</option>
                </select>
            </div>
            <div>
                <label for="genero" class="block text-sm font-medium text-bluey-dark">Género</label>
                <select name="genero" id="genero" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    <option value="">Seleccione una opción</option>
                    <option value="macho">Macho</option>
                    <option value="hembra">Hembra</option>
                </select>
            </div>
            <div>
                <label for="observacionesMedicas" class="block text-sm font-medium text-bluey-dark">Observaciones Médicas</label>
                <textarea name="observacionesMedicas" id="observacionesMedicas" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark"></textarea>
            </div>
            <div>
                <label for="descripcion" class="block text-sm font-medium text-bluey-dark">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark"></textarea>
            </div>
            <div>
                <label for="foto1" class="block text-sm font-medium text-bluey-dark">Foto del can</label>
                <input type="file" name="foto1" id="foto1" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                <button type="button" id="detectarRaza" class="bg-bluey-medium hover-lighten text-white p-2 rounded-md mt-2">Detectar Raza</button>
            </div>
            <div>
                <label for="raza" class="block text-sm font-medium text-bluey-dark">Raza</label>
                <input type="text" name="raza" id="raza" readonly required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
            </div>
            <div class="flex justify-end space-x-2">
                <a href="gestionarCan.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md">Registrar</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('detectarRaza').addEventListener('click', function() {
            var fileInput = document.getElementById('foto1');
            if (fileInput.files.length === 0) {
                alert('Por favor selecciona una imagen primero.');
                return;
            }

            var formData = new FormData();
            formData.append('file', fileInput.files[0]);

            fetch('uploadIA.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.raza) {
                    document.getElementById('raza').value = data.raza;
                } else {
                    alert('No se pudo determinar la raza. Inténtalo de nuevo.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al detectar la raza.');
            });
        });
    </script>
    <br><br>
    <?php include "../components/footer.html"; ?>

</body>
</html>
