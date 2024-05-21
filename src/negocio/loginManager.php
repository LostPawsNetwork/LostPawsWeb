<?php
    require_once '../datos/Usuario.php';

    class LoginManager 
    {
        private $usuario;

        public function __construct() 
        {
            $this->usuario = new Usuario();
        }

        public function iniciarSesion($correo, $passwd) 
        {
            $usuarioValido = $this->usuario->validarUsuario($correo, $passwd);
            
            if ($usuarioValido) 
            {
                $_SESSION['correo'] = $correo;

                return true;
            } 
            else 
            {
                return false;
            }
        }

        public function cerrarSesion() 
        {
            session_unset();
            session_destroy();
        }

        public function sesionActual() 
        {
            return isset($_SESSION['correo']);
        }
    }
?>