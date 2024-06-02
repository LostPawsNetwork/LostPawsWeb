<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}
?>

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
        <?php include "../components/header2.html"; ?>

        <div class="flex-1">
            <!-- Menú Lateral -->
            <?php include "../components/sidebar2.html"; ?>

            <!-- Contenido principal de la página -->
            <main id="page-content" class="transition-transform duration-300 ease-in-out flex-1 p-4" style="top: 4rem; height: calc(100% - 4rem)">
                <p>Salto de la linea en la pagina para evitar que se solapen.</p>
                <br><br>
                <div class="relative w-full h-96 overflow-hidden">
                    <video autoplay muted loop class="absolute top-1/2 left-1/2 min-w-full min-h-full w-auto h-auto -translate-x-1/2 -translate-y-1/2 z-0">
                        <source src="../assets/videos/landing.mp4" type="video/mp4">
                        Tu navegador no soporta videos HTML5.
                    </video>
                    <div class="absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 text-center z-10">
                        <h1 class="text-white text-3xl font-bold">Lost Paws</h1>
                    </div>
                </div>

                <section class="text-center py-10 bg-white">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4">Lost Paws</h2>
                        <p class="text-gray-700 mb-6">Ofrecemos el mejor servicio veterinario para tus mascotas</p>
                        <a href="#contacto" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Contáctanos
                        </a>
                    </div>
                </section>

                <section id="adopta" class="text-center py-10 bg-white">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4">Adopta una Mascota</h2>
                        <p class="text-gray-700 mb-6">Explora las opciones para adoptar y dar un hogar a una mascota que lo necesita.</p>
                    </div>
                    <a href="#adopta" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Adopta
                    </a>
                </section>

                <!-- Nosotros -->
                <section id="nosotros" class="py-10 bg-gray-100">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4">Conoce a nuestro equipo</h2>
                        <p class="text-gray-700">Un equipo profesional y dedicado a cuidar de tus mascotas.</p>
                    </div>
                </section>

                <!-- Sección de Sedes -->
                <section id="sedes" class="py-10 bg-white">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4">Nuestras Sedes</h2>
                        <p class="text-gray-700 mb-6">Encuentra nuestra sede más cercana y ven a visitarnos.</p>
                    </div>
                    <div id="map" style="height: 400px;"></div>
                </section>
                <!-- Sección de Donación -->
                <section id="donar" class="py-10 bg-gray-100">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4">Cómo Puedes Ayudar</h2>
                        <p class="text-gray-700">Tu donación hace la diferencia para muchas mascotas.</p><br>
                        <a href="#donar" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Donar
                        </a>
                    </div>
                </section>

                <!-- Sección de Testimonios -->
                <section id="testimonios" class="py-10 bg-white">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4">Historias de Éxito</h2>
                        <p class="text-gray-700">Descubre las historias de mascotas y dueños felices gracias a nuestra ayuda.</p>
                    </div>
                </section>

                <!-- Sección de Redes Sociales -->
                <section id="redes" class="py-10 bg-gray-100">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4">Síguenos en Redes</h2>
                        <p class="text-gray-700">Mantente al día con nuestras últimas noticias y eventos en nuestras redes sociales.</p>
                    </div>
                </section>

                <!-- Sección de contacto -->
                <section id="contacto" class="py-10 bg-gray-100">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold text-center mb-6">Contacto</h2>
                        <form action="#" method="POST" class="max-w-md mx-auto bg-white p-8 shadow rounded">
                            <div class="mb-4">
                                <label for="nombre" class="block text-sm font-bold mb-2">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-bold mb-2">Email:</label>
                                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded">
                            </div>
                            <div class="mb-4">
                                <label for="mensaje" class="block text-sm font-bold mb-2">Mensaje:</label>
                                <textarea id="mensaje" name="mensaje" rows="4" class="w-full px-3 py-2 border rounded"></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">Enviar</button>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../scripts/map.js"></script>
</body>
</html>
