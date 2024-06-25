<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ($_SESSION["tipoUsuario"] !== "admin" && $_SESSION["tipoUsuario"] !== "superadmin")) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

require_once '../datos/control.php';
$controlObj = new Control();
$controles = $controlObj->listarControlesEnRevision();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="">
                <h1 class="text-3xl font-bold mb-6">Control adopciones</h1>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">ID Adopción</th>
                                <th class="py-2 px-4 border-b">Fecha</th>
                                <th class="py-2 px-4 border-b">Controles</th>
                                <th class="py-2 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!empty($controles)) {
                                    foreach ($controles as $control) {
                                        echo "<tr>";
                                        echo "<td class='py-2 px-4 border-b'>{$control["idadopcion"]}</td>";
                                        echo "<td class='py-2 px-4 border-b'>{$control["fechacontrol"]}</td>";
                                        echo "<td class='py-2 px-4 border-b'><button class='bg-blue-500 mr-2 text-white 
                                        p-2 rounded-md hover:bg-blue-600 verControl'
                                        data-id='{$control["idcontrol"]}'
                                        data-nrocontrol='{$control["nrocontrol"]}'
                                        data-foto1='{$control["foto1"]}' data-archivo='{$control["archivo"]}' 
                                        data-foto2='{$control["foto2"]}' data-foto3='{$control["foto3"]}' 
                                        data-foto4='{$control["foto4"]}'>Ver control</button></td>";
                                        
                                        echo "<td class='py-2 px-4 border-b'><button id='aceptarControl' 
                                        class='bg-green-500 mr-2 text-white p-2 rounded-md hover:bg-green-600'>
                                        Aceptar</button><button id='rechazarControl' class='bg-red-500 text-white 
                                        p-2 rounded-md hover:bg-red-600'>Rechazar</button></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='py-2 px-4 border-b'>No hay controles en revisión.</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="dashAdmin.php"><button class="mt-5 px-4 py-2 bg-white hover:bg-gray-200 rounded-md">Volver</button></a>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>
    
    <div id="modalControl" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div>
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-3xl leading-6 mb-4 font-large text-gray-900" id="modal-title">Archivos del control</h3>
                    <hr>
                    <br>
                    <div id="control-images" class="grid grid-cols-1 gap-4 mb-4"></div>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button type="button" class="mt-z3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script>
    $(document).ready(function(){
        $('.verControl').on('click', function(){
            let nrocontrol = $(this).data('nrocontrol');
            let foto1 = $(this).data('foto1');
            let archivo = $(this).data('archivo');
            let foto2 = $(this).data('foto2');
            let foto3 = $(this).data('foto3');
            let foto4 = $(this).data('foto4');

            // Limpiamos el contenido previo del modal
            $('#control-images').empty();

            // Mostramos las imágenes del control
            if (foto1) {
                $('#control-images').append(`
                    <div style="max-width: 250px;">
                        <p class="font-bold text-lg mb-2">Número de control: ${nrocontrol}</p>
                        <img src="${foto1}" alt="Foto 1" class="max-w-full mb-2">
                    </div>
                `);
            }
            if (archivo) {
                $('#control-images').append(`
                    <div class="mb-4">
                        <p class="font-bold text-lg mb-2">Archivo médico del can</p>
                        <p><a href="${archivo}" target="_blank" class="text-blue-500 hover:underline">Visualizar archivo</a></p>
                    </div>
                `);
            }

            if (foto2 || foto3 || foto4) {
                $('#control-images').append(`
                    <div class="mb-4 flex flex-wrap justify-start gap-4">
                `);
                if (foto2) {
                    $('#control-images').append(`
                        <div style="max-width: 250px;">
                            <p class="font-bold text-lg mb-2">Fotos del hogar del can</p>
                            <img src="${foto2}" alt="Foto 2" class="max-w-full mb-2">
                        </div>
                    `);
                }
                if (foto3) {
                    $('#control-images').append(`
                        <div style="max-width: 250px;">
                            <img src="${foto3}" alt="Foto 3" class="max-w-full mb-2">
                        </div>
                    `);
                }
                if (foto4) {
                    $('#control-images').append(`
                        <div style="max-width: 250px;">
                            <img src="${foto4}" alt="Foto 4" class="max-w-full mb-2">
                        </div>
                    `);
                }
                $('#control-images').append(`</div>`);
            }
            // Mostramos el modal
            $('#modalControl').removeClass('hidden');
        });

        $('.cancelButton').on('click', function(){
            $('#modalControl').addClass('hidden');
        });
    });
</script>