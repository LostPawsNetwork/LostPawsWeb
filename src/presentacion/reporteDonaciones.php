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

require_once "../datos/donacion.php";
$donacionObj = new Donacion();
$donaciones = $donacionObj->listarDonaciones();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Donaciones</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            z-index: 9999;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4"><br><br><br>
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Reporte Donaciones</h1>
                <a href="dashAdmin.php"><button class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</button></a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b">ID Donación</th>
                            <th class="py-2 px-4 border-b">Usuario</th>
                            <th class="py-2 px-4 border-b">Fecha</th>
                            <th class="py-2 px-4 border-b">Monto</th>
                            <th class="py-2 px-4 border-b">Comprobante</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($donaciones)) {
                            foreach ($donaciones as $donacion) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>{$donacion["iddonacion"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$donacion["nombre"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$donacion["fecha"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$donacion["monto"]}</td>";
                                echo "<td class='py-2 px-4 border-b'><button class='bg-blue-500 mr-2 text-white p-2 rounded-md hover:bg-blue-600 verComprobante' data-comprobante='{$donacion["comprobante"]}'>Ver Comprobante</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='py-2 px-4 border-b'>No hay donaciones registradas.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <div id="modalComprobante" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div>
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-3xl leading-6 mb-4 font-large text-gray-900" id="modal-title">Comprobante de Donación</h3>
                    <hr>
                    <br>
                    <div id="comprobante-content" class="grid grid-cols-1 gap-4 mb-4"></div>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script>
    $(document).ready(function(){
        $('.verComprobante').on('click', function(){
            let comprobante = $(this).data('comprobante');

            // Limpiamos el contenido previo del modal
            $('#comprobante-content').empty();

            // Mostramos el comprobante
            if (comprobante) {
                $('#comprobante-content').append(`
                    <div style="max-width: 250px;">
                        <p class="font-bold text-lg mb-2">Comprobante de Donación</p>
                        <img src="${comprobante}" alt="Comprobante" class="max-w-full mb-2">
                    </div>
                `);
            }

            // Mostramos el modal
            $('#modalComprobante').removeClass('hidden');
        });

        $('.cancelButton').on('click', function(){
            $('#modalComprobante').addClass('hidden');
        });
    });
</script>
