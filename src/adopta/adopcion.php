<?php
// Dearreglo de perros
//todo hacer consulta a base de datos para traer la info de los perros, ver formato
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
        <div class="basis-4/5 pr-3">
            <div class="grid grid-cols-3 gap-5">
                <?php
                foreach ($perros as $perro) {
                    echo "  <div class='text-center shadow-lg shadow-sky-100 outline outline-offset-2 outline-sky-200 rounded'>";
                    echo "      <div class='h-64'>";
                    echo "          <img class='rounded-md size-full' src='./assets/imagenes/perros-ejemplo/".$perro['imagen']."' alt='Imagen del canino'>";
                    echo "      </div>";
                    echo "      <div class='pb-4 pl-2 h-28'>";
                    echo "          <h5>".$perro['nombre']."</h5>";
                    echo "          <p class='text-left'>".$perro['descripcion']."</p>";
                    echo "      </div>";
                    echo "      <div class='flex flex-row h-10 bg-gray-200'>";
                    echo "          <button class='basis-1/2 hover:bg-gray-400'>";
                    echo "              Donar";
                    echo "          </button>";
                    echo "          <button class='basis-1/2 hover:bg-gray-400 '>";
                    echo "              Adoptar";
                    echo "          </button>";
                    echo "      </div>";
                    echo "  </div>";
                }
                ?>
            </div>
        </div>
        <div class="basis-1/5 pl-3">
            <?php
            //todo cuando se activen los filtros se re carga toda la página para hacer la consulta en base a lo filtrado
            ?>
            <fieldset>
                <legend>Filtros</legend>
                <form action="">
                    <label>Tamaño</label>
                    <div class="filtros-opcion">
                        <select name="dog-size" id="dog-size">
                            <option value="">...</option>
                            <option value="xl">Grande</option>
                            <option value="x">Mediano</option>
                            <option value="xs">Pequeño</option>
                        </select>
                    </div>
                    <label>Sexo</label>
                    <div class="filtros-opcion">
                        <select name="dog-sex" id="dog-size">
                            <option value="">...</option>
                            <option  value="macho">Macho</option>
                            <option value="hembra">Hembra</option>
                        </select>
                    </div>
                    <label>Edad</label>
                    <div class="filtros-opcion">
                        <select name="dog-age" id="dog-age">
                            <option value="">...</option>
                            <option value="1">0 a 1 año</option>
                            <option value="2">1 a 3 años</option>
                            <option value="3">3 a 6 años</option>
                            <option value="4">6 o más años</option>
                        </select>
                    </div>
                    <div class="filtros-footer">
                        <button style="border-radius: 1rem;" type="submit">Filtrar</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>