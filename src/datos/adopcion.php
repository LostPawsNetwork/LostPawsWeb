<?php
require_once '../config/neon.php';

class Adopcion
{
    private $conn;
    private $idAdopcion;
    private $estado;
    private $fechaSolicitudAdopcion;
    private $idUsuario;
    private $idCan;

    function __construct() 
    {
        $this->conn = getPDOConnection();
    }

    function registrarAdopcion($estado, $fechaSolicitudAdopcion, $idUsuario, $idCan) 
    {
        $sql = "INSERT INTO Adopcion (estado, fechaSolicitudAdopcion, idUsuario, idCan) 
                VALUES (:estado, :fechaSolicitudAdopcion, :idUsuario, :idCan)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':fechaSolicitudAdopcion', $fechaSolicitudAdopcion);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':idCan', $idCan);
        return $stmt->execute();
    }

    function obtenerAdopciones()
    {
        $sql = "SELECT * FROM Adopcion";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIdAdopcion() {
        return $this->idAdopcion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFechaSolicitudAdopcion() {
        return $this->fechaSolicitudAdopcion;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdCan() {
        return $this->idCan;
    }

    function setIdAdopcion($idAdopcion) {
        $this->idAdopcion = $idAdopcion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFechaSolicitudAdopcion($fechaSolicitudAdopcion) {
        $this->fechaSolicitudAdopcion = $fechaSolicitudAdopcion;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdCan($idCan) {
        $this->idCan = $idCan;
    }
}
?>
