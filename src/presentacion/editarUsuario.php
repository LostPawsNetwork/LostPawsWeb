<?php
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'user') 
    {
        header("Location: /lostpaws/presentacion/login.php");
        exit;
    }
    // editarUsuario.php

    // Incluye la conexión a la base de datos y la clase que contiene el método editarUsuario
    // require_once "../config/conexion.php"; // Asegúrate de que este archivo contiene la conexión a la base de datos
    require_once "../datos/usuario.php"; // Asegúrate de que este archivo contiene la clase con el método editarUsuario

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["correo"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $tipoDocumento = $_POST["tipoDocumento"];
        $numeroDocumento = $_POST["numeroDocumento"];
        $fechaNacimiento = $_POST["fechaNacimiento"];

        // Crea una instancia de la clase que contiene el método editarUsuario
        $usuario = new Usuario();
        // Llama al método editarUsuario
        $resultado = $usuario->editarUsuario(
            $correo,
            $nombre,
            $apellido,
            $tipoDocumento,
            $numeroDocumento,
            $fechaNacimiento
        );

        if ($resultado) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar el usuario.";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class='flex min-h-screen'>

        <?php include "../components/header2.html"; ?>

        <div class="flex-1 flex flex-col">

            <?php include "../components/sidebar2.html"; ?>

            <main class="flex-1 flex items-center justify-center mt-20">
                <div class="max-w-4xl bg-white p-8 rounded-lg shadow-lg text-center">
                    <h1 class="text-2xl font-bold mb-4">Editar perfil</h1>
                    <fieldset>
                        <form class="w-full max-w-xl pt-2">
                            <div class="flex flex-wrap mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Nombre
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nombre" type="text" placeholder="Nombre can">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Apellidos
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="apellidos" type="text" placeholder="Apellidos">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Correo electrónico
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="correo" type="text" placeholder="Correo electrónico">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Fecha de nacimiento
                                </label>
                                <input disabled class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nacimiento" type="date" placeholder="Fecha de nacimiento">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Documento de identidad
                                </label>
                                <input disabled class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="dni" type="text" placeholder="Documento de identidad">
                            </div>
                        </form>
                    </fieldset>
                    <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse">
                        <button id="edUsBtn" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-md">Editar</button>
                        <a href="landingPage.php" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                            Volver
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){
        $('#edUsBtn').on('click', function(){
            alert('Debería estarse editando')
        })
    })
</script>