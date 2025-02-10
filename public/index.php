<?php
// public/index.php

require_once __DIR__ . '/../models/Aluno.php';
require_once __DIR__ . '/../models/TurmaMista.php';
require_once __DIR__ . '/../models/Kids.php';

$alunoModel      = new Aluno();
$alunos          = $alunoModel->getAll();
$turmaMistaModel = new TurmaMista();
$kidsModel       = new Kids();

include __DIR__ . '/../views/header.php';

// Exibe mensagem, se houver, passada via GET
if (isset($_GET['msg'])) {
    echo '<div class="alert alert-info">' . htmlspecialchars($_GET['msg']) . '</div>';
}
?>

<div class="mb-3">
    <a href="create.php" class="btn btn-primary">Adicionar Novo Aluno</a>
</div>

<!-- Botões para visualizar cada turma -->
<div class="mb-3">
    <a href="turma_mista_view.php" class="btn btn-secondary">Ver Turma Mista</a>
    <a href="kids_view.php" class="btn btn-secondary">Ver Kids</a>
</div>

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
            <th>Turma Kids</th>
            <th>Turma Mista</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
            <?php 
                // Calcula a idade do aluno
                $today     = new DateTime();
                $birthDate = new DateTime($aluno['data_nascimento']);
                $age       = $today->diff($birthDate)->y;
            ?>
            <tr>
                <td><?php echo $aluno['id']; ?></td>
                <td><?php echo $aluno['nome']; ?></td>
                <td><?php echo $aluno['data_nascimento']; ?></td>
                <td><?php echo $aluno['cpf']; ?></td>
                <td><?php echo $aluno['contato']; ?></td>
                <td><?php echo $aluno['graduacao']; ?></td>
                <td><?php echo $aluno['data_graduacao']; ?></td>
                <!-- Coluna para adicionar na Kids (somente se idade for menor que 16) -->
                <td>
                    <?php if ($age >= 16): ?>
                        <span class="text-danger">Não permitido (idade <?= $age ?>)</span>
                    <?php else: ?>
                        <?php if ($kidsModel->exists($aluno['id'])): ?>
                            Já na Kids
                        <?php else: ?>
                            <a href="add_turma.php?id=<?php echo $aluno['id']; ?>&type=kids" class="btn btn-sm btn-info">Adicionar na Kids</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <!-- Coluna para adicionar na Turma Mista (somente se idade for 16 ou mais) -->
                <td>
                    <?php if ($age < 16): ?>
                        <span class="text-danger">Não permitido (idade <?= $age ?>)</span>
                    <?php else: ?>
                        <?php if ($turmaMistaModel->exists($aluno['id'])): ?>
                            Já na Turma Mista
                        <?php else: ?>
                            <a href="add_turma.php?id=<?php echo $aluno['id']; ?>&type=mista" class="btn btn-sm btn-info">Adicionar na Turma Mista</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $aluno['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="delete.php?id=<?php echo $aluno['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../views/footer.php'; ?>
