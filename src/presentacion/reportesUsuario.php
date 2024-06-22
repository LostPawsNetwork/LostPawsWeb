<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    ($_SESSION["tipoUsuario"] !== "admin" &&
        $_SESSION["tipoUsuario"] !== "superadmin")
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

require_once '../datos/usuario.php';
$usuario = new Usuario();
$totalUsuarios = $usuario->obtenerTotalUsuarios();
$usuariosDesaprobados = $usuario->obtenerUsuariosDesaprobados();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Reportes</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total de Usuarios -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="totalUsuariosChart"></canvas>
            </div>
            
            <!-- Usuarios Desaprobados -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="usuariosDesaprobadosChart"></canvas>
            </div>
        </div>
        
        <a href="dashAdmin.php"><button class="mt-5 px-4 py-2 bg-white hover:bg-gray-200 rounded-md">Volver</button></a>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxTotalUsuarios = document.getElementById('totalUsuariosChart').getContext('2d');
            var totalUsuariosChart = new Chart(ctxTotalUsuarios, {
                type: 'bar',
                data: {
                    labels: ['Total de Usuarios'],
                    datasets: [{
                        label: 'Total de Usuarios',
                        data: [<?php echo $totalUsuarios; ?>],
                        backgroundColor: ['#4CAF50']
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctxUsuariosDesaprobados = document.getElementById('usuariosDesaprobadosChart').getContext('2d');
            var usuariosDesaprobadosChart = new Chart(ctxUsuariosDesaprobados, {
                type: 'bar',
                data: {
                    labels: ['Usuarios Desaprobados'],
                    datasets: [{
                        label: 'Usuarios Desaprobados',
                        data: [<?php echo $usuariosDesaprobados; ?>],
                        backgroundColor: ['#FF6384']
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
