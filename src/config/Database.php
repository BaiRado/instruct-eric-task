<?php
class Database
{
    // database properties
    private $host = 'mysql';
    private $db_name = 'instruct-eric-task-db';
    private $username = 'root';
    private $password = 'f@stNoise77';
    private $connection;


    // Database connect
    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
        } catch (PDOException $err) {
            echo 'Database connection failed: ' . $err->getMessage();
        }

        return $this->connection;
    }
}
