<?php
require_once "../config/neon.php";

class Can
{
    private $conn;
    private $idCan;
    private $nombre;
    private $raza;
    private $edad;
    private $tamano;
    private $genero;
    private $observacionesMedicas;
    private $descripcion;
    private $foto1;
    private $foto2;
    private $foto3;
    private $estado;

    function __construct()
    {
        $this->conn = getPDOConnection();
    }

    function listarCanPorId($idCan)
    {
        $sql = "SELECT * FROM Can WHERE idCan = :idCan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idCan", $idCan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function listarCanes()
    {
        $sql = "SELECT * FROM Can";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function editarCan(
        $idCan,
        $nombre,
        $raza,
        $edad,
        $tamano,
        $genero,
        $observacionesMedicas,
        $descripcion,
        $foto1,
        $foto2,
        $foto3,
        $estado
    ) {
        $sql =
            "UPDATE Can SET nombre = :nombre, raza = :raza, edad = :edad, tamano = :tamano, genero = :genero, observacionesMedicas = :observacionesMedicas, descripcion = :descripcion, foto1 = :foto1, foto2 = :foto2, foto3 = :foto3, estado = :estado WHERE idCan = :idCan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idCan", $idCan);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":raza", $raza);
        $stmt->bindParam(":edad", $edad);
        $stmt->bindParam(":tamano", $tamano);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":observacionesMedicas", $observacionesMedicas);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":foto1", $foto1);
        $stmt->bindParam(":foto2", $foto2);
        $stmt->bindParam(":foto3", $foto3);
        $stmt->bindParam(":estado", $estado);
        return $stmt->execute();
    }

    function agregarCan(
        $nombre,
        $raza,
        $edad,
        $tamano,
        $genero,
        $observacionesMedicas,
        $descripcion,
        $foto1,
        $foto2,
        $foto3,
        $estado
    ) {
        $sql = "INSERT INTO Can (nombre, raza, edad, tamano, genero, observacionesMedicas, descripcion, foto1, foto2, foto3, estado)
                VALUES (:nombre, :raza, :edad, :tamano, :genero, :observacionesMedicas, :descripcion, :foto1, :foto2, :foto3, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":raza", $raza);
        $stmt->bindParam(":edad", $edad);
        $stmt->bindParam(":tamano", $tamano);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":observacionesMedicas", $observacionesMedicas);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":foto1", $foto1);
        $stmt->bindParam(":foto2", $foto2);
        $stmt->bindParam(":foto3", $foto3);
        $stmt->bindParam(":estado", $estado);
        return $stmt->execute();
    }

    function eliminarCan($idCan)
    {
        $sql = "DELETE FROM Can WHERE idCan = :idCan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idCan", $idCan);
        return $stmt->execute();
    }

    function registrarCan(
        $nombre,
        $raza,
        $edad,
        $tamano,
        $genero,
        $observacionesMedicas,
        $descripcion,
        $foto1,
        $foto2,
        $foto3,
        $estado
    ) {
        $sql = "INSERT INTO Can (nombre, raza, edad, tamano, genero, observacionesMedicas, descripcion, foto1, foto2, foto3, estado)
                VALUES (:nombre, :raza, :edad, :tamano, :genero, :observacionesMedicas, :descripcion, :foto1, :foto2, :foto3, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":raza", $raza);
        $stmt->bindParam(":edad", $edad);
        $stmt->bindParam(":tamano", $tamano);
        $stmt->bindParam(":genero", $genero);
        $stmt->bindParam(":observacionesMedicas", $observacionesMedicas);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":foto1", $foto1);
        $stmt->bindParam(":foto2", $foto2);
        $stmt->bindParam(":foto3", $foto3);
        $stmt->bindParam(":estado", $estado);
        return $stmt->execute();
    }

    function obtenerCanes()
    {
        $sql = "SELECT * FROM Can";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Getters y Setters

    function getIdCan()
    {
        return $this->idCan;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getRaza()
    {
        return $this->raza;
    }

    function getEdad()
    {
        return $this->edad;
    }

    function getTamano()
    {
        return $this->tamano;
    }

    function getGenero()
    {
        return $this->genero;
    }

    function getObservacionesMedicas()
    {
        return $this->observacionesMedicas;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getFoto1()
    {
        return $this->foto1;
    }

    function getFoto2()
    {
        return $this->foto2;
    }

    function getFoto3()
    {
        return $this->foto3;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function setIdCan($idCan)
    {
        $this->idCan = $idCan;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setRaza($raza)
    {
        $this->raza = $raza;
    }

    function setEdad($edad)
    {
        $this->edad = $edad;
    }

    function setTamano($tamano)
    {
        $this->tamano = $tamano;
    }

    function setGenero($genero)
    {
        $this->genero = $genero;
    }

    function setObservacionesMedicas($observacionesMedicas)
    {
        $this->observacionesMedicas = $observacionesMedicas;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setFoto1($foto1)
    {
        $this->foto1 = $foto1;
    }

    function setFoto2($foto2)
    {
        $this->foto2 = $foto2;
    }

    function setFoto3($foto3)
    {
        $this->foto3 = $foto3;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
?>
