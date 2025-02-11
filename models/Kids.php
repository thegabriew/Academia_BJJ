<?php

require_once __DIR__ . '/../config/db.php';

class Kids {
    private $conn;
    
    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function exists($aluno_id) {
        $stmt = $this->conn->prepare("SELECT * FROM kids WHERE aluno_id = ?");
        $stmt->execute([$aluno_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
    
    
    public function add($aluno_id) {
        if (!$this->exists($aluno_id)) {
            $stmt = $this->conn->prepare("INSERT INTO kids (aluno_id) VALUES (?)");
            return $stmt->execute([$aluno_id]);
        }
        return false;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("
            SELECT a.* FROM kids k 
            JOIN aluno a ON k.aluno_id = a.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
