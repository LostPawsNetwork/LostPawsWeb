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
        });

        $('#saveButton').click(function(){
            $('#myModal').addClass('hidden');
            $('#formSolicitud').removeClass('hidden');
        })

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
    })
</script>