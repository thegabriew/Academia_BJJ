<?php

require_once __DIR__ . '/../models/Aluno.php';

$alunoModel = new Aluno();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nome' => $_POST['nome'],
        'data_nascimento' => $_POST['data_nascimento'],
        'cpf' => $_POST['cpf'],
        'contato' => $_POST['contato'],
        'graduacao' => $_POST['graduacao'],
        'data_graduacao' => $_POST['data_graduacao']
    ];
    
    $alunoModel->create($data);
    header("Location: index.php");
    exit;
}

include __DIR__ . '/../views/header.php';
?>

<h2>Adicionar Novo Aluno</h2>

<form method="post" action="">
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" class="form-control" required>
    </div>
    <div class="form-group">
        <label>CPF:</label>
        <input type="text" name="cpf" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Contato:</label>
        <input type="text" name="contato" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Graduação:</label>
        <input type="text" name="graduacao" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Data de Graduação:</label>
        <input type="date" name="data_graduacao" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include __DIR__ . '/../views/footer.php'; ?>
