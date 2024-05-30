<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class='flex'>
        <?php include "components/header.html"; ?>

        <div class="flex-1">
            <!-- Menú Lateral -->
            <?php include "components/sidebar.html"; ?>

            <!-- Contenido principal de la página -->
            <main id="page-content" class="transition-transform duration-300 ease-in-out flex-1 p-4" style="top: 4rem; height: calc(100% - 4rem)">
                <p>Salto de la linea en la pagina para evitar que se solapen.</p>
                <br><br>
                <?php //en esta parte recibimos el contenido a mostrar, se debe recibir la ruta con el nombre del archivo sin extensión
                    if(isset($_GET['content'])){
                        $path = $_GET['content'];
                        include "$path.php";
                    }
                    else{
                        include "landing.php";
                    }
                ?>
            </main>
        </div>
    </div>

    <?php include "components/footer.html"; ?>

    <script src="scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="scripts/map.js"></script>
</body>
</html>