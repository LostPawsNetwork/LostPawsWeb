<?php
    require_once "../../vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    function getPDOConnection()
    {
        $host = $_ENV["DB_HOST"];
        $db = $_ENV["DB_NAME"];
        $user = $_ENV["DB_USER"];
        $pass = $_ENV["DB_PASS"];
        $sslmode = "require";

        $dsn = "pgsql:host=$host;dbname=$db;sslmode=$sslmode";

        try 
        {
            $pdo = new PDO($dsn, $user, $pass);

            return $pdo;
        } 
        catch (\PDOException $e) 
        {
            echo "Error: " . $e->getMessage();

            return null;
        }
    }
?>