<?php

require_once __DIR__ . '/../models/Kids.php';
include __DIR__ . '/../views/header.php';

$kidsModel = new Kids();
$alunos = $kidsModel->getAll();
?>

<h2>Alunos da Kids</h2>
<a href="index.php" class="btn btn-secondary">Voltar</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>Contato</th>
            <th>Graduação</th>
            <th>Data de Graduação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($alunos as $aluno): ?>
        <tr>
            <td><?php echo $aluno['id']; ?></td>
            <td><?php echo $aluno['nome']; ?></td>
            <td><?php echo $aluno['data_nascimento']; ?></td>
            <td><?php echo $aluno['cpf']; ?></td>
            <td><?php echo $aluno['contato']; ?></td>
            <td><?php echo $aluno['graduacao']; ?></td>
            <td><?php echo $aluno['data_graduacao']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../views/footer.php'; ?>
