<?php
    require_once '../datos/usuario.php';

    class RegistroManager 
    {
        private $usuario;

        public function __construct() 
        {
            $this->usuario = new Usuario();
        }

        public function registrarUsuario($email, $password, $nombre, $apellido, $fechaNacimiento, $celular, $sexo, $idCargo) 
        {
            // Validar datos aquí si es necesario
            return $this->usuario->registrarUsuario($email, $password, $nombre, $apellido, $fechaNacimiento, $celular, $sexo, $idCargo);
        }
    }
?>