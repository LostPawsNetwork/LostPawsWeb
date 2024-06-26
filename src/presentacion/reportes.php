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

require_once "../datos/usuario.php";
require_once "../datos/can.php";
$usuario = new Usuario();
$can = new Can();
$totalUsuarios = $usuario->obtenerTotalUsuarios();
$usuariosDesaprobados = $usuario->obtenerUsuariosDesaprobados();
$usuariosRechazados = $usuario->obtenerUsuariosRechazados();
$usuariosAprobados = $usuario->obtenerUsuariosAprobados();
$solicitudesAprobadas = $usuario->obtenerSolicitudesAprobadadas();
$totalCanesAdoptados = $can->listarCanesAdoptados();
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
<?php include "../components/header3.html"; ?>
<br><br><br><br>
    <div class="container mx-auto p-4">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Reportes</h1>
            <a href="../presentacion/dashAdmin.php" class="ml-auto">
                <button class="bg-bluey-dark text-white px-4 py-2 rounded-md hover-darken">Volver</button>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total de Usuarios -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="totalUsuariosChart"></canvas>
            </div>
            <!-- Total de Canes adoptados -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="totalCanesadoptadosChart"></canvas>
            </div>
            <!-- Usuarios Rechazados examen aptitud-->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="usuariosDesaprobadosChart"></canvas>
            </div>
            <!-- Usuarios aprobados examenes aptitud -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="usuariosAprobadosChart"></canvas>
            </div>
            <!-- Usuarios solicitudes aprobadas -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="solicitudesAprobadasChart"></canvas>
            </div>
            <!-- Usuarios rechazados solicitud -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <canvas id="usuariosRechazadosChart"></canvas>
            </div>
    </div>
    <br>
    <?php include "../components/footer.html"; ?>
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
                        backgroundColor: ['#C39BD3']
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
            var ctxTotalCanesadoptados = document.getElementById('totalCanesadoptadosChart').getContext('2d');
            var totalCanesadoptadosChart = new Chart(ctxTotalCanesadoptados, {
                type: 'bar',
                data: {
                    labels: ['Total de Canes adoptados'],
                    datasets: [{
                        label: 'Total de Canes adoptados',
                        data: [<?php echo $totalCanesAdoptados; ?>],
                        backgroundColor: ['#F7DC6F']
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
                    labels: ['Examenes Desaprobados'],
                    datasets: [{
                        label: 'Examenes Desaprobados',
                        data: [<?php echo $usuariosDesaprobados; ?>],
                        backgroundColor: ['#76D7C4']
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
            var ctxUsuariosAprobados = document.getElementById('usuariosAprobadosChart').getContext('2d');
                        var usuariosAprobadosChart = new Chart(ctxUsuariosAprobados, {
                            type: 'bar',
                            data: {
                                labels: ['Examenes Aprobados'],
                                datasets: [{
                                    label: 'Examenes Aprobados',
                                    data: [<?php echo $usuariosAprobados; ?>],
                                    backgroundColor: ['#85C1E9']
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
            var ctxUsuariosRechazados = document.getElementById('usuariosRechazadosChart').getContext('2d');
            var usuariosRechazadosChart = new Chart(ctxUsuariosRechazados, {
                type: 'bar',
                data: {
                    labels: ['Solicitudes Rechazadas'],
                    datasets: [{
                        label: 'Solicitudes Rechazadas',
                        data: [<?php echo $usuariosRechazados; ?>],
                        backgroundColor: ['#F8C471']
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
            var ctxSolicitudesAprobadas = document.getElementById('solicitudesAprobadasChart').getContext('2d');
            var solicitudesAprobadasChart = new Chart(ctxSolicitudesAprobadas, {
                type: 'bar',
                data: {
                    labels: ['Solicitudes Aprobadas'],
                    datasets: [{
                        label: 'Solicitudes Aprobadas',
                        data: [<?php echo $solicitudesAprobadas; ?>],
                        backgroundColor: ['#85929E ']
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