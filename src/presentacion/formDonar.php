<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'user') 
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
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
</head>

<body class="bg-gray-100">
    <div class='flex min-h-screen'>

        <?php include "../components/header2.html"; ?>

        <div class="flex-1 flex flex-col">

            <?php include "../components/sidebar2.php"; ?>

            <main class="flex-1 flex items-center justify-center">
                <div class="w-4/5 max-w-4xl bg-white p-8 rounded-lg shadow-lg text-center">
                    <h1 class="text-2xl font-bold mb-4">Gracias por donar</h1>
                    <div class="flex justify-center">
                        <img src="../assets/images/qr.png" alt="QR" style="width: 250px;">
                    </div>
                    <div>
                        <label>Ingresar monto:</label>
                        <div>
                            <input type="text" id="monto" name="monto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 border-gray-600 dark:placeholder-gray-400">
                        </div>
                        <label>Adjuntar comprobante:</label>
                        <div>
                            <input type="file" id="comprobante" name="comprobante" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 border-gray-600 dark:placeholder-gray-400">
                        </div>
                    </div>
                    <div class="m-5">
                        <a href="landingPage.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 m-5 px-4 rounded">
                            Volver
                        </a>
                        <a href="landingPage.php" id="donarBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Donar
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){
        $('#donarBtn').on('click', function(){
            alert('¡Gracias por tu donación!')
        })
    })
</script>