<?php
session_start();

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

    <a href="/lostpaws/presentacion/examenAptitud.php" class="block p-4">Examen Aptitud</a>
    <a href="/lostpaws/presentacion/editarUsuario.php" class="block p-4">Editar Perfil</a>
</aside>
