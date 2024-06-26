<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    ($_SESSION["tipoUsuario"] !== "admin" &&
        $_SESSION["tipoUsuario"] !== "superadmin")
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../datos/can.php";

    $idCan = $_POST["idCan"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $tamano = $_POST["tamano"];
    $observacionesMedicas = $_POST["observacionesMedicas"];
    $descripcion = $_POST["descripcion"];

    $can = new Can();
    $can->editarCan(
        $idCan,
        $nombre,
        $edad,
        $tamano,
        $observacionesMedicas,
        $descripcion
    );

    echo "<script>
        alert('El can se ha actualizado con éxito.');
        setTimeout(function() {
            window.location.href = '../presentacion/gestionarCan.php';
        }, 1000);
    </script>";
    exit();
}
?>
