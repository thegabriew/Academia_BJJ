<?php
// models/Aluno.php

require_once __DIR__ . '/../config/db.php';

class Aluno {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Recupera todos os alunos
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM aluno");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Recupera um aluno pelo ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM aluno WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insere um novo aluno
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO aluno (nome, data_nascimento, cpf, contato, graduacao, data_graduacao) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['nome'],
            $data['data_nascimento'],
            $data['cpf'],
            $data['contato'],
            $data['graduacao'],
            $data['data_graduacao']
        ]);
    }

    // Atualiza os dados de um aluno
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE aluno SET nome = ?, data_nascimento = ?, cpf = ?, contato = ?, graduacao = ?, data_graduacao = ? WHERE id = ?");
        return $stmt->execute([
            $data['nome'],
            $data['data_nascimento'],
            $data['cpf'],
            $data['contato'],
            $data['graduacao'],
            $data['data_graduacao'],
            $id
        ]);
    }

    // Remove um aluno
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM aluno WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
