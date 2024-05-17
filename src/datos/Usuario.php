<?php
require_once "../config/neon.php";

class Usuario
{
    private $conn;

    function __construct()
    {
        $this->conn = getPDOConnection();
    }

    function validarUsuario($email, $password)
    {
        $sql = "SELECT passwd FROM usuario WHERE correo = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        //modificar una vez q este el registro hash
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password == $row["passwd"]) {
                return true;
            }
        }
        return false;
    }

    function registrarUsuario(
        $email,
        $password,
        $nombre,
        $apellido,
        $dni,
        $fechaNacimiento,
        $tipoUsuario
    ) {
        $sql = "INSERT INTO usuario (correo, passwd, nombre, apellido, dni, fechaNacimiento, tipoUsuario)
                    VALUES (:email, :password, :nombre, :apellido, :dni, :fechaNacimiento, :tipoUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(
            ":password",
            password_hash($password, PASSWORD_BCRYPT)
        );
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":fechaNacimiento", $fechaNacimiento);
        $stmt->bindParam(":tipoUsuario", $tipoUsuario);
        return $stmt->execute();
    }
}
?>
