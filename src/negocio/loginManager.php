<?php
    include '../datos/usuario.php';

    class LoginManager 
    {
        private $usuario;

        public function __construct() 
        {
            $this->usuario = new Usuario();
        }

        public function iniciarSesion($email, $password) 
        {
            $usuarioValido = $this->usuario->validarUsuario($email, $password);
            
            if ($usuarioValido) 
            {
                $_SESSION['email'] = $email;

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
            return isset($_SESSION['email']);
        }
    }
?>