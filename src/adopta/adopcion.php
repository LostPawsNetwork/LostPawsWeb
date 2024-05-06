<?php
// Dearreglo de perros
//todo hacer consulta a base de datos para traer la info de los perros, ver formato
$perros = array(
    array(
        "nombre" => "perro 1",
        "imagen" => "perro1.jpg",
        "descripcion" => "Descripción del perro 1, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "perro 2",
        "imagen" => "perro2.jpg",
        "descripcion" => "Descripción del perro 2, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "perro 3",
        "imagen" => "perro3.jpg",
        "descripcion" => "Descripción del perro 3, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "perro 4",
        "imagen" => "perro4.jpg",
        "descripcion" => "Descripción del perro 4, tomando en cuenta tamaño, sexo y edad"
    ),
    array(
        "nombre" => "perro 5",
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
    <style>
        .grid-container {
            width: 85%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
            justify-items: center;
        }
        .grid-item {
            text-align: center;
        }
        .grid-item img {
            width: 200px;
            height: 200px;
        }

        @media (max-width: 767px) {
            .grid-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                width: 85%;
            }
        }

        .card-link{
            width: 50%;
        }

        body{
            display: flex;
            padding: 1.2rem;
        }

        .filtros{
            width: 15%;
            border: 0.3px solid black;
            border-radius: 1rem;
            padding: 10px;
            text-align: center;
        }

        .filtros-opcion{
            padding-bottom: 10px;
        }

        button{
            width: 90%;
        }

        button:hover{
            background-color: rgb(166, 172, 175);
        }

        .filtros-footer{
            padding-top: 1.2rem;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="grid-container">
        <?php
        foreach ($perros as $perro) {
            echo "<div class='grid-item'>";
            echo "  <div class='card' style='width: 18rem;'>";
            echo "      <img class='card-img-top' src='".$perro['imagen']."' alt='Imagen del canino'>";
            echo "      <div class='card-body'>";
            echo "          <h5 class='card-title'>".$perro['nombre']."</h5>";
            echo "          <p class='card-text'>".$perro['descripcion']."</p>";
            echo "      </div>";
            echo "      <div class='card-footer' style='display: flex !important;'>";
            echo "          <div class='card-link'>";
            echo "              <a href='#'>Donar</a>";
            echo "          </div>";
            echo "          <div class='card-link'>";
            echo "              <a href='#'>Adoptar</a>";
            echo "          </div>";
            echo "      </div>";
            echo "  </div>";
            echo "</div>";
        }
        ?>
    </div>
    <div class="filtros">
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
</body>
</html>