<?php
function getPDOConnection()
{
    $host = "ep-orange-wood-a5jxg7l5.us-east-2.aws.neon.tech";
    $db = "dblostpaws";
    $user = "dblostpaws_owner";
    $pass = "q07TgpWASfwB";
    $sslmode = "require";

    $dsn = "pgsql:host=$host;dbname=$db;sslmode=$sslmode";

    try 
    {
        $pdo = new PDO($dsn, $user, $pass);
        // Establecer el manejo de errores en PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } 
    catch (\PDOException $e) 
    {
        // Lanzar una excepción para ser manejada fuera de esta función
        throw new Exception("Error de conexión: " . $e->getMessage());
    }
}
?>