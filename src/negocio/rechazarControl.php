<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/control.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["idcontrol"])) {
    $idcontrol = $_GET["idcontrol"];
    
    // Obtener la información del control
    $control = new Control();
    $controlInfo = $control->obtenerControlPorId($idcontrol);
    
    if ($controlInfo) {
        // Obtener las rutas de los archivos a eliminar
        $foto1 = $controlInfo['foto1'];
        $foto2 = $controlInfo['foto2'];
        $foto3 = $controlInfo['foto3'];
        $foto4 = $controlInfo['foto4'];
        $archivo = $controlInfo['archivo'];
        
        // Eliminar los archivos si existen
        if (!empty($foto1) && file_exists($foto1)) {
            unlink($foto1);
        }
        if (!empty($foto2) && file_exists($foto2)) {
            unlink($foto2);
        }
        if (!empty($foto3) && file_exists($foto3)) {
            unlink($foto3);
        }
        if (!empty($foto4) && file_exists($foto4)) {
            unlink($foto4);
        }
        if (!empty($archivo) && file_exists($archivo)) {
            unlink($archivo);
        }
        
        // Lógica para rechazar el control
        $control->rechazarControl($idcontrol); // Suponiendo que tienes un método en la clase Control para rechazar el control
        
        // Redireccionar después de rechazar el control
        header("Location: ../presentacion/gestionarControl.php");
        exit;
    } else {
        header("Location: ../presentacion/error.php"); // Manejo de error si no se encuentra el control
        exit;
    }
} else {
    header("Location: ../presentacion/error.php"); // Manejo de error si no se proporciona idcontrol o no es método GET
    exit;
}
?>
