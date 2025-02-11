<?php

require_once __DIR__ . '/../models/Aluno.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$alunoModel = new Aluno();
$alunoModel->delete($id);

header("Location: index.php");
exit;
