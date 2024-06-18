<?php
session_start();

require_once "../datos/usuario.php";

class LoginManager
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function iniciarSesion($correo, $passwd)
    {
        $cargo = $this->usuario->validarUsuario($correo, $passwd);

        if ($cargo["success"]) {
            $_SESSION["loggedin"] = true;
            $_SESSION["correo"] = $correo;
            $_SESSION["idUsuario"] = $cargo["idUsuario"];
            $_SESSION["tipoUsuario"] = $cargo["tipoUsuario"];

            return true;
        } else {
            echo "Fallo al iniciar sesión";
            return false;
        }
    }

    public function cerrarSesion()
    {
        $_SESSION = [];

        session_destroy();

        header("Location: /lostpaws/");
        exit();
    }

    public function sesionActual()
    {
        return isset($_SESSION["correo"]);
    }
}
?>
