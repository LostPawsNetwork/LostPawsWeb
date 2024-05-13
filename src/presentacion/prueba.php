<?php
require_once "../config/neon.php";
$pdo = getPDOConnection();

$query = "SELECT * FROM playing_with_neon";
try {
    $stmt = $pdo->query($query);

    while ($row = $stmt->fetch()) {
        echo "ID: " .
            $row["id"] .
            " - Name: " .
            $row["name"] .
            " - Value: " .
            $row["value"] .
            "<br>";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
