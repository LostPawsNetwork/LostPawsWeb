<?php
require_once "../config/neon.php";

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
    // cambiar link al de la aplicacion despues
    function registrarExamenAptitud($estado, $idUsuario)
    {
        $sql = "INSERT INTO ExamenAptitud (estado, link, idUsuario)
                VALUES (:estado, 'https://docs.google.com/forms/d/19aCQadja3H2zL19ci82w9sg4H7YnwsssdHxm70djwXQ/edit#response=ACYDBNhGTBo_xbBZLT_ZmZx_XGG1iFmstuUDiikwKZuQjLzjAErJdoTry-CZkXgG88qCaXc', :idUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":idUsuario", $idUsuario);
        return $stmt->execute();
    }

    function obtenerExamenesAptitud()
    {
        $sql = "SELECT * FROM ExamenAptitud";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function aprobarExamenAptitud($idExamen)
    {
        $sql =
            "UPDATE ExamenAptitud SET estado = 'Aprobado' WHERE idExamen = :idExamen";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idExamen", $idExamen);
        return $stmt->execute();
    }

    function rechazarExamenAptitud($idExamen)
    {
        $sql =
            "UPDATE ExamenAptitud SET estado = 'Rechazado' WHERE idExamen = :idExamen";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idExamen", $idExamen);
        return $stmt->execute();
    }

    function obtenerExamenPorUsuario($idUsuario)
    {
        $sql = "SELECT estado FROM ExamenAptitud WHERE idUsuario = :idUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getIdExamen()
    {
        return $this->idExamen;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getLink()
    {
        return $this->link;
    }

    function getIdUsuario()
    {
        return $this->idUsuario;
    }

    function setIdExamen($idExamen)
    {
        $this->idExamen = $idExamen;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }

    function setLink($link)
    {
        $this->link = $link;
    }

    function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}
?>
