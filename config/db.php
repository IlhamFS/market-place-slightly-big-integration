<?php
class Database
{
    public $connection;
    // get the database connection for creating mymarket database
    public function getFirstConnection()
    {
        $this->connection = null;
        $conf = parse_ini_file('app.ini');

        try {
            $this->connection = new PDO("mysql:host=" . $conf["db_host"], $conf["db_user"], $conf["db_password"]);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
    // get the database connection
    public function getConnection()
    {
        $this->connection = null;
        $conf = parse_ini_file('app.ini');
        try {
            $this->connection = new PDO("mysql:host=" . $conf["db_host"] . ";dbname=mymarket", $conf["db_user"], $conf["db_password"]);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
