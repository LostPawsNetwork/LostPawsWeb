<?php
if (isset($_SESSION["correo"])) {
    $usuario_email = $_SESSION["correo"];

    require_once "../config/neon.php";

    $conn = getPDOConnection();

    $stmt = $conn->prepare(
        "SELECT COUNT(*) AS num_adopciones FROM adopcion WHERE idUsuario = (SELECT idUsuario FROM usuario WHERE email = :email)"
    );
    $stmt->bindParam(":email", $usuario_email);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $num_adopciones = $resultado["num_adopciones"];

    $stmt->closeCursor();
    $conn = null;
} else {
    $num_adopciones = 0;
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <button id="verExamen" class="block p-4">Examen Aptitud</button>
    <a href="/lostpaws/presentacion/editarUsuario.php" class="block p-4">Editar Perfil</a>
</aside>

<div id="examenAptitud" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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

<script>
    $(document).ready(function() {
        $('#verExamen').click(function(){
            $('#examenAptitud').removeClass('hidden');
        })
        $('.cancelButton').on('click', function(){
            $('#examenAptitud').addClass('hidden');
        });

        $('#saveButton').click(function(){
            $('#examenAptitud').removeClass('hidden');
        });
    })
</script>