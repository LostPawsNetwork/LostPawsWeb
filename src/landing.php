<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LostPaws</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="relative w-full h-96 overflow-hidden">
        <video autoplay muted loop class="absolute top-1/2 left-1/2 min-w-full min-h-full w-auto h-auto -translate-x-1/2 -translate-y-1/2 z-0">
            <source src="assets/videos/landing.mp4" type="video/mp4">
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
        <a href="presentacion/login.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
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
        <div id="map" style="height: 400px; z-index: 1;"></div>
    </section>
    <!-- Sección de Donación -->
    <section id="donar" class="py-10 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Cómo Puedes Ayudar</h2>
            <p class="text-gray-700">Tu donación hace la diferencia para muchas mascotas.</p><br>
            <a href="./presentacion/login.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Donar
            </a>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section id="testimonios" class="py-10 bg-white">
        <div class="container mx-auto text-center grid place-content-center">
            <h2 class="text-3xl font-bold mb-4">Historias de Éxito</h2>
            <p class="text-gray-700 pb-10">Descubre las historias de mascotas y dueños felices gracias a nuestra ayuda.</p>
            <div id="carousel-historias" class="owl-carousel flex flex-row">
                <div class="max-w-lg w-full lg:flex rounded shadow m-5">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded text-center overflow-hidden" style="background-image: url('assets/imagenes/perros/adoptados/perro1.jpg')">
                    </div>
                    <div class="p-4 flex flex-col justify-between leading-normal text-left">
                        <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">Chocolate</div>
                            <p class="text-gray-700 text-base">Chocolate era un can que se encontraba en situación de calle hasta que un equipo de rescatistas lo pudieron llevar a Cruz Azul, donde se le dió la atención necesaria para poder ser adoptado por una gran familia</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-sm">
                                <p class="text-gray-900 leading-none">Jonathan Reinink</p>
                                <p class="text-gray-600">Aug 18</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-lg w-full lg:flex rounded shadow m-5">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded text-center overflow-hidden" style="background-image: url('assets/imagenes/perros/adoptados/perro2.jpg')">
                    </div>
                    <div class="p-4 flex flex-col justify-between leading-normal text-left">
                        <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">Luna</div>
                            <p class="text-gray-700 text-base">Luna era una perra que se encontraba en una situación de abandono hasta que fue rescatada por un equipo de voluntarios</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-sm">
                                <p class="text-gray-900 leading-none">Maria Pérez</p>
                                <p class="text-gray-600">Sep 10</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-lg w-full lg:flex rounded shadow m-5">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded text-center overflow-hidden" style="background-image: url('assets/imagenes/perros/adoptados/perro3.jpg')">
                    </div>
                    <div class="p-4 flex flex-col justify-between leading-normal text-left">
                        <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">Lucas</div>
                            <p class="text-gray-700 text-base">Era un perro que se encontraba en una situación de maltrato hasta que fue rescatado por una organización de protección animal</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-sm">
                                <p class="text-gray-900 leading-none">Mauricio García</p>
                                <p class="text-gray-600">Jun 29</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full" onclick="enviarContacto()">Enviar</button>
            </form>
        </div>
    </section>

    <!-- aqui vamos a poner los toast (notificaciones pequeñas)
    <div class="toast toast-top toast-end">
        <div class="alert alert-info">
            <span>Estamos guardando tu contacto para comunicarnos con usted</span>
        </div>
    </div> -->
</body>
</html>

<script>
    function enviarContacto(){
        alert('Un encargado se comunicará con usted para responder todas sus dudas');
    }
</script>