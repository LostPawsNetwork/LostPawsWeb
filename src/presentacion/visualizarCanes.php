<?php

session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

require_once '../datos/can.php';

$can = new Can();
$listaDeCans = $can->listarCanes();

$size = $_POST['dog-size'] ?? '';
$sexo = $_POST['dog-sex'] ?? '';
$edad_min = $_POST['dog-edad-min']?? '';
$edad_max = $_POST['dog-edad-max']?? '';

// $listaDeCans = array(
//     array(
//         "idcan" => 1,
//         "genero" => 'macho',
//         "edad" => '3 años',
//         "tamano" => 'Grande',
//         "observacionesMedicas" => 'Can con el gen de bipolaridad',
//         "nombre" => "Georgeth",
//         "foto1" => "perro1.jpg",
//         "descripcion" => "Descripción del perro 1, tomando en cuenta tamaño, genero y edad"
//     ),
//     array(
//         "idcan" => 2,
//         "genero" => 'hembra',
//         "edad" => '2 años',
//         "tamano" => 'Pequeño',
//         "observacionesMedicas" => '-',
//         "nombre" => "Thomas",
//         "foto1" => "perro2.jpg",
//         "descripcion" => "Descripción del perro 2, tomando en cuenta tamaño, genero y edad"
//     ),
//     array(
//         "idcan" => 3,
//         "genero" => 'macho',
//         "edad" => '1 años',
//         "tamano" => 'Grande',
//         "observacionesMedicas" => 'Apego emocional al responsable se recomienda estar presente la mayoria del tiempo',
//         "nombre" => "Mohamed",
//         "foto1" => "perro3.jpg",
//         "descripcion" => "Descripción del perro 3, tomando en cuenta tamaño, genero y edad"
//     ),
//     array(
//         "idcan" => 4,
//         "genero" => 'macho',
//         "edad" => '13 años',
//         "tamano" => 'Grande',
//         "observacionesMedicas" => '-',
//         "nombre" => "Ryan",
//         "foto1" => "perro4.jpg",
//         "descripcion" => "Descripción del perro 4, tomando en cuenta tamaño, genero y edad"
//     ),
//     array(
//         "idcan" => 5,
//         "genero" => 'hembra',
//         "edad" => '6 meses',
//         "tamano" => 'grande',
//         "observacionesMedicas" => '-',
//         "nombre" => "Alex",
//         "foto1" => "perro5.jpg",
//         "descripcion" => "Descripción del perro 5, tomando en cuenta tamaño, genero y edad"
//     ),
//     array(
//         "idcan" => 6,
//         "genero" => 'hembra',
//         "edad" => '2 años',
//         "tamano" => 'Mediano',
//         "observacionesMedicas" => 'Tiene un problema en el ojo izquierdo por el que se tiene que estar aplicando gotas todos los días',
//         "nombre" => "perro 6",
//         "foto1" => "perro6.jpg",
//         "descripcion" => "Descripción del perro 6, tomando en cuenta tamaño, genero y edad"
//     )
// );
?>
<style>
    #slider-div {
    display: flex;
    flex-direction: row;
    margin-top: 30px;
    }

    #slider-div>div {
    margin: 8px;
    }

    .slider-label {
    position: absolute;
    background-color: #eeee;
    padding: 4px;
    font-size: 0.75rem;
    }
</style>

<!DOCTYPE html>
<html>
<head>
    <title>Grid de perros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css" integrity="sha512-SZgE3m1he0aEF3tIxxnz/3mXu/u/wlMNxQSnE0Cni9j/O8Gs+TjM9tm1NX34nRQ7GiLwUEzwuE3Wv2FLz2667w==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous"></script>
