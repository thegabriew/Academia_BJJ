<?php

require_once __DIR__ . '/../models/Aluno.php';
require_once __DIR__ . '/../models/TurmaMista.php';
require_once __DIR__ . '/../models/Kids.php';

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    header("Location: index.php");
    exit;
}

$id   = $_GET['id'];
$type = $_GET['type'];

$alunoModel = new Aluno();
$aluno      = $alunoModel->getById($id);

if (!$aluno) {
    header("Location: index.php");
    exit;
}

if ($type === 'mista') {
    $turmaMista = new TurmaMista();
    if ($turmaMista->exists($id)) {
        $msg = "Aluno já está na Turma Mista.";
    } else {
        $turmaMista->add($id);
        $msg = "Aluno adicionado na Turma Mista.";
    }
} elseif ($type === 'kids') {
    $kids = new Kids();
    if ($kids->exists($id)) {
        $msg = "Aluno já está na Kids.";
    } else {
        $kids->add($id);
        $msg = "Aluno adicionado na Kids.";
    }
} else {
    $msg = "Tipo de turma inválido.";
}

header("Location: index.php?msg=" . urlencode($msg));
exit;
