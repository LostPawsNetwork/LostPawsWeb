<?php
// tests/ExamenAptitudTest.php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../config/neon.php';  

class ExamenAptitudTest extends TestCase
{
    private $pdo;
    private $examenAptitud;

    protected function setUp(): void
    {
        // Configuración de una conexión PDO mock para pruebas
        $this->pdo = $this->createMock(PDO::class);
        $this->examenAptitud = new ExamenAptitud($this->pdo);
    }

    public function testAprobarExamenAptitud()
    {
        // Configuración del statement mock
        $stmt = $this->createMock(PDOStatement::class);
        $stmt
            ->expects($this->once())
            ->method("bindParam")
            ->with($this->equalTo(":idExamen"), $this->equalTo(1));
        $stmt->expects($this->once())->method("execute")->willReturn(true);

        // Configuración del PDO mock para devolver el statement mock
        $this->pdo
            ->expects($this->once())
            ->method("prepare")
            ->with(
                $this->equalTo(
                    "UPDATE ExamenAptitud SET estado = 'Aprobado' WHERE idExamen = :idExamen"
                )
            )
            ->willReturn($stmt);

        // Llamada a la función que se está probando
        $result = $this->examenAptitud->aprobarExamenAptitud(1);

        // Afirmación para verificar el resultado
        $this->assertTrue($result);
    }

    public function testRechazarExamenAptitud()
    {
        // Configuración del statement mock
        $stmt = $this->createMock(PDOStatement::class);
        $stmt
            ->expects($this->once())
            ->method("bindParam")
            ->with($this->equalTo(":idExamen"), $this->equalTo(2));
        $stmt->expects($this->once())->method("execute")->willReturn(true);

        // Configuración del PDO mock para devolver el statement mock
        $this->pdo
            ->expects($this->once())
            ->method("prepare")
            ->with(
                $this->equalTo(
                    "UPDATE ExamenAptitud SET estado = 'Rechazado' WHERE idExamen = :idExamen"
                )
            )
            ->willReturn($stmt);

        // Llamada a la función que se está probando
        $result = $this->examenAptitud->rechazarExamenAptitud(2);

        // Afirmación para verificar el resultado
        $this->assertTrue($result);
    }
}


?>
