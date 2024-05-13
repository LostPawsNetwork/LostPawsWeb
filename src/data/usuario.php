<?php
    include '../config/neonManguito.php';

    class Datos
    {
        private $conn;

        function __construct() 
        {
            $this->conn = getPDOConnection();
        }

        public $idUsuario;
        public $email;
        public $password;

        function validarUsuario($email, $password) 
        {
            // Utilizando consultas preparadas para evitar la inyección SQL
            $sql = "SELECT email, password FROM tbusuario WHERE email = :email AND password = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) 
            {
                return true;
            }
            else 
            {
                return false;
            }
        }

        function getIdUsario() 
        {
            return $this->idUsuario;
        }

        function setIdUsario($idUsuario) 
        {
            $this->idUsuario = $idUsuario;
        }

        function getEmail() 
        {
            return $this->email;
        }

        function setEmail($email) 
        {
            $this->email = $email;
        }

        function getPassword() 
        {
            return $this->password;
        }

        function setPassword($password) 
        {
            $this->password = $password;
        }
    }
?>