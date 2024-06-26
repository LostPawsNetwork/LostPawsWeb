<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Controles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados si es necesario */
        #main-content {
            margin-top: 80px; /* Ajustar según sea necesario */
            padding: 20px;
            min-height: calc(100vh - 80px); /* Ajustar para que el contenido cubra al menos el 100% del viewport menos la altura del header */
        }

        /* Tabla con scroll horizontal */
        .table-container {
            overflow-x: auto;
            margin-bottom: 20px; /* Añade margen inferior para separar del botón Volver */
        }

        /* Footer alineado a la parte inferior */
        #footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            z-index: 9999;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class='flex '>
        <?php include "../components/header2.html"; ?>
        <div class="flex-1 ">
            <?php include "../components/sidebar2.php"; ?>
            <div id="main-content">
                <div class="container mx-auto p-4">
                    <h1 class="text-3xl font-bold mb-6">Mis Controles</h1>
                    <div class="table-container">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b">Número de Control</th>
                                    <th class="py-2 px-4 border-b">Fecha de Control</th>
                                    <th class="py-2 px-4 border-b">Estado</th>
                                    <th class="py-2 px-4 border-b">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($controles)) : ?>
                                    <?php foreach ($controles as $control) : ?>
                                        <?php
                                            $fechaControl = new DateTime($control['fechacontrol']);
                                            $fechaActual = new DateTime();
                                            $estado = $control['estado'];
                                            $deshabilitarBoton = $fechaControl > $fechaActual || $estado === 'En revisión' || $estado === 'Aceptado';
                                            if ($estado === 'Aceptado') {
                                                $textoBoton = 'Aceptado';
                                            } elseif ($estado === 'En revisión') {
                                                $textoBoton = 'En revisión';
                                            } else {
                                                $textoBoton = 'Subir Control';
                                            }
                                        ?>
                                        <tr>
                                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($control['nrocontrol']); ?></td>
                                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($control['fechacontrol']); ?></td>
                                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($control['estado']); ?></td>
                                            <td class="py-2 px-4 border-b">
                                                <?php if ($deshabilitarBoton) : ?>
                                                    <button class="subir-control-btn bg-gray-400 text-white p-2 rounded-md cursor-not-allowed" disabled><?php echo htmlspecialchars($textoBoton); ?></button>
                                                <?php else : ?>
                                                    <a href="subirControl.php?idControl=<?php echo htmlspecialchars($control['idcontrol']); ?>&nroControl=<?php echo htmlspecialchars($control['nrocontrol']); ?>" class="subir-control-btn bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700"><?php echo htmlspecialchars($textoBoton); ?></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4">No hay controles registrados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="dashAdmin.php"><button class="mt-5 px-4 py-2 bg-white hover:bg-gray-200 rounded-md">Volver</button></a>
                </div>
            </div>
        </div>
    </div>
        <?php include "../components/footer.html"; ?>
    <script src="../scripts/dynamic.js"></script>
</body>
</html>
