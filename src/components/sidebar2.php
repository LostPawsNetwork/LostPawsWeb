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

<aside id="menu" class="fixed inset-y-0 left-0 transform -translate-x-full bg-blue-800 text-white w-64 overflow-auto transition-transform duration-300 ease-in-out mt-20">
    <a href="/lostpaws/presentacion/visualizarCanes.php" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Adopta</a>
    <a href="#nosotros" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Nosotros</a>
    <a href="#sedes" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Sede</a>
    <a href="/lostpaws/presentacion/formDonar.php" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Donar</a>
    <a href="#contacto" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Contactos</a>
    <a href="#testimonios" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Testimonios</a>
    <a href="#redes" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Redes</a>

    <?php if ($num_adopciones > 0): ?>
        <a href="/lostpaws/presentacion/misControles.php" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Mis Controles</a>
    <?php endif; ?>

    <a href="/lostpaws/presentacion/examenAptitud.php" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Examen Aptitud</a>
    <a href="/lostpaws/presentacion/editarUsuario.php" class="block p-5 hover:bg-blue-700 hover:bg-opacity-75 hover:outline-offset-2 shadow-indigo-500/70 hover:shadow-blue-500/70 hover:shadow-lg">Editar Perfil</a>
</aside>
