<?php
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    private $pdo;
    private $usuario;

    protected function setUp(): void
    {
        // Configuración de una conexión PDO mock para pruebas
        $this->pdo = $this->createMock(PDO::class);
        $this->usuario = new Usuario($this->pdo);
    }

    public function testEditarUsuario()
    {
        // Configuración del statement mock
        $stmt = $this->createMock(PDOStatement::class);
        $stmt
            ->expects($this->once())
            ->method("bindParam")
            ->withConsecutive(
                [":correo", "test@example.com"],
                [":nombre", "Juan"],
                [":apellido", "Pérez"],
                [":tipoDocumento", "DNI"],
                [":numeroDocumento", "12345678"],
                [":fechaNacimiento", "1990-01-01"]
            );
        $stmt->expects($this->once())->method("execute")->willReturn(true);

        // Configuración del PDO mock para devolver el statement mock
        $this->pdo
            ->expects($this->once())
            ->method("prepare")
            ->with(
                $this->equalTo(
                    "UPDATE Usuario SET Nombre = :nombre, Apellido = :apellido, TipoDocumento = :tipoDocumento, NumeroDocumento = :numeroDocumento, FechaNacimiento = :fechaNacimiento WHERE Email = :correo"
                )
            )
            ->willReturn($stmt);

        // Llamada a la función que se está probando
        $result = $this->usuario->editarUsuario(
            "test@example.com",
            "Juan",
            "Pérez",
            "DNI",
            "12345678",
            "1990-01-01"
        );

        // Afirmación para verificar el resultado
        $this->assertTrue($result);
    }
}
?>
