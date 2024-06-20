<?php
require_once "../config/neon.php";

class Donacion
{
    private $conn;
    private $idDonacion;
    private $monto;
    private $fecha;
    private $idUsuario;

    function __construct()
    {
        $this->conn = getPDOConnection();
    }

    function registrarDonacion($monto, $fecha, $idUsuario)
    {
        $sql = "INSERT INTO Donacion (monto, fecha, idUsuario)
                VALUES (:monto, :fecha, :idUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":monto", $monto);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":idUsuario", $idUsuario);
        return $stmt->execute();
    }

    function listarDonaciones()
    {
        $sql = "SELECT * FROM Donacion";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
