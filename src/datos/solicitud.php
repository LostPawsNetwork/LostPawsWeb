<?php
require_once '../config/neon.php';

class Solicitud
{
    private $conn;
    private $idSolicitud;
    private $estado;
    private $link;
    private $idUsuario;
    private $idCan;

    function __construct() 
    {
        $this->conn = getPDOConnection();
    }

    function listarSolicitudes() 
    {
        $sql = "SELECT * FROM solicitud";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function registrarSolicitud($idUsuario, $idCan) 
    {
        try {
            $estado = 'Pendiente';
            $link = 'NULL'; // Suponiendo que el link puede ser nulo
            $sql = "INSERT INTO solicitud (idUsuario, idCan, estado, link) VALUES (:idUsuario, :idCan, :estado, :link)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->bindParam(':idCan', $idCan);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':link', $link);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function actualizarSolicitud($idSolicitud, $nuevoEstado)
    {
        $sql = "UPDATE solicitud SET estado = :nuevoEstado WHERE idSolicitud = :idSolicitud";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idSolicitud', $idSolicitud);
            $stmt->bindParam(':nuevoEstado', $nuevoEstado);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}