
<?php
    require('conexao.php');
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisições</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?=include('navbar.php');?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>REQUISIÇÕES RECUSADAS</h4>
                        <?=include('btnTabelas.php')?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ALUNO</th>
                                    <th>TURMA</th>
                                    <th>RESPONSÁVEL</th>
                                    <th>DATA</th>
                                    <th>RETORNO</th>
                                    <th>JUSTIFICATIVA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM requisicoes WHERE status = 'recusado'";
                                    $usuarios = mysqli_query($conexao, $sql);
                                    if(mysqli_num_rows($usuarios)>0){
                                        foreach($usuarios as $usuario){

                                        
                                ?>
                                <tr>
                                    <td><?=$usuario['aluno']?></td>
                                    <td><?=$usuario['turma']?></td>
                                    <td><?=$usuario['responsavel']?></td>
                                    <td><?=$usuario['data_saida']?></td>
                                    <td>
                                        <?php
                                            if($usuario['data_retorno'] == null){
                                                echo "<span class='text-danger'>SEM RETORNO</span>";
                                            }else{
                                                echo $usuario['data_retorno'];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#justificativaModal<?=$usuario['id']?>">
                                            Ver Justificativa
                                        </button>
                                    <div class="modal fade" tabindex="-1" id="justificativaModal<?=$usuario['id']?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Justificativa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?=$usuario['justificativa']?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
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
