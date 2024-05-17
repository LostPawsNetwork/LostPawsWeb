
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6">Registro de Usuario</h2>
        <form action="../negocio/procesarRegistro.php" method="post" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" name="apellido" id="apellido" required class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="fechaNacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                <input type="text" name="celular" id="celular" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div>
                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select name="sexo" id="sexo" class="mt-1 p-2 w-full border rounded-md">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white p-2 w-full rounded-md">Registrar</button>
            </div>
        </form>
    </div>

</body>
</html>