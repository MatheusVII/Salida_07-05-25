<?php
require('conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>REQUISIÇÕES CONFIRMADAS - PORTARIA</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ALUNO</th>
                                <th>TURMA</th>
                                <th>DATA DE SAÍDA</th>
                                <th>DATA DE RETORNO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM requisicao WHERE estado = 'confirmado'";
                            $requisicoes = mysqli_query($conexao, $sql);
                            if (mysqli_num_rows($requisicoes) > 0) {
                                foreach ($requisicoes as $requisicao) {
                                    $id_responsavel_aluno = $requisicao['id_responsavel_aluno'];
                                    $sql = "SELECT * FROM responsavel_aluno WHERE id = '$id_responsavel_aluno'";
                                    $responsavel_alunos = mysqli_query($conexao, $sql);
                                    foreach ($responsavel_alunos as $responsavel_aluno) {
                                        $sql = "SELECT * FROM aluno WHERE matricula = '".$responsavel_aluno['matricula_aluno']."'";
                                        $alunos = mysqli_query($conexao, $sql);
                                        foreach ($alunos as $aluno) {
                                            $sql = "SELECT id_curso FROM turma WHERE id = '".$aluno['id_turma']."'"; 
                                            $turmas = mysqli_query($conexao, $sql);
                                            foreach ($turmas as $turma) {
                                                $sql = "SELECT nome FROM curso WHERE id = '".$turma['id_curso']."'"; 
                                                $cursos = mysqli_query($conexao, $sql);
                                                foreach ($cursos as $curso) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $aluno['nome'] ?></td>
                                                        <td><?= $curso['nome'] ?></td>
                                                        <td>
                                                            <?= $requisicao['data_saida'] ? $requisicao['data_saida'] : "<span class='text-danger'>PENDENTE</span>" ?>
                                                        </td>
                                                        <td>
                                                            <?= $requisicao['data_retorno'] ? $requisicao['data_retorno'] : "<span class='text-danger'>PENDENTE</span>" ?>
                                                        </td>
                                                        <td>
                                                            <form action="acoes.php" method="post" class="d-inline">
                                                                <input type="hidden" name="id_requisicao" value="<?= $requisicao['id'] ?>">
                                                                <button type="submit" name="registrar_saida" class="btn btn-success btn-sm" 
                                                                    <?= $requisicao['data_saida'] ? 'disabled' : '' ?>>Registrar Saída</button>
                                                            </form>
                                                            <form action="acoes.php" method="post" class="d-inline">
                                                                <input type="hidden" name="id_requisicao" value="<?= $requisicao['id'] ?>">
                                                                <button type="submit" name="registrar_retorno" class="btn btn-primary btn-sm" 
                                                                    <?= $requisicao['data_retorno'] ? 'disabled' : '' ?>
                                                                    onclick="return confirm('Tem certeza que deseja registrar o retorno?')">Registrar Retorno</button>
                                                            </form>
                                                            <form action="acoes.php" method="post" class="d-inline">
                                                                <input type="hidden" name="id_requisicao" value="<?= $requisicao['id'] ?>">
                                                                <button type="submit" name="nao_vai_retornar" class="btn btn-danger btn-sm" 
                                                                    <?= $requisicao['estado'] === 'concluido' ? 'disabled' : '' ?>
                                                                    onclick="return confirm('Tem certeza que deseja marcar como Não Vai Retornar?')">Não Vai Retornar</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Nenhuma requisição confirmada encontrada</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



