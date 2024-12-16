<?php
class Database
{
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $dbname = "kahut";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=UTF8", $this->usuario, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
