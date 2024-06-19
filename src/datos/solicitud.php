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

    }

    function registrarSolicitud($idUsuario, $idCan) 
    {
        try {
            $estado = 'En revisión';
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

    function actualizarSolicitud() 
    {

    }
}