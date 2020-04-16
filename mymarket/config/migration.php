<?php

include_once './db.php';
try
{
  $db = new Database();
  $connection = $db->getConnection();
  $sql = file_get_contents("data/deploy_database.sql");
  $connection->exec($sql);
  echo "Database and tables created successfully!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>