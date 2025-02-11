<?php


class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        
        $host = "localhost";
        $dbname = "jiujitsu";
        $username = "root";
        $password = "";
        
        try {
            $this->conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
}
