<?php

include_once './db.php';
try {
    $db = new Database();
    $connection = $db->getConnection();
    $sql = file_get_contents("data/revert_database.sql");
    $connection->exec($sql);
    echo "Database and tables deleted successfully!";
} catch (PDOException $e) {
    echo $e->getMessage();
}
