<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    $_SESSION["tipoUsuario"] !== "superadmin"
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

include "../datos/usuario.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradores</title>
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

        #main-content {
            margin-top: 60px;
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Gestionar Administradores</h1>
                <a href="dashAdmin.php"><button class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</button></a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b">ID Administración</th>
                            <th class="py-2 px-4 border-b">Nombre</th>
                            <th class="py-2 px-4 border-b">Correo</th>
                            <th class="py-2 px-4 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usuario = new Usuario();
                        $administradores = $usuario->listarAdministradores();

                        if (!empty($administradores)) {
                            foreach ($administradores as $administrador) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>{$administrador["idusuario"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$administrador["nombre"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$administrador["email"]}</td>";
                                echo "<td class='py-2 px-4 border-b'><button class='bg-blue-500 mr-2 text-white p-2 rounded-md hover:bg-blue-600 editarCorreo' data-correo='{$administrador["email"]}'>Editar</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='py-2 px-4 border-b'>No hay administradores registrados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <div id="modalEditarAdmin" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true">&#8203;</span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-3xl leading-6 mb-4 font-large text-gray-900 " id="modal-title">Editar administrador</h3>
                    <hr>
                    <div>
                        <form action="../negocio/editarAdministrador.php" method="POST">
                            <div class="mb-4">
                                <label for="correoAdmin" class="block text-sm font-medium text-gray-700">Correo</label>
                                <input type="email" name="correoAdmin" id="correoAdmin" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" required>
                                <input type="hidden" name="correoOriginal" id="correoOriginal">
                            </div>
                            <div class="flex justify-center">
                                <button type="submit" class="bg-blue-600 text-white w-full p-2 rounded-md hover:bg-blue-700">Editar</button>
                            </div>
                        </form>
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
        $('.editarCorreo').on('click', function(){
            console.log($(this).data('id'));
            let img = $(this).data('img');
            let datos = $(this).data('datos');
            let observaciones = $(this).data('obsmed');
            let descripcion = $(this).data('descrip');
            let correo = $(this).data('correo'); // Obtener el correo

            // ahora llenamos el modal
            $('#foto-can').attr('src', img);
            $('#det-descripcion').text(descripcion);
            $('#det-datos').text(datos);
            $('#ob-medicas').text(observaciones);
            $('#correoAdmin').val(correo); // Llenar el campo del correo
            $('#correoOriginal').val(correo); // Llenar el campo oculto con el correo original
            $('#modalEditarAdmin').removeClass('hidden');
        });

        $('.cancelButton').on('click', function(){
            $('#modalEditarAdmin').addClass('hidden');
        });
    });
</script>
