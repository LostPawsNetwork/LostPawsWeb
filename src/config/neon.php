<?php
    function getPDOConnection()
    {
        $host = "";
        $db = "";
        $user = "";
        $pass = "";
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