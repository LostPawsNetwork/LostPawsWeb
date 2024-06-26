<?php
require_once "../config/neon.php";

class Donacion
{
    private $conn;
    private $idDonacion;
    private $monto;
    private $fecha;
    private $idUsuario;
    private $comprobante;

    function __construct()
    {
        $this->conn = getPDOConnection();
    }

    function registrarDonacion($monto, $fecha, $idUsuario, $comprobante = null)
    {
        $sql = "INSERT INTO Donacion (monto, fecha, idUsuario, comprobante)
                    VALUES (:monto, :fecha, :idUsuario, :comprobante)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":monto", $monto);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->bindParam(":comprobante", $comprobante);
        return $stmt->execute();
    }

    function listarDonaciones()
    {
        $sql =
            "SELECT * FROM Donacion INNER JOIN Usuario ON Donacion.idusuario = Usuario.idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
