
<?php
if (isset($_SESSION["correo"])) {
    $usuario_email = $_SESSION["correo"];

    require_once "../config/neon.php";
    require_once "../datos/adopcion.php";
    require_once "../datos/examenAptitud.php";

    $conn = getPDOConnection();

    $adopcion = new Adopcion();
    $num_adopciones = $adopcion->verificarAdopcion($_SESSION["idUsuario"]);

    $examen = new ExamenAptitud();
    $estado_examen = $examen->verificarEstado($_SESSION["correo"]);
} else {
    $num_adopciones = 0;
} ?>

<aside id="menu" class="fixed inset-y-0 left-0 transform -translate-x-full bg-blue-800 text-white w-64 overflow-auto transition-transform duration-300 ease-in-out mt-20">
    <a href="/lostpaws/presentacion/visualizarCanes.php" class="block p-4">Adopta</a>
    <a href="#nosotros" class="block p-4">Nosotros</a>
    <a href="#sedes" class="block p-4">Sede</a>
    <a href="/lostpaws/presentacion/formDonar.php" class="block p-4">Donar</a>
    <a href="#contacto" class="block p-4">Contactos</a>
    <a href="#testimonios" class="block p-4">Testimonios</a>
    <a href="#redes" class="block p-4">Redes</a>

    <?php if ($num_adopciones > 0): ?>
        <a href="/lostpaws/presentacion/misControles.php" class="block p-4">Mis Controles</a>
    <?php endif; ?>

    <?php if ($estado_examen == "Desaprobado" || $estado_examen == "Sin examen"): ?>
        <a href="#" id="crearExamenAptitud" class="block p-4">Examen Aptitud</a>
    <?php endif; ?>

    <a href="/lostpaws/presentacion/editarUsuario.php" class="block p-4">Editar Perfil</a>
</aside>

<div id="aptitudModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-3/4 md:w-1/2 p-6 rounded-lg h-auto md:h-auto lg:h-3/4">
        <h2 class="text-xl font-bold mb-4">Examen de Aptitud</h2>
        <iframe src="https://forms.gle/gubJhn4UUnbt3gEf7" class="w-full h-96 mb-4"></iframe>
        <form id="aptitudForm" action="/lostpaws/negocio/crearExamenAptitud.php" method="POST" class="flex justify-end space-x-2">
            <button type="button" id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enviar examen</button>
        </form>
    </div>
</div>

<script>
document.getElementById("crearExamenAptitud").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("aptitudModal").classList.remove("hidden");
});

document.getElementById("closeModal").addEventListener("click", function() {
    document.getElementById("aptitudModal").classList.add("hidden");
});

document.getElementById("submitExam").addEventListener("click", function() {
    window.location.href = '/lostpaws/negocio/crearExamenAptitud.php';
});
</script>