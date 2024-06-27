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

require_once "../datos/solicitud.php";
$solicitud = new Solicitud();
$solicitudes = $solicitud->listarSolicitudes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            z-index: 9999;
        }

        #main-content {
            margin-top: 60px;
        }
    </style>
    <script>
        function confirmarAccion(accion) {
            return confirm('¿Estás seguro que deseas ' + accion + ' esta solicitud?');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br><br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="">
                <h1 class="text-3xl font-bold mb-6">Solicitudes</h1>
                <div class="flex justify-end space-x-2 mb-4">
                    <a href="https://docs.google.com/forms/d/1NVCjJMX96Nbc48Axl1c5gSrdz9c6I9LD-cyf8VOegpk/edit#response=ACYDBNgTtMvBHnrwMXZXQ_ioCTurUsX0hZfCzrMOQrDxP9aGZkjtkyq4yhGz8J4OPQ" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md" target="_blank">Ver respuestas</a>
                    <a href="dashAdmin.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>
                </div><br>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">ID Solicitud</th>
                                <th class="py-2 px-4 border-b">Usuario</th>
                                <th class="py-2 px-4 border-b">Correo</th>
                                <th class="py-2 px-4 border-b">Can solicitado</th>
                                <th class="py-2 px-4 border-b">Estado</th>
                                <th class="py-2 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($solicitudes) {
                                foreach ($solicitudes as $solicitudAdopcion) {

                                    // Obtener datos del usuario y el can
                                    $usuario = "No disponible";
                                    $email = "No disponible";
                                    $can = "No disponible";

                                    // Verificar y obtener los detalles del usuario y del can
                                    if ($solicitudAdopcion["idusuario"]) {
                                        $usuarioDetails = $solicitud->getUsuarioById(
                                            $solicitudAdopcion["idusuario"]
                                        );
                                        if ($usuarioDetails) {
                                            $usuario =
                                                $usuarioDetails["nombre"];
                                            $email = $usuarioDetails["email"];
                                        }
                                    }

                                    if ($solicitudAdopcion["idcan"]) {
                                        $canDetails = $solicitud->getCanById(
                                            $solicitudAdopcion["idcan"]
                                        );
                                        if ($canDetails) {
                                            $can = $canDetails["nombre"];
                                        }
                                    }

                                    // Imprimir fila de la tabla con los datos obtenidos
                                    echo "<tr>";
                                    echo "<td class='py-2 px-4 border-b'>{$solicitudAdopcion["idsolicitud"]}</td>";
                                    echo "<td class='py-2 px-4 border-b'>{$usuario}</td>";
                                    echo "<td class='py-2 px-4 border-b'>{$email}</td>";
                                    echo "<td class='py-2 px-4 border-b'>{$can}</td>";
                                    echo "<td class='py-2 px-4 border-b'>{$solicitudAdopcion["estado"]}</td>";
                                    ?>
                                    <td class="py-2 px-4 border-b">
                                        <?php if (
                                            $solicitudAdopcion["estado"] ===
                                            "Pendiente"
                                        ): ?>
                                            <form action="../negocio/aceptarSolicitud.php" method="post" style="display: inline;" onsubmit="return confirmarAccion('aceptar')">
                                                <input type="hidden" name="id_solicitud" value="<?php echo $solicitudAdopcion[
                                                    "idsolicitud"
                                                ]; ?>">
                                                <input type="hidden" name="id_usuario" value="<?php echo $solicitudAdopcion[
                                                    "idusuario"
                                                ]; ?>">
                                                <input type="hidden" name="id_can" value="<?php echo $solicitudAdopcion[
                                                    "idcan"
                                                ]; ?>">
                                                <button type="submit" class="bg-green-400 mr-2 text-white p-2 rounded-md hover:bg-green-500">Aceptar</button>
                                            </form>
                                            <form action="../negocio/rechazarSolicitud.php" method="post" style="display: inline;" onsubmit="return confirmarAccion('rechazar')">
                                                <input type="hidden" name="id_solicitud" value="<?php echo $solicitudAdopcion[
                                                    "idsolicitud"
                                                ]; ?>">
                                                <input type="hidden" name="id_usuario" value="<?php echo $solicitudAdopcion[
                                                    "idusuario"
                                                ]; ?>">
                                                <input type="hidden" name="id_can" value="<?php echo $solicitudAdopcion[
                                                    "idcan"
                                                ]; ?>">
                                                <button type="submit" class="bg-red-400 text-white p-2 rounded-md hover:bg-red-500">Rechazar</button>
                                            </form>
                                        <?php else: ?>
                                            <button disabled class="bg-gray-300 text-white p-2 rounded-md cursor-not-allowed">Aceptar</button>
                                            <button disabled class="bg-gray-300 text-white p-2 rounded-md cursor-not-allowed">Rechazar</button>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                echo "<tr><td colspan='6' class='py-2 px-4 border-b'>No hay solicitudes disponibles.</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include "../components/footer.html"; ?>
</body>
</html>
