<?php
require_once "loginManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $passwd = $_POST["passwd"];

    $loginManager = new LoginManager();
    $loginExitoso = $loginManager->iniciarSesion($correo, $passwd);

    if ($loginExitoso) {
        //Usuario y contraseña detectados
        if (
            $_SESSION["tipoUsuario"] == "admin" ||
            $_SESSION["tipoUsuario"] == "superadmin"
        ) {
            //Si es admin o superadmin
            $command = escapeshellcmd(
                "python3 ../utils/enviarToken.py $correo"
            );
            $output = shell_exec($command . " 2>&1");

            if ($output !== null) {
                // La variable almacenó un resultado
                $correoEnviado =
                    strpos($output, "Correo enviado exitosamente") !== false; // Verificar si el mensaje de exito está en la variable $output

                if ($correoEnviado) {
                    // Correo enviado
                    header("Location: ../presentacion/ingresarToken.php");
                } else {
                    echo "Error al enviar el correo.";
                }
            } else {
                echo "Error al ejecutar el script.";
            }
        }
        // Si es usuario normal
        else {
            header("Location: ../presentacion/landingPage.php");
        }
    } else {
        echo "<script>alert('Email y/o contraseña incorrectos.'); window.location.href='../presentacion/login.php';</script>";
    }
}
?>
