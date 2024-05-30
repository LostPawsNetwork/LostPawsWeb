<?php
require_once '../config/neon.php';

class Usuario
{
    private $conn;
    private $idUsuario;
    private $nombre;
    private $email;
    private $password;
    private $fechaNacimiento;
    private $tipoUsuario;
    private $token;
    private $codigo;
    private $tipoDocumento;
    private $numeroDocumento;

    function __construct() 
    {
        $this->conn = getPDOConnection();
    }

    function validarUsuario($correo, $passwd) 
    {
        $sql = "SELECT Password FROM Usuario WHERE Email = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) 
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($passwd, $row['Password'])) 
            {
                return true;
            }
        }
        return false;
    }

    function registrarUsuario($correo, $passwd, $nombre, $apellido, $fechaNacimiento, $tipoDocumento, $numeroDocumento, $tipoUsuario) 
    {
        $sql = "INSERT INTO Usuario (Email, Password, Nombre, Apellido, FechaNacimiento, TipoDocumento, NumeroDocumento, tipoUsuario) 
                VALUES (:correo, :passwd, :nombre, :apellido, :fechaNacimiento, :tipoDocumento, :numeroDocumento, :tipoUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':passwd', password_hash($passwd, PASSWORD_BCRYPT));
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
        $stmt->bindParam(':tipoDocumento', $tipoDocumento);
        $stmt->bindParam(':numeroDocumento', $numeroDocumento);
        $stmt->bindParam(':tipoUsuario', $tipoUsuario);
        return $stmt->execute();
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function getToken() {
        return $this->token;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    function setNumeroDocumento($numeroDocumento) {
        $this->numeroDocumento = $numeroDocumento;
    }
}
?>
