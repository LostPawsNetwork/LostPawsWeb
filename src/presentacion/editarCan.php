<?php
session_start();
<?php include "../components/header3.html"; ?>

|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin')) 
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

require_once "../datos/can.php";
// ayaha
echo "Se tiene que hacer un modal dentro del dashboard.php"
?>