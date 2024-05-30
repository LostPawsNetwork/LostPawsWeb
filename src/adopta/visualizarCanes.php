<?php
// Dearreglo de perros
//todo hacer consulta a base de datos para traer la info de los perros, ver formato con post nos traemos los datos del filtro

$perros = array(
    array(
        "nombre" => "Georgeth",
        "imagen" => "perro1.jpg",
        "descripcion" => "Descripción del perro 1, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "Thomas",
        "imagen" => "perro2.jpg",
        "descripcion" => "Descripción del perro 2, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "Mohamed",
        "imagen" => "perro3.jpg",
        "descripcion" => "Descripción del perro 3, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "Ryan",
        "imagen" => "perro4.jpg",
        "descripcion" => "Descripción del perro 4, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "Alex",
        "imagen" => "perro5.jpg",
        "descripcion" => "Descripción del perro 5, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "perro 6",
        "imagen" => "perro6.jpg",
        "descripcion" => "Descripción del perro 6, tomando en cuenta tamaño, sexo y edad"
    )
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grid de perros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex flex-row pt-8 pr-4 pl-4 pb-6">
        <div class="basis-5/6 pr-7">
            <div class="grid grid-cols-3 gap-5">
                <?php
                foreach ($perros as $perro) {
                    echo "  <div class='text-center shadow-lg shadow-sky-100 outline outline-offset-2 outline-sky-200 rounded'>";
                    echo "      <div class='h-64'>";
                    echo "          <img class='rounded-md size-full' src='assets/imagenes/perros-ejemplo/".$perro['imagen']."' alt='Imagen del canino'>";
                    echo "      </div>";
                    echo "      <div class='pb-4 pl-2 h-28'>";
                    echo "          <h5>".$perro['nombre']."</h5>";
                    echo "          <p class='text-left'>".$perro['descripcion']."</p>";
                    echo "      </div>";
                    echo "      <div class='flex flex-row h-10 bg-gray-200'>";
                    if(isset($admin)){
                        echo "          <button class='w-full hover:bg-gray-400'>";
                        echo "              Editar can";
                        echo "          </button>";
                    }
                    else{
                        echo "          <button class='w-full hover:bg-gray-400 ' onclick='verDetalle()'>";
                        echo "              Adoptar";
                        echo "          </button>";
                    }
                    echo "      </div>";
                    echo "  </div>";
                }
                ?>
            </div>
        </div>
        <div class="basis-1/6 pl-3 pr-2 shadow-lg shadow-black-100 outline outline-offset-2 outline-black-200 rounded text-center">
            <?php
            //todo cuando se activen los filtros se re carga toda la página para hacer la consulta en base a lo filtrado
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
                                <option value="xl">Grande</option>
                                <option value="x">Mediano</option>
                                <option value="xs">Pequeño</option>
                            </select>
                        </div>
                        <label>Sexo</label>
                        <div>
                            <select name="dog-sex" id="dog-size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 border-gray-600 dark:placeholder-gray-400">
                                <option value="">...</option>
                                <option  value="macho">Macho</option>
                                <option value="hembra">Hembra</option>
                            </select>
                        </div>
                        <label>Edad</label>
                        <div class="">
                            <select name="dog-age" id="dog-age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 border-gray-600 dark:placeholder-gray-400">
                                <option value="">...</option>
                                <option value="1">0 a 1 año</option>
                                <option value="2">1 a 3 años</option>
                                <option value="3">3 a 6 años</option>
                                <option value="4">6 o más años</option>
                            </select>
                        </div>
                    </div>
                    
                    <button class="outline outline-offset-2 outline-black-100 mt-4 bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded" type="submit">Filtrar</button>
                    
                </form>
            </fieldset>
        </div>
    </div>
    
    <button class="mt-5 ml-5 px-4 py-2 bg-blue-600 text-white rounded-md" id="verDetalle">Open Modal</button>

    <!-- En tu archivo PHP -->
    <div id="myModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center xl:block xl:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden xl:inline-block xl:align-middle xl:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all xl:my-8 xl:align-middle xl:max-w-lg xl:w-full">
                <div class="bg-white px-4 pt-5 pb-4 xl:p-6 xl:pb-4">
                <div class="xl:flex xl:items-start">
                    <div class="mt-3 text-center xl:mt-0 xl:ml-4 xl:text-left">
                    <h3 class="text-xl leading-6 font-large text-gray-900" id="modal-title">Adoptar</h3>
                    <div class="mt-2">
                        <p class="text-lg text-gray-500">Seguimos trabajando para traer todos los detalles</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse">
            <button id="saveButton" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-xl">Adoptar</button>
            <button id="cancelButton" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-xl px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 xl:mt-0 xl:ml-3 xl:w-auto xl:text-xl">Cerrar</button>
            </div>
        </div>
    </div>
  </div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#verDetalle').click(function(){
            $('#myModal').removeClass('hidden');
        });
        $('#cancelButton').click(function(){
            $('#myModal').addClass('hidden');
        })
    })
    
    function verDetalle(){
        console.log('en verdetalle');
        $('#myModal').removeClass('hidden');
    }
</script>