<?php
    require_once "../config/neonManguito.php";

    $pdo = getPDOConnection();

    $query = "SELECT * FROM tbusuario";
    try
    {
        $stmt = $pdo->query($query);

        while ($row = $stmt->fetch()) 
        {
            echo "ID: " .
                $row["idusuario"] .
                " - Email: " .
                $row["email"] .
                " - Password: " .
                $row["password"] .
                "<br>";
        }
    } 
    catch (\PDOException $e) 
    {
        echo "Error: " . $e->getMessage();
    }
?>