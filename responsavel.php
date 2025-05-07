<?php
  require('conexao.php');
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reponsavel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body class="">
    <?php
      include('navbar.php');
    ?>
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h2 class="h2">Ola Responsavel!!</h2>
                <h4 class="h4">Seus Alunos                
                  <a href="requisicoes.php" class="btn btn-primary float-end">Ver Requisicoes</a>
                </h4>

            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ALUNO</th>
                    <th>CURSO</th>
                    <th>ACOES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM responsavel_aluno WHERE cpf_responsavel = '".$_SESSION['cpf']."'";
                    $responsavel_alunos = mysqli_query($conexao, $sql);
                    if(mysqli_num_rows($responsavel_alunos)>0){
                      foreach($responsavel_alunos as $responsavel_aluno){
                        $sql = "SELECT * FROM aluno WHERE matricula = '".$responsavel_aluno['matricula_aluno']."'";
                        $alunos = mysqli_query($conexao, $sql);
                        if(mysqli_num_rows($alunos)>0){
                          foreach($alunos as $aluno){
                            ?>
                            <tr>
                              <td><?=$aluno['nome']?></td>
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
                                <a href="aluno.php?id=<?=$responsavel_aluno['id']?>&nome=<?=$aluno['nome']?>" class="btn btn-secondary btn-sm float-end">GERAR REQUISICAO</a>
                              </td>
                            </tr>
                            <?php
                          }
                          }
                          else{
                            echo "<tr><td colspan='2'>Nenhum aluno encontrado</td></tr>";
                          }
                        }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>