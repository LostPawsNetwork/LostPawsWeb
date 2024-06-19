<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true 
|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin'))
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

require_once "../datos/can.php";

$can = new Can();
$listaDeCans = $can->listarCanes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    <div id="main-content" class='flex min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Listado de Perros</h1>
                <button id="agregarCan" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">Agregar Perro</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($listaDeCans as $can): ?>
                    <div class="bg-white p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                        <?php if ($can["foto1"]): ?>
                            <img src="<?php echo htmlspecialchars($can["foto1"]); ?>" alt="Foto de <?php echo htmlspecialchars($can["nombre"]); ?>" class="h-40 w-full object-cover mb-4 rounded-lg">
                        <?php endif; ?>
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($can["nombre"]); ?></h2>
                        <p class="text-gray-700"><strong>Raza:</strong> <?php echo htmlspecialchars($can["raza"]); ?></p>
                        <p class="text-gray-700"><strong>Edad:</strong> <?php echo htmlspecialchars($can["edad"]); ?></p>
                        <p class="text-gray-700"><strong>Tamaño:</strong> <?php echo htmlspecialchars($can["tamano"]); ?></p>
                        <p class="text-gray-700"><strong>Género:</strong> <?php echo htmlspecialchars($can["genero"]); ?></p>
                        <p class="text-gray-700"><strong>Observaciones Médicas:</strong> <?php echo htmlspecialchars($can["observacionesmedicas"]); ?></p>
                        <p class="text-gray-700"><strong>Descripción:</strong> <?php echo htmlspecialchars($can["descripcion"]); ?></p>
                        <!-- <form action="editarCan.php" method="post">
                            <input type="hidden" name="idCan" value="<?php echo $can["idcan"]; ?>">
                            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Editar</button>
                        </form> -->
                        <input type="hidden" name="idCan" value="<?php echo $can["idcan"]; ?>">
                        <button
                            data-id="<?php echo $can['idcan']; ?>"
                            data-nombre="<?php echo $can['nombre']; ?>"
                            data-descripcion="<?php echo $can['descripcion']; ?>"
                            data-foto1="<?php echo $can['foto1']; ?>"
                            data-raza="<?php echo $can['raza']; ?>"
                            data-edad="<?php echo $can['edad']; ?>"
                            data-tamano="<?php echo $can['tamano']; ?>"
                            data-genero="<?php echo $can['genero']; ?>"
                            data-observacionesMedicas="<?php echo $can['observacionesmedicas']; ?>"
                            data-foto2="<?php echo $can['foto2']; ?>"
                            data-foto3="<?php echo $can['foto3']; ?>"
                            data-estado="<?php echo $can['estado']; ?>"
                            class="mt-4 bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 editarCan">Editar
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="dashAdmin.php"><button class="mt-5 px-4 py-2 bg-white hover:bg-gray-200 rounded-md">Volver</button></a>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

        <!-- Modal agregar can -->
    <div id="agregarCanModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true"></span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-xl leading-6 font-large text-gray-900 pb-2" id="modal-title">Agregar Can</h3>
                    <hr>
                    <form>
                        <div class="flex flex-wrap -mx-3 mb-6 mt-5">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Nombre
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="agNombre" type="text" placeholder="Nombre can">
                            <!-- <p class="text-red-500 text-xs italic">Ingrese todos los datos.</p> -->
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Raza
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="agRaza" type="text" placeholder="Raza">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Tamaño
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="agTamano" type="text" placeholder="Pequeño, mediano, grande">
                                <!-- <p class="text-gray-600 text-xs italic">Pequeño, mediano o grande</p> -->
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                    Género
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="agGenero" type="text" placeholder="Macho o hembra">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                    Edad
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="agEdad" type="text" placeholder="Edad en años">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    Observaciones médicas
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="agobservacionesMedicas" type="text" placeholder="Condiciones a considerar del can">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    Descripción
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="agDescripcion" type="text" placeholder="Desarrolle una breve decripción general acerca del nuevo can">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    Fotos
                                </label>
                                <input id="agFoto1" type="file" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-sky-50 file:text-sky-700
                                    hover:file:bg-sky-100
                                "/>
                            </div>
                            <div class="w-full px-3 pt-2 mb-6 md:mb-0">
                                <input id="agFoto2" type="file" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-sky-50 file:text-sky-700
                                    hover:file:bg-sky-100
                                "/>
                            </div>
                            <div class="w-full px-3 pt-2 mb-6 md:mb-0">
                                <input id="agFoto3" type="file" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-sky-50 file:text-sky-700
                                    hover:file:bg-sky-100
                                "/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button id="agCanBtn" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-md">Agregar</button>
                    <button type="button" class="mt-z3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- editar can -->
    <!-- Modal editar can -->
    <div id="editarCanModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true"></span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-xl leading-6 font-large text-gray-900 pb-2" id="modal-title">Editar Can</h3>
                    <hr>
                    <fieldset>
                        <form>
                            <div class="flex flex-wrap -mx-3 mb-6 mt-5">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                        Nombre
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="edNombre" type="text" placeholder="Nombre can">
                                <!-- <p class="text-red-500 text-xs italic">Ingrese todos los datos.</p> -->
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Raza
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="edRaza" type="text" placeholder="Raza">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Tamaño
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="edTamano" type="text" placeholder="Pequeño, mediano, grande">
                                    <!-- <p class="text-gray-600 text-xs italic">Pequeño, mediano o grande</p> -->
                                </div>
                                <div class="w-full md:w-1/3 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                        Género
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="edGenero" type="text" placeholder="Macho o hembra">
                                </div>
                                <div class="w-full md:w-1/3 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                        Edad
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="edEdad" type="text" placeholder="Edad en años">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                        Observaciones médicas
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="edObservacionesMedicas" type="text" placeholder="Condiciones a considerar del can">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                        Descripción
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="edDescripcion" type="text" placeholder="Desarrolle una breve decripción general acerca del nuevo can">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                        Fotos
                                    </label>
                                    <input id="edFoto1" type="file" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-sky-50 file:text-sky-700
                                        hover:file:bg-sky-100
                                    "/>
                                </div>
                                <div class="w-full px-3 pt-2 mb-6 md:mb-0">
                                    <input id="edFoto2" type="file" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-sky-50 file:text-sky-700
                                        hover:file:bg-sky-100
                                    "/>
                                </div>
                                <div class="w-full px-3 pt-2 mb-6 md:mb-0">
                                    <input id="edFoto3" type="file" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-sky-50 file:text-sky-700
                                        hover:file:bg-sky-100
                                    "/>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button id="edCanBtn" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-md">Editar</button>
                    <button type="button" class="mt-z3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        $('.cancelButton').on('click', function(){
            $('#agregarCanModal').addClass('hidden');
            $('#editarCanModal').addClass('hidden');
        });

        $('#agregarCan').click(function(){
            console.log('Aqui se muestra el modal')
            $('#agregarCanModal').removeClass('hidden');
        })

        $('#agCanBtn').click(function(){
            //hacer petición post a guardar can - también se puede desd el submit
            console.log('guardarcan');
            $('#agregarCanModal').addClass('hidden');
        })

        $('.editarCan').on('click', function(){
            console.log('mostramos el modal y le pasamos la info');
            $('#editarCanModal').removeClass('hidden');

            //llenamos formulario
            console.log($(this).data());
            let id = $(this).data('id')
            let nombre = $(this).data('nombre')
            let descripcion = $(this).data('descripcion')
            let foto1 = $(this).data('foto1')
            let raza = $(this).data('raza')
            let edad = $(this).data('edad')
            let tamano = $(this).data('tamano')
            let genero = $(this).data('genero')
            let observacionesMedicas = $(this).data('observacionesMedicas')
            let foto2 = $(this).data('foto2')
            let foto3 = $(this).data('foto3')
            let estado = $(this).data('estado')

            $('#edNombre').val(nombre)
            $('#edRaza').val(raza)
            $('#edTamano').val(tamano)
            $('#edGenero').val(genero)
            $('#edObservacionesmedicas').val(observacionesMedicas)
            $('#edDescripcion').val(descripcion)
            $('#edEdad').val(edad)
            $('#edFoto1').val(foto1)
            $('#edFoto2').val(foto2)
            $('#edFoto3').val(foto3)
        })

        $('#edCanBtn').click(function(){
            //mandar a editar y cerramos modal
            $('#editarCanModal').addClass('hidden');
        })
    })
</script>