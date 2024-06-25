<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/Donacion.php";

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    $_SESSION["tipoUsuario"] !== "user"
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = $_POST["monto"];
    $idUsuario = $_SESSION["idUsuario"];
    $fecha = date("Y-m-d H:i:s");

    // Manejar la carga del archivo
    if (isset($_FILES["comprobante"]) && $_FILES["comprobante"]["error"] == 0) {
        $comprobanteDir = "../uploads/comprobantes/";
        $comprobanteFile =
            $comprobanteDir . basename($_FILES["comprobante"]["name"]);
        move_uploaded_file(
            $_FILES["comprobante"]["tmp_name"],
            $comprobanteFile
        );
    } else {
        $comprobanteFile = null;
    }

    // Registrar la donación
    $donacion = new Donacion();
    $result = $donacion->registrarDonacion(
        $monto,
        $fecha,
        $idUsuario,
        $comprobanteFile
    );

    if ($result) {
        echo "<script>
                alert('Gracias por donar');
                window.location.href = '/lostpaws/presentacion/landingPage.php';
              </script>";
    } else {
        echo "<script>
                alert('Hubo un problema al procesar tu donación. Por favor, intenta de nuevo.');
                window.location.href = '/lostpaws/presentacion/formDonar.php';
              </script>";
    }
}
?>
