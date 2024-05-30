<?php
require_once '../config/neon.php';

class Testimonio
{
    private $conn;
    private $idTestimonio;
    private $fecha;
    private $texto;
    private $idUsuario;
    private $foto;

    function __construct() 
    {
        $this->conn = getPDOConnection();
    }

    function registrarTestimonio($fecha, $texto, $idUsuario, $foto) 
    {
        $sql = "INSERT INTO Testimonio (Fecha, Texto, idUsuario, Foto) 
                VALUES (:fecha, :texto, :idUsuario, :foto)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':foto', $foto);
        return $stmt->execute();
    }

    function obtenerTestimonios()
    {
        $sql = "SELECT * FROM Testimonio";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIdTestimonio() {
        return $this->idTestimonio;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getTexto() {
        return $this->texto;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFoto() {
        return $this->foto;
    }

    function setIdTestimonio($idTestimonio) {
        $this->idTestimonio = $idTestimonio;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }
}
?>
