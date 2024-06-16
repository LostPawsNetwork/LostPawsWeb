<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true 
|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin'))
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}
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

        /* Estilo para el contenido principal */
        #main-content {
            margin-top: 60px; /* Ajusta el margen superior para que empiece después del header */
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
                                <th class="py-2 px-4 border-b">ID Usuario</th>
                                <th class="py-2 px-4 border-b">ID Can</th>
                                <th class="py-2 px-4 border-b">Fecha</th>
                                <th class="py-2 px-4 border-b">Controles</th>
                                <th class="py-2 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Aquí debes reemplazar con tu propia lógica de conexión a la base de datos y consulta
                            $controles = [
                                ['id_control' => 1, 'id_usuario' => 101, 'id_can' => 202, 'fecha' => '2024-01-01',],
                                ['id_control' => 2, 'id_usuario' => 102, 'id_can' => 203, 'fecha' => '2024-02-01',],
                                // Agrega más controles aquí
                            ];

                            foreach ($controles as $control) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>{$control['id_control']}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$control['id_usuario']}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$control['id_can']}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$control['fecha']}</td>";
                                echo "<td class='py-2 px-4 border-b'><button class='bg-blue-500 mr-2 text-white p-2 rounded-md hover:bg-blue-600 verControl'>Ver control</button></td>";
                            ?>
                                <td class="py-2 px-4 border-b"><button id="aceptarControl" class="bg-green-500 mr-2 text-white p-2 rounded-md hover:bg-green-600">Aceptar</button><button id="rechazarControl" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600">Rechazar</button></td>
                                </tr>
                            <?php }
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
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true">&#8203;</span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-3xl leading-6 mb-4 font-large text-gray-900 " id="modal-title">Controles</h3>
                    <hr>
                    <div>
                        <table class="min-w-full bg-white rounded-lg text-center">
                            <tbody>
                                <?php
                                // Aquí debes reemplazar con tu propia lógica de conexión a la base de datos y consulta
                                $controles = [
                                    ['id_control' => 1, 'resp_img' => 101,],
                                    ['id_control' => 2, 'resp_img' => 102,],
                                    // Agrega más controles aquí
                                ];

                                foreach ($controles as $control) {
                                ?>
                                <tr>
                                    <td class='py-2 px-4 border-b'>Respuesta <?php echo $control['id_control'];?></td>
                                    <td class='py-2 px-4 border-b'><button class='bg-blue-500 mr-2 text-white p-2 rounded-md hover:bg-blue-600 downloadResp'>Descargar</button></td>
                                </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
            console.log($(this).data('id'));
            let img = $(this).data('img');
            let datos = $(this).data('datos');
            let observaciones = $(this).data('obsmed');
            let descripcion = $(this).data('descrip')
            //ahora llenamos el modal
            $('#foto-can').attr('src', img);
            $('#det-descripcion').text(descripcion);
            $('#det-datos').text(datos);
            $('#ob-medicas').text(observaciones);
            $('#modalControl').removeClass('hidden');

        })

        $('.cancelButton').on('click', function(){
            $('#modalControl').addClass('hidden');
        });
    })
</script>