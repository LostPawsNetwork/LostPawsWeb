<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="editarUsuario.php" method="post">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="tipoDocumento">Tipo de Documento:</label>
        <input type="text" id="tipoDocumento" name="tipoDocumento" required><br><br>

        <label for="numeroDocumento">Número de Documento:</label>
        <input type="text" id="numeroDocumento" name="numeroDocumento" required><br><br>

        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" required><br><br>

        <input type="submit" value="Editar Usuario">
    </form>
</body>
</html>
