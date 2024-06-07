<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'admin') 
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

require_once "../datos/can.php";

echo "Se tiene que hacer un modal dentro del dashboard.php"
?>