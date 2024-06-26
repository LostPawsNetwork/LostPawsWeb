<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    $_SESSION["tipoUsuario"] !== "user"
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #video-background {
            z-index: -1;
        }
    </style>
    <script>
        function validateForm() {
            var monto = document.getElementById("monto").value;
            var comprobante = document.getElementById("comprobante").value;
            if (monto === "" || comprobante === "") {
                alert("Por favor, complete todos los campos.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="relative bg-gray-100">
    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover filter blur-lg">
        <source src="../assets/videos/editarPerfil.mp4" type="video/mp4">
    </video>
    <div class="relative flex min-h-screen z-10">

        <?php include "../components/header2.html"; ?>

        <div class="flex-1 flex flex-col z-10">

            <?php include "../components/sidebar2.php"; ?>

            <main class="flex-1 flex items-center justify-center p-4 z-10">
                <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
                    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Gracias por donar</h1>
                    <div class="flex justify-center mb-6">
                        <img src="../assets/images/qr.png" alt="QR" class="w-64 h-64 object-cover rounded-md shadow">
                    </div>
                    <form action="../negocio/crearDonacion.php" method="post" enctype="multipart/form-data" class="space-y-6" onsubmit="return validateForm()">
                        <div>
                            <label for="monto" class="block text-sm font-medium text-gray-700">Ingresar monto:</label>
                            <div class="mt-1">
                                <input type="text" id="monto" name="monto" class="block w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            </div>
                        </div>
                        <div>
                            <label for="comprobante" class="block text-sm font-medium text-gray-700">Adjuntar comprobante:</label>
                            <div class="mt-1">
                                <input type="file" id="comprobante" name="comprobante" class="block w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            </div>
                        </div>
                        <div class="flex flex-col items-center space-y-4">
                            <button type="submit" class="bg-blue-400 text-white w-full sm:w-40 p-2 rounded-md hover:bg-blue-500">Donar</button>
                            <a href="/lostpaws/presentacion/landingPage.php" class="text-center bg-teal-500 text-white w-full sm:w-40 p-2 rounded-md hover:bg-teal-600">Volver</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
</html>
