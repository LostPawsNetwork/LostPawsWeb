<?php
    require_once '../config/neonManguito.php';
    
    class Usuario
    {
        private $conn;

        function __construct() 
        {
            $this->conn = getPDOConnection();
        }

        function validarUsuario($email, $password) 
        {
            $sql = "SELECT password FROM tbUsuario WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) 
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) 
                {
                    return true;
                }
            }
            return false;
        }

        function registrarUsuario($email, $password, $nombre, $apellido, $fechaNacimiento, $celular, $sexo, $idCargo) 
        {
            $sql = "INSERT INTO tbusuario (email, password, nombre, apellido, fechaNacimiento, celular, sexo, idCargo) 
                    VALUES (:email, :password, :nombre, :apellido, :fechaNacimiento, :celular, :sexo, :idCargo)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':idCargo', $idCargo);
            return $stmt->execute();
        }
    }
?>