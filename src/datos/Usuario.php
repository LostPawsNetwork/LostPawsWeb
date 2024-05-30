<?php
    require_once '../config/neon.php';
    
    class Usuario
    {
        private $conn;

        function __construct() 
        {
            $this->conn = getPDOConnection();
        }

        function validarUsuario($correo, $passwd) 
        {
            $sql = "SELECT passwd FROM usuario WHERE correo = :correo";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) 
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($passwd, $row['passwd'])) 
                {
                    return true;
                }
            }
            return false;
        }

        function registrarUsuario($correo, $passwd, $nombre, $apellido, $fechaNacimiento, $dni, $tipoUsuario) 
        {
            $sql = "INSERT INTO usuario (correo, passwd, nombre, apellido, fechaNacimiento, dni, tipoUsuario) 
                    VALUES (:correo, :passwd, :nombre, :apellido, :fechaNacimiento, :dni, :tipoUsuario)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':passwd', password_hash($passwd, PASSWORD_BCRYPT));
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':tipoUsuario', $tipoUsuario);
            return $stmt->execute();
        }
    }
?>