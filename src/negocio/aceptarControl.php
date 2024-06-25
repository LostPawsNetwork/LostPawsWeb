<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/control.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["idcontrol"])) {
    $idcontrol = $_GET["idcontrol"];
    
    // Lógica para aceptar el control (ejemplo hipotético)
    $control = new Control();
    $control->aceptarControl($idcontrol); // Suponiendo que tienes un método en la clase Control para aceptar el control
    
    // Redireccionar después de aceptar el control
    header("Location: ../presentacion/gestionarControl.php");
    exit;
} else {
    header("Location: ../presentacion/error.php"); // Manejo de error si no se proporciona idcontrol
    exit;
}
?>
