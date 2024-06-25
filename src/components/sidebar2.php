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
    $num_aprobados = $examen->verificarAprobado($_SESSION["correo"]);

} else {
    $num_adopciones = 0;
    $num_aprobados = 0;
}
?>

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

    <?php if ($num_aprobados == 0): ?>
        <a href="#" id="crearExamenAptitud" class="block p-4">Examen Aptitud</a>
    <?php endif; ?>

    <a href="/lostpaws/presentacion/editarUsuario.php" class="block p-4">Editar Perfil</a>
</aside>

<script>
document.getElementById("crearExamenAptitud").addEventListener("click", function(event) {
    event.preventDefault();

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/lostpaws/negocio/crearExamenAptitud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert(xhr.responseText);
            } else {
                alert(xhr.responseText + "Hubo un problema al crear el examen de aptitud.");
            }
        }
    };

    xhr.send();
});
</script>
