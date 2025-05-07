<?php
class Database
{
    public $pdo;   
    public $stmt;  

    public function __construct($db ="flyway", $host = 'localhost:3308', $user = 'root', $pass = '')
    {
        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

   
    public function run($query, $params = null)
    {
        try {
            $this->stmt = $this->pdo->prepare($query);
            if ($params !== null) {
                $this->stmt->execute($params);
            } else {
                $this->stmt->execute();
            }
            return $this->stmt;
        } catch (PDOException $e) {
            echo "Execution error: " . $e->getMessage();
            return false;
        }
    }
}