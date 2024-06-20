<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/examenAptitud.php";

if (isset($_POST["idexamen"])) {
    $idexamen = $_POST["idexamen"];
    $examenAptitud = new ExamenAptitud();
    $examenAptitud->aprobarExamenAptitud($idexamen);
    header("Location: ../presentacion/gestionarExamenes.php");
}
?>
