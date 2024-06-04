<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
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
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-4/5 max-w-4xl bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Gracias por donar</h1>
        <div class="flex justify-center">
            <img src="../assets/imagenes/qr.png" alt="QR" class="w-1/2">
        </div>
        <div class="pl-3 pr-2 text-center">
            <fieldset>
                <form action="" method="post" target="_self">
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
                    <a href="landingPage.php"><button class="mt-5 ml-5 px-4 py-2 bg-blue-600 text-white rounded-md">Volver</button></a>
                    <button class="outline outline-offset-2 outline-black-100 mt-4 bg-blue-600 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded" type="submit">Donar</button>   
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>