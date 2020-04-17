<?php
class Database
{
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "root1234";
    private $database = "mymarket";

    public $connection;
    // get the database connection for creating mymarket database
    public function getFirstConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
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

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
