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

    public function registrarAdopcion($idUsuario, $idCan) 
    {
        $fechaSolicitudAdopcion = date('Y-m-d H:i:s');
        $estado = "activa";

        
        $stmt = $this->conn->prepare("INSERT INTO adopcion (estado, fechaSolicitudAdopcion, idUsuario, idCan) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $estado);
        $stmt->bindParam(2, $fechaSolicitudAdopcion);
        $stmt->bindParam(3, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(4, $idCan, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $idAdopcion = $this->conn->lastInsertId();
            return $idAdopcion;
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
            return null;
        }
    }

    public function verificarAdopcion($idUsuario)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS num_adopciones FROM adopcion WHERE idUsuario = :idUsuario");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado["num_adopciones"];
    }

    public function obtenerAdopcion($idUsuario)
    {
        $stmt = $this->conn->prepare("SELECT idAdopcion FROM adopcion WHERE idUsuario = ?");
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && isset($resultado['idadopcion'])) {
                return $resultado['idadopcion'];
            } else {
                echo "No se encontró una adopción para el usuario con ID $idUsuario.";
                return null;
            }
        } else {
            echo "Error al obtener la adopción: " . $stmt->errorInfo()[2];
            return null;
        }
        
        $stmt->closeCursor();
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
