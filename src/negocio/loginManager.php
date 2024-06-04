<?php
    session_start();
    require_once '../datos/usuario.php';

    class LoginManager 
    {
        private $usuario;

        public function __construct() 
        {
            $this->usuario = new Usuario();
            
        }

        public function iniciarSesion($correo, $passwd) 
        {
            $resultado = $this->usuario->validarUsuario($correo, $passwd);
            
            if ($resultado['success']) 
            {
                $_SESSION['correo'] = $correo;
                $_SESSION['tipoUsuario'] = $resultado['tipoUsuario'];
        
                return true;
            } 
            else 
            {
                echo "Fallo al iniciar sesión";
                return false;
            }
        }        

        public function cerrarSesion() 
        {
            session_unset();
            session_destroy();
            header("Location: ../presentacion/login.php");
            exit();
        }

        public function sesionActual() 
        {
            return isset($_SESSION['correo']);
        }
    }
?>