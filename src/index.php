<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Encabezado -->
    <div class='flex'>
<header class="bg-sky-500 text-white p-4 flex justify-between items-center fixed w-full z-20">
    <div class="container mx-auto flex justify-between items-center">
            <!-- Menú hamburguesa -->
            <div class="flex-initial relative">
                <button id="hamburger-btn" class="text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
            <!-- Logo -->
            <div class="flex-grow text-center">
                <a href="#" class="flex justify-center items-center">
                    <img src="assets/imagenes/huella.png" alt="Logo" class="h-8">
                </a>
            </div>
            <!-- Botón de inicio de sesión -->
            <div class="flex-initial">
                <a href="#" class="bg-blue-900 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Inicio Sesión
                </a>
            </div>
        </div>
    </header>

    <div class="flex-1">
        <!-- Menú Lateral -->
        <aside id="menu" class="fixed inset-y-0 left-0 transform -translate-x-full bg-blue-800 text-white w-64 overflow-auto transition-transform duration-300 ease-in-out z-10" style="top: 4rem; height: calc(100% - 4rem);">
            <a href="#" class="block p-4">Adopta</a>
            <a href="#" class="block p-4">Nosotros</a>
            <a href="#" class="block p-4">Sedes</a>
            <a href="#" class="block p-4">Donar</a>
            <a href="#contacto" class="block p-4">Contactos</a>
            <a href="#" class="block p-4">Testimonios</a>
            <a href="#" class="block p-4">Redes</a>
        </aside>

        <!-- Contenido principal de la página -->
        <main id="page-content" class="transition-transform duration-300 ease-in-out flex-1 p-4" style="top: 4rem; height: calc(100% - 4rem);">
            <!-- Agrega aquí el contenido de tu página -->
            <p>Aquí va el contenido principal de la página.</p>
            <br><br>
            <div class="relative w-full h-96 overflow-hidden">
                <video autoplay muted loop class="absolute top-1/2 left-1/2 min-w-full min-h-full w-auto h-auto -translate-x-1/2 -translate-y-1/2 z-0">
                    <source src="assets/videos/landing.mp4" type="video/mp4">
                    Tu navegador no soporta videos HTML5.
                </video>
                <div class="absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 text-center z-10">
                    <h1 class="text-white text-3xl font-bold">Lost Paws</h1>
                </div>
            </div>
            <!-- Sección de bienvenida -->
                <section class="text-center py-10 bg-white">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4">Lost Paws</h2>
                        <p class="text-gray-700 mb-6">Ofrecemos el mejor servicio veterinario para tus mascotas</p>
                        <a href="#contacto" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Contáctanos
                        </a>

                    </div>
                </section>
                <section id="servicios" class="py-10 bg-gray-100">
                    <div class="container mx-auto grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 shadow rounded">
                            <h3 class="font-bold text-lg">Consultas Generales</h3>
                            <p class="text-gray-600">Chequeos completos para asegurar la salud de tu mascota.</p>
                        </div>
                        <div class="bg-white p-4 shadow rounded">
                            <h3 class="font-bold text-lg">Vacunación</h3>
                            <p class="text-gray-600">Protege a tus mascotas de enfermedades y virus.</p>
                        </div>
                        <div class="bg-white p-4 shadow rounded">
                            <h3 class="font-bold text-lg">Emergencias</h3>
                            <p class="text-gray-600">Servicio de urgencias disponible 24/7 para atender cualquier imprevisto.</p>
                        </div>
                    </div>
                </section>
                <section id="nosotros" class="py-10 bg-white">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4">Conoce a nuestro equipo</h2>
                        <p class="text-gray-700">Un equipo profesional y dedicado a cuidar de tus mascotas.</p>
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


    <!-- Pie de página -->
    <footer class="bg-blue-900 text-white text-center p-4">
        <p>Veterinaria Patitas Felices &copy; 2024</p>
    </footer>
    <script>
        document.getElementById('hamburger-btn').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            var pageContent = document.getElementById('page-content');
            menu.classList.toggle('-translate-x-full');
            pageContent.classList.toggle('ml-64');
        });
    </script>
</body>
</html>