</head>
<body>
    <?php if($tipoUsuario == 'admin'){ ?>
        <div>
            <button class="mt-5 ml-5 px-4 py-2 bg-blue-600 text-white rounded-md" id="agregarCan">Agregar Can</button>
        </div>
    <?php } ?>
    <div class="flex flex-row pt-8 pr-4 pl-4 pb-6">
        <div class="basis-5/6 pr-7">
            <div class="grid grid-cols-3 gap-5">
                <?php
                foreach ($listaDeCans as $perro) 
                {
                ?>
                    <div class='text-center shadow-lg shadow-sky-100 outline outline-offset-2 outline-sky-200 rounded'>
                        <div class='h-64'>
                            <img class='rounded-md size-full' src='<?php echo $perro['foto1'];?>' alt='Imagen del canino'>
                        </div>
                        <div class='pt-3 pb-4 pl-2 h-28'>
                            <h5><?php echo $perro['nombre']?></h5>
                            <p class='text-left'><?php echo $perro['descripcion']?></p>
                        </div>
                        <div class='flex flex-row h-10 bg-gray-200'>
                        <button class='w-full hover:bg-gray-400 verDetalle'
                            data-id=<?php echo $perro['idcan'] ?>
                            data-descrip='<?php echo $perro['descripcion'] ?>'
                            data-img='<?php echo $perro['foto1']; ?>'
                            data-obsmed='<?php echo $perro['observacionesmedicas'] ?>'
                            data-datos='<?php echo $perro['genero']." - ".$perro['edad']. " - ".$perro['tamano']?>'
                        >
                            Adoptar
                        </button>
                    <?php
                    
                    ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="basis-1/6 pl-3 pr-2 shadow-lg shadow-black-100 outline outline-offset-2 outline-black-200 rounded text-center">
            <?php
            //todo cuando se activen los filtros se recarga toda la página para hacer la consulta en base a lo filtrado
            ?>
            <fieldset>
                <div class="mb-2 mt-3 text-2xl text-bold ">
                    <legend>Filtros</legend>
                </div>
                <form action="" method="post" target="_self">
                    <div>
                        <label>Tamaño</label>
                        <div>
                            <select name="dog-size" id="dog-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 border-gray-600 dark:placeholder-gray-400">
                                <option value="">...</option>
                                <option value="xl" <?php echo isset($size)? ($size == 'xl'?  'selected': '') : ''?>>Grande</>
                                <option value="x" <?php echo isset($size)? ($size == 'x'?  'selected': '') : ''?>>Mediano</option>
                                <option value="xs" <?php echo isset($size)? ($size == 'xs'?  'selected': '') : ''?>>Pequeño</option>
                            </select>
                        </div>
                        <label>Sexo</label>
                        <div>
                            <select name="dog-sex" id="dog-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 border-gray-600 dark:placeholder-gray-400">
                                <option value="">...</option>
                                <option  value="macho" <?php echo isset($sexo)? ($sexo == 'macho'?  'selected': '') : ''?>>Macho</option>
                                <option value="hembra" <?php echo isset($sexo)? ($sexo == 'hembra'?  'selected': '') : ''?>>Hembra</option>
                            </select>
                        </div>
                        <label>Edad</label>
                        <div class="w-3/4">
                            <input type="text" hidden id="dog-edad-min" name="dog-edad-min">
                            <input type="text" hidden id="dog-edad-max" name="dog-edad-max">
                            <div id="slider-outer-div">
                                <div id="slider-max-label" name="dog-edad-min" class="slider-label"></div>
                                <div id="slider-min-label" name="dog-edad-max" class="slider-label"></div>
                                <div id="slider-div">
                                    <div>0 años</div>
                                    <div>
                                        <input id="ex2" type="text" data-slider-min="0" data-slider-max="20" data-slider-value="[
                                            <?php echo ($edad_min != '')? $edad_min : 0 ?>, <?php echo ($edad_max != '')? $edad_max : 20 ?>]"
                                            data-slider-tooltip="hide" />
                                    </div>
                                    <div>20 años</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="outline outline-offset-2 outline-black-100 mt-4 bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded" type="submit">Filtrar</button>
                    
                </form>
            </fieldset>
        </div>
    </div>
    
    <a href="landingPage.php"><button class="mt-5 ml-5 px-4 py-2 bg-blue-600 text-white rounded-md">Volver</button></a>

    <div id="myModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true">&#8203;</span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-xl leading-6 font-large text-gray-900 " id="modal-title">Adoptar</h3>
                    <hr>
                    <div class="xl:items-start w-full">
                        <div class="mt-3 xl:mt-0 xl:ml-4 xl:text-left">
                            <div class="mt-2 flex flex-row">
                                <div class="basis-2/5 border border-black-30">
                                    <!--<img class='rounded-md size-full' alt='Imagen del canino'>-->
                                    <span id="foto-can"></span>
                                </div>
                                <div class="basis-3/5 pl-3">
                                    <h5>Descripción:</h5>
                                    <span id="det-descripcion"></span>
                                </div>
                            </div>
                            <div>
                                <div class="pb-1 pt-2">
                                    <h5>Datos:</h5>
                                    <span id="det-datos"></span>
                                </div>
                                <hr>
                                <div class="pb-1">
                                    <h5>Observaciones médicas:</h5>
                                    <span id="ob-medicas"></span>
                                </div>
                            </div>
                            <hr>
                            <div id="img_process">
                                Proceso de adopción:
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button id="saveButton" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-md">Adoptar</button>
                    <button type="button" class="mt-z3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="formSolicitud" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true">&#8203;</span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white pb-20">
                    <iframe id="gFormSoli" src="https://docs.google.com/forms/d/e/1FAIpQLSfK_93KP7a8igk9e9V2mlD3g7ykN3Zf5Q2qUhe1WNayevGWmQ/viewform?embedded=true" width="640" height="459" frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar can -->
    <div id="agregarCanModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true"></span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-xl leading-6 font-large text-gray-900 pb-2" id="modal-title">Agregar Can</h3>
                    <hr>
                    <fieldset>
                        <form class="w-full max-w-lg pt-2">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Nombre
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="agNombre" type="text" placeholder="Nombre can">
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
                    </fieldset>
                </div>
                <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse bg-gray-200">
                    <button id="agCanBtn" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-md">Agregar</button>
                    <button type="button" class="mt-z3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-md cancelButton">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- editar can -->
    <!-- Modal agregar can -->
    <div id="editarCanModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center xl:block xl:p-20">
            <div class="fixed inset-0 bg-gray-300 bg-opacity-80 transition-opacity" aria-hidden="true"></div> <!-- este es para el fondo oscuro -->
            <!-- <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true"></span> bloque para que se quede en el centro -->
            <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-2xl xl:w-full">
                <div class="bg-white px-4 pt-4 pb-2 xl:p-6 xl:pb-2">
                    <h3 class="text-xl leading-6 font-large text-gray-900 pb-2" id="modal-title">Editar Can</h3>
                    <hr>
                    <fieldset>
                        <form class="w-full max-w-lg pt-2">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Nombre
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="edNombre" type="text" placeholder="Nombre can">
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
        $('.verDetalle').on('click', function(){
            console.log($(this).data('id'));
            let img = $(this).data('img');
            let datos = $(this).data('datos');
            let observaciones = $(this).data('obsmed');
            let descripcion = $(this).data('descrip')
            //ahora llenamos el modal
            $('#foto-can').attr(img);
            $('#det-descripcion').text(descripcion);
            $('#det-datos').text(datos);
            $('#ob-medicas').text(observaciones);
            $('#myModal').removeClass('hidden');

        })

        $('.cancelButton').on('click', function(){
            $('#myModal').addClass('hidden');
            $('#formSolicitud').addClass('hidden');
            $('#agregarCanModal').addClass('hidden');
            $('#editarCanModal').addClass('hidden');
        });

        $('#saveButton').click(function(){
            $('#myModal').addClass('hidden');
            $('#formSolicitud').removeClass('hidden');
        })

        // $('#gFormSoli').on('load', function() {
        //     var iframe = document.getElementById('gFormSoli');
        //     var iframeContent = iframe.contentWindow.location.href;
        //     if (iframeContent.includes('formResponse')) {
        //         $('#formSolicitud').addClass('hidden');
        //     }
        // });


        // esto es para el filtro de rango
        const setLabel = (lbl, val) => {
            const label = $(`#slider-${lbl}-label`);
            label.text(val);
            const slider = $(`#slider-div .${lbl}-slider-handle`);
            const rect = slider[0].getBoundingClientRect();
            label.offset({
                top: rect.top - 30,
                left: rect.left
            });
        }

        const setLabels = (values) => {
            $('#dog-edad-min').val(values[0]);
            $('#dog-edad-max').val(values[1]);
            setLabel("min", values[0]);
            setLabel("max", values[1]);
        }

        $('#ex2').slider().on('slide', function(ev) {
            setLabels(ev.value);
        });
        setLabels($('#ex2').attr("data-value").split(","));

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