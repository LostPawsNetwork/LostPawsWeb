<?php
require_once "../config/neon.php";

class Usuario
{
    private $conn;
    private $idUsuario;
    private $nombre;
    private $email;
    private $contrasena;
    private $fechaNacimiento;
    private $tipoUsuario;
    private $token;
    private $codigo;
    private $tipoDocumento;
    private $numeroDocumento;

    function __construct()
    {
        $this->conn = getPDOConnection();
    }

    function validarUsuario($correo, $passwd)
    {
        $sql =
            "SELECT idusuario, contrasena, tipoUsuario FROM usuario WHERE email = :correo";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($passwd, $row["contrasena"])) {
                return [
                    "success" => true,
                    "idusuario" => $row["idusuario"],
                    "tipoUsuario" => $row["tipousuario"],
                ];
            }
        } else {
            return ["success" => false, "tipoUsuario" => null];
        }

        $conn->close();
    }

    function obtenerUsuarios()
    {
        $sql = "SELECT * FROM usuario";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerToken($correo)
    {
        $sql = "SELECT token FROM usuario WHERE email = :correo";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row["token"];
        } else {
            return null;
        }
    }

    function almacenarToken($correo, $token)
    {
        $sql = "UPDATE usuario SET token = :token WHERE email = :correo";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();
    }

    function registrarUsuario(
        $correo,
        $passwd,
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $fechaNacimiento,
        $tipoUsuario
    ) {
        $sql = "INSERT INTO usuario (email, contrasena, nombre, apellido, tipoDocumento, numeroDocumento,  fechaNacimiento, tipoUsuario)
                VALUES (:correo, :passwd, :nombre, :apellido, :tipoDocumento, :numeroDocumento, :fechaNacimiento, :tipoUsuario)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $hashedPassword = password_hash($passwd, PASSWORD_BCRYPT);
        $stmt->bindParam(":passwd", $hashedPassword);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":tipoDocumento", $tipoDocumento);
        $stmt->bindParam(":numeroDocumento", $numeroDocumento);
        $stmt->bindParam(":fechaNacimiento", $fechaNacimiento);
        $stmt->bindParam(":tipoUsuario", $tipoUsuario);

        return $stmt->execute();
    }

    function editarUsuario($idUsuario, $correo, $nombre, $apellido)
    {
        $sql =
            "UPDATE usuario SET email = :correo, nombre = :nombre, apellido = :apellido WHERE idUsuario = :idUsuario";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":idUsuario", $idUsuario);

        return $stmt->execute();
    }

    //Falta terminar consulta
    function listarUsuariosDesaprobados()
    {
        $sql =
            "SELECT * FROM usuario INNER JOIN examenAptitud ON usuario.idUsuario = examenAptitud.idUsuario WHERE examenAptitud.estado = 'Desaprobado'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getIdUsuario()
    {
        return $this->idUsuario;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getContrasena()
    {
        return $this->contrasena;
    }

    function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    function getToken()
    {
        return $this->token;
    }

    function getCodigo()
    {
        return $this->codigo;
    }

    function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    function setToken($token)
    {
        $this->token = $token;
    }

    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;
    }
}
?>
