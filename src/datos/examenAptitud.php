<?php
require_once '../config/neon.php';

class ExamenAptitud
{
    private $conn;
    private $idExamen;
    private $estado;
    private $link;
    private $idUsuario;

    function __construct() 
    {
        $this->conn = getPDOConnection();
    }

    function registrarExamenAptitud($estado, $link, $idUsuario) 
    {
        $sql = "INSERT INTO ExamenAptitud (estado, link, idUsuario) 
                VALUES (:estado, :link, :idUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':idUsuario', $idUsuario);
        return $stmt->execute();
    }

    function obtenerExamenesAptitud()
    {
        $sql = "SELECT * FROM ExamenAptitud";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIdExamen() {
        return $this->idExamen;
    }

    function getEstado() {
        return $this->estado;
    }

    function getLink() {
        return $this->link;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setIdExamen($idExamen) {
        $this->idExamen = $idExamen;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
}
?>
