<?php
    include '../config/neonManguito.php';

    class Usuario
    {
        private $conn;

        function __construct() 
        {
            $this->conn = getPDOConnection();
        }

        function validarUsuario($email, $password) 
        {
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
    }
?>