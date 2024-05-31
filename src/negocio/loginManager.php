<?php
    require_once '../datos/usuario.php';

    class LoginManager 
    {
        private $usuario;

        public function __construct() 
        {
            $this->usuario = new Usuario();
            if(session_status() == PHP_SESSION_NONE) 
            {
                session_start();
            }
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

        public static function generarToken($longitud = 20) {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitudCaracteres = strlen($caracteres);
            $token = '';
            for ($i = 0; $i < $longitud; $i++) {
                $token .= $caracteres[rand(0, $longitudCaracteres - 1)];
            }
            return $token;
        }
        
        
        public function enviarToken($correo, $token) 
        {
            $asunto = "Token de acceso LostPaws";
            $mensaje = "Estimado administrador,\n\nAquí está su token de acceso para LostPaws:\n\n$token";
        
            $encabezados = 'From: jeagredaramirez@gmail.com' . "\r\n" .
                'Reply-To: ' . $correo . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        
            if (mail($correo, $asunto, $mensaje, $encabezados)) 
            {
                echo "El token ha sido enviado correctamente a tu dirección de correo electrónico.";
            }
            else 
            {
            echo "Ha ocurrido un error al enviar el token. Por favor, inténtalo de nuevo más tarde.";
            }
        }
    }
?>
