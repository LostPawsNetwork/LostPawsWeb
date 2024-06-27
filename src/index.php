<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
      .bg-bluey-light {
          background-color: #d4eaf7;
      }

      .bg-bluey-medium {
          background-color: #80c4f4;
      }

      .bg-bluey-dark {
          background-color: #4a4e78;
      }

      .hover-lighten:hover {
          filter: brightness(1.1);
      }

      .text-bluey-dark {
          color: #4a4e78;
      }
  </style>
</head>

<body class="bg-white">

    <div class='flex'>

        <!-- Encabezado -->
        <?php include "components/header.html"; ?>

        <div class="flex-1">

            <!-- Menú Lateral -->
            <?php include "components/sidebar.html"; ?>

            <!-- Contenido principal de la página -->
            <main id="page-content" class="transition-transform duration-300 ease-in-out flex-1 p-4 bg-white" style="top: 4rem; height: calc(100% - 4rem)">
                <p>Salto de la linea en la pagina para evitar que se solapen.</p>
                <br><br>
                <div class="relative w-full h-96 overflow-hidden">
                    <video autoplay muted loop class="absolute top-1/2 left-1/2 min-w-full min-h-full w-auto h-auto -translate-x-1/2 -translate-y-1/2 z-0">
                        <source src="assets/videos/landing.mp4" type="video/mp4">
                        Tu navegador no soporta videos HTML5.
                    </video>
                    <div class="absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 text-center z-10">
                        <h1 class="text-white text-3xl font-bold">Lost Paws</h1>
                        <p class="text-white text-base mt-1 mx-auto max-w-md">
                        Buscamos hogares llenos de amor, cariño y responsabilidad para perros necesitados.
                        Adopta y brinda una segunda oportunidad a un amigo peludo que espera por un corazón generoso como el tuyo.
                        </p>
                    </div>
                </div>

                <!-- Desplazar a formulario de contacto -->
                <section class="text-center py-10 bg-bluey-light">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Lost Paws</h2>
                        <p class="text-bluey-dark mb-6">Ofrecemos el mejor servicio veterinario para tus mascotas</p>
                        <a href="#contacto" class="bg-bluey-medium hover:bg-bluey-dark text-white font-bold py-2 px-4 rounded">
                            Contáctanos
                        </a>
                    </div>
                </section>

                <!-- Adoptar -->
                <section id="adopta" class="text-center py-10 bg-bluey-light">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Adopta una Mascota</h2>
                        <p class="text-bluey-dark mb-6">Explora las opciones para adoptar y dar un hogar a una mascota que lo necesita.</p>
                    </div>
                    <a href="presentacion/login.php" class="bg-bluey-medium hover:bg-bluey-dark text-white font-bold py-2 px-4 rounded">
                        Adopta
                    </a>
                </section>

                <!-- Nosotros -->
                <section id="nosotros" class="py-10 bg-bluey-medium">
                    <div class="container mx-auto text-center mt-16 mb-16">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Conoce a nuestro equipo</h2>
                        <p class="text-bluey-dark mb-8">Un equipo profesional y dedicado a cuidar de tus mascotas.</p>
                        <div class="flex justify-center gap-6">
                            <div class="w-full sm:w-1/2 md:w-1/3 p-2 flex flex-col items-center bg-white border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-500 transform hover:scale-105">
                                <img src="assets/images/medico1.jpg" alt="Medico 1" class="w-48 h-48 object-cover rounded-lg">
                                <h3 class="text-xl font-bold mt-4 text-bluey-dark">Dr. Guillermo Franco</h3>
                                <p class="text-bluey-dark">Cirugía General</p>
                            </div>
                            <div class="w-full sm:w-1/2 md:w-1/3 p-2 flex flex-col items-center bg-white border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-500 transform hover:scale-105">
                                <img src="assets/images/medico2.jpg" alt="Medico 2" class="w-48 h-48 object-cover rounded-lg">
                                <h3 class="text-xl font-bold mt-4 text-bluey-dark">Dra. Leticia Vargas </h3>
                                <p class="text-bluey-dark">Medicina General</p>
                            </div>
                            <div class="w-full sm:w-1/2 md:w-1/3 p-2 flex flex-col items-center bg-white border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-500 transform hover:scale-105">
                                <img src="assets/images/medico3.jpg" alt="Medico 3" class="w-48 h-48 object-cover rounded-lg">
                                <h3 class="text-xl font-bold mt-4 text-bluey-dark">Dra. Giuliana Lira</h3>
                                <p class="text-bluey-dark">Estética Canina</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Sección de Sedes -->
                <section id="sedes" class="py-10 bg-bluey-light">
                    <div class="container mx-auto mt-16">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Nuestras Sedes</h2>
                        <p class="text-bluey-dark mb-6">Encuentra nuestra sede más cercana y ven a visitarnos.</p>
                    </div>
                    <div id="map" style="height: 400px; z-index: 1"></div>
                </section>

                <!-- Sección de Donación -->
                <section id="donar" class="py-10 bg-bluey-medium">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Cómo Puedes Ayudar</h2>
                        <p class="text-bluey-dark">Tu donación hace la diferencia para muchas mascotas.</p><br>
                        <a href="presentacion/login.php" class="bg-bluey-dark hover:bg-bluey-light text-white font-bold py-2 px-4 rounded">
                            Donar
                        </a>
                    </div>
                </section>

                <!-- Sección de Testimonios -->
                <section id="testimonios" class="py-10 bg-bluey-light">
                    <div class="container mx-auto text-center mt-16 mb-16">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Historias de Éxito</h2>
                        <p class="text-bluey-dark">Descubre las historias de mascotas y dueños felices gracias a nuestra ayuda.</p>
                        <br>
                        <div class="flex justify-center gap-6">
                            <div class="w-full sm:w-1/2 md:w-1/3 p-2 flex flex-col items-center testimonial-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-500 transform hover:scale-105">
                                <img src="assets/images/canes/perro1.jpg" alt="Chocolate" class="w-48 h-48 object-cover rounded-lg">
                                <div class="p-4 flex flex-col justify-between leading-normal text-left">
                                    <h3 class="text-xl font-bold mt-4 text-bluey-dark">Chocolate</h3>
                                    <p class="text-bluey-dark">Chocolate era un can que se encontraba en situación de calle hasta que un equipo de rescatistas lo pudieron llevar a Cruz Azul, donde se le dió la atención necesaria para poder ser adoptado por una gran familia.</p>
                                    <div class="text-sm mt-4">
                                        <p class="text-bluey-dark leading-none">Jonathan Reinink</p>
                                        <p class="text-gray-600">Aug 18</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/2 md:w-1/3 p-2 flex flex-col items-center testimonial-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-500 transform hover:scale-105">
                            <img src="assets/images/canes/perro2.jpg" alt="Rocko" class="w-48 h-48 object-cover rounded-lg">
                                <div class="p-4 flex flex-col justify-between leading-normal text-left">
                                    <h3 class="text-xl font-bold mt-4 text-bluey-dark">Rocko</h3>
                                    <p class="text-bluey-dark">Rocko, un hermoso labrador de 5 años fue encontrado abandonado en un parque, después de su rescate y rehabilitación, encontró una familia amorosa que le dió una segunda oportunidad.</p>
                                    <div class="text-sm mt-4">
                                        <p class="text-bluey-dark leading-none">Sarah Finn</p>
                                        <p class="text-gray-600">Sept 22</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/2 md:w-1/3 p-2 flex flex-col items-center testimonial-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-500 transform hover:scale-105">
                            <img src="assets/images/canes/perro3.jpg" alt="Canela" class="w-48 h-48 object-cover rounded-lg">
                                <div class="p-4 flex flex-col justify-between leading-normal text-left">
                                    <h3 class="text-xl font-bold mt-4 text-bluey-dark">Canela</h3>
                                    <p class="text-bluey-dark">Canela fue encontrada herida y asustada en las calles. Después de recibir tratamiento médico y mucho cariño, se convirtió en la mascota favorita de su nueva familia.</p>
                                    <div class="text-sm mt-4">
                                        <p class="text-bluey-dark leading-none">Mark Johnson</p>
                                        <p class="text-gray-600">Oct 11</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Sección de contacto -->
                <section id="contacto" class="py-10 bg-bluey-medium">
                    <div class="container mx-auto mt-16 mb-16">
                        <h2 class="text-3xl font-bold text-center mb-6 text-bluey-dark">Contacto</h2>
                        <form action="negocio/enviarContacto.php" method="POST" class="max-w-md mx-auto bg-white p-8 shadow rounded">
                            <div class="mb-4">
                                <label for="nombre" class="block text-sm font-bold mb-2 text-bluey-dark">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-bold mb-2 text-bluey-dark">Email:</label>
                                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label for="mensaje" class="block text-sm font-bold mb-2 text-bluey-dark">Mensaje:</label>
                                <textarea id="mensaje" name="mensaje" rows="4" class="w-full px-3 py-2 border rounded" required></textarea>
                            </div>
                            <button type="submit" class="bg-bluey-dark hover:bg-bluey-light text-white font-bold py-2 px-4 rounded w-full">Enviar</button>
                        </form>
                    </div>
                </section>

                <!-- Sección de Redes Sociales -->
                <section id="redes" class="py-10 bg-bluey-light">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4 text-bluey-dark">Síguenos en Redes</h2>
                        <p class="text-bluey-dark">Mantente al día con nuestras últimas noticias y eventos en nuestras redes sociales.</p>
                        <div id="iconredes" class="flex justify-center space-x-6 p-12">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/people/Lost-Paws/61561502880839/" target="_blank" class="[&>svg]:h-12 [&>svg]:w-12 [&>svg]:fill-[#1877f2]" aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://www.instagram.com/lostpaws1/" target="_blank" class="[&>svg]:h-12 [&>svg]:w-12 [&>svg]:fill-[#c13584]" aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Pie de página -->
    <?php include "components/footer.html"; ?>

    <!-- Scripts para el mapa y el botón hamburguesa -->
    <script src="scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="scripts/map.js"></script>
</body>
</html>
