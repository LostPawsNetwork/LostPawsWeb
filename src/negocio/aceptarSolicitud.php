<?php
require_once '../datos/adopcion.php';
require_once '../datos/control.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['id_usuario'];
    $idCan = $_POST['id_can'];

    $adopcion = new Adopcion();
    $idAdopcion = $adopcion->registrarAdopcion($idUsuario, $idCan);

    if ($idAdopcion !== null) {
        $control = new Control();
        $control->habilitarControles($idAdopcion);
    } else {
        echo "ERROR: Adopcion NULL.";
    }

} else {
    header("Location: dashAdmin.php");
    exit();
}
?>