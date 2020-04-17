<?php

include_once './db.php';

function deployDatabase($db) {
  $connection = $db->getFirstConnection();
  $sql = file_get_contents("data/deploy_database.sql");
  $connection->exec($sql);
}

function deployTable($db) {
  $connection = $db->getConnection();
  $sql = file_get_contents("data/deploy_Table.sql");
  $connection->exec($sql);
}

try
{
  $db = new Database();

  deployDatabase($db);
  deployTable($db);

  $sql = file_get_contents("data/deploy_table.sql");

  echo "Database and tables created successfully!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>