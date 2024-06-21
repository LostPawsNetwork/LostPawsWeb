<?php
require_once '../config/neon.php';

class Control
{
    private $conn;
    private $idControl;
    private $fechaControl;
    private $idAdopcion;
    private $nroControl;
    private $foto1;
    private $foto2;
    private $foto3;
    private $foto4;
    private $archivo;
    private $estado;

    function __construct() 
    {
        $this->conn = getPDOConnection();
    }

    public function habilitarControles($idAdopcion)
    {
        $fechaActual = new DateTime();
        $estado = "Pendiente";
    
        $stmt = $this->conn->prepare("INSERT INTO control (fechaControl, idAdopcion, nroControl, foto1, foto2, foto3, foto4, archivo, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $fechaControl);
        $stmt->bindParam(2, $idAdopcion, PDO::PARAM_INT);
        $stmt->bindParam(3, $nroControl, PDO::PARAM_INT);
        $stmt->bindParam(4, $foto1);
        $stmt->bindParam(5, $foto2);
        $stmt->bindParam(6, $foto3);
        $stmt->bindParam(7, $foto4);
        $stmt->bindParam(8, $archivo);
        $stmt->bindParam(9, $estado);
    
        for ($i = 1; $i <= 12; $i++) {
            $fechaControl = $fechaActual->modify('+1 month')->format('Y-m-d');
            $nroControl = $i;
            $foto1 = null;
            $foto2 = null;
            $foto3 = null;
            $foto4 = null;
            $archivo = null;
    
            if ($stmt->execute()) {
            } else {
                echo "Error al registrar el control $nroControl: " . $stmt->errorInfo()[2] . "<br>";
            }
        }

        header("Location: /lostpaws/presentacion/gestionarSolicitudUsuario.php");
        exit();
    
        $stmt->closeCursor();
    }

    public function listarControles($idAdopcion)
    {
        $stmt = $this->conn->prepare("SELECT * FROM control WHERE idAdopcion = ?");
        $stmt->bindParam(1, $idAdopcion, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $controles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $controles;
        } else {
            return []; // Devuelve un arreglo vacío si no hay controles encontrados
        }
    }

    public function obtenerControl($idAdopcion)
    {
        $stmt = $this->conn->prepare("SELECT * FROM control WHERE idAdopcion = ?");
        $stmt->bindParam(1, $idAdopcion, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $controles = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $controles;
        } else {
            return []; // Devuelve un arreglo vacío si no hay controles encontrados
        }
    }

    public function rellenarControl($idControl, $foto1Path, $archivoPath, $foto2Path, $foto3Path, $foto4Path)
    {
        $sql = "UPDATE control SET foto1 = :foto1, archivo = :archivo, foto2 = :foto2, foto3 = :foto3, foto4 = :foto4 WHERE idControl = :idControl";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':foto1', $foto1Path);
        $stmt->bindParam(':archivo', $archivoPath);
        $stmt->bindParam(':foto2', $foto2Path);
        $stmt->bindParam(':foto3', $foto3Path);
        $stmt->bindParam(':foto4', $foto4Path);
        $stmt->bindParam(':idControl', $idControl);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function listarControlesEnRevision()
    {
        $stmt = $this->conn->prepare("SELECT * FROM control WHERE estado = 'En revisión'");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return []; // Devuelve un arreglo vacío si no hay controles encontrados
        }
    }
}
?>
