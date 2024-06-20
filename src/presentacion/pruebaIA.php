<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación de Razas de Perros</title>
</head>
<body>
    <h1>Clasificación de Razas de Perros</h1>
    <form action="uploadIA.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <input type="submit" value="Clasificar">
    </form>
</body>
</html>
