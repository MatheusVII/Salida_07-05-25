
<?php
require('conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Requisições</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
include('navbar.php');
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>REQUISIÇÕES PENDENTES</h4>                        
                    <?php
                    include('btnTabelas.php')
                    ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ALUNO</th>
                                <th>CURSO</th>
                                <th>RESPONSÁVEL</th>
                                <th>DATA DA SAIDA</th>
                                <th>RETORNO</th>
                                <th>MOTIVO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM requisicao WHERE estado = 'pendente'";
                                $requisicoes = mysqli_query($conexao, $sql);
                                if(mysqli_num_rows($requisicoes)>0){
                                    foreach($requisicoes as $requisicao){
                                        $id_responsavel_aluno = $requisicao['id_responsavel_aluno'];
                                        $sql = "SELECT * FROM responsavel_aluno WHERE id = '".$id_responsavel_aluno."'";
                                        $responsavel_alunos = mysqli_query($conexao, $sql);
                                    
                            ?>
                            <tr>
                                <td>
                                    <?php
                                        foreach($responsavel_alunos as $responsavel_aluno){
                                        $sql = "SELECT * FROM aluno WHERE matricula = '".$responsavel_aluno['matricula_aluno']."'";
                                        $alunos = mysqli_query($conexao, $sql);
                                        if(mysqli_num_rows($alunos)>0){
                                            foreach($alunos as $aluno){
                                                echo $aluno['nome'];
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $sql = "SELECT * FROM turma WHERE id = '".$aluno['id_turma']."'";
                                        $turmas = mysqli_query($conexao, $sql);
                                        if(mysqli_num_rows($turmas)>0){
                                            foreach($turmas as $turma){
                                                $sql = "SELECT * FROM curso WHERE id = '".$turma['id_curso']."'";
                                                $cursos = mysqli_query($conexao, $sql);
                                                if(mysqli_num_rows($cursos)>0){
                                                    foreach($cursos as $curso){
                                                        echo $curso['nome'];
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $sql = "SELECT * FROM responsavel WHERE cpf = '".$responsavel_aluno['cpf_responsavel']."'";
                                        $responsaveis = mysqli_query($conexao, $sql);
                                        if(mysqli_num_rows($responsaveis)>0){
                                            foreach($responsaveis as $responsavel){
                                                echo $responsavel['nome'];
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $data_saida = new DateTime($requisicao['data_saida_agendada']);
                                        echo $data_saida->format('d/m/Y H:i');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($requisicao['data_retorno_agendada'] != null){
                                            $data_retorno = new DateTime($requisicao['data_retorno_agendada']);
                                            echo $data_retorno->format('d/m/Y H:i');
                                        }
                                        else{
                                            echo "<p class='text-danger'>SEM RETORNO</p>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $sql = "SELECT * FROM MOTIVO WHERE id = '".$requisicao['id_motivo']."'";
                                        $motivos = mysqli_query($conexao, $sql);
                                        foreach($motivos as $motivo){
                                            echo $motivo['descricao'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <form action="acoes.php" method="post" class="d-inline">
                                        <button type="submit" name="confirmar_requisicao" class="btn btn-success btn-sm">CONFIRMAR</button>
                                        <input type="hidden" name="id_requisicao" value="<?=$requisicao['id']?>">
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">RECUSAR</button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialag-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">JUSTIFICAR</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="acoes.php" method="post">
                                                <div class="mb-3">
                                                    <label for="just" class="col-form-label">JUSTIFICATIVA</label>
                                                    <input type="text" name="justificativa" id="just" class="form-control" required>
                                                    <input type="hidden" name="id_aluno" value="<?=$usuario['id']?>">
                                                </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">VOLTAR</button>
                                                <button type="submit" class="btn btn-success" name="enviar">ENVIAR</button>
                                            </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                        }
                            }
                        }
                            else{
                                echo "<tr><td colspan='6' class='text-center'>Nenhuma requisição encontrada</td></tr>";
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
