<?php
    require('conexao.php');
    session_start();
    $nome = $_GET['nome'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <?php
      include('navbar.php');
    ?>
    <form class="container mt-4" action="acoes.php" method="post">
        <h2>Nome do aluno: <?=$nome?></h2>
        <div class="mb-3">
            <label for="data_saida" class="form-label">Data de saida</label>
            <input type="datetime-local" class="form-control" id="data_saida" name="data_saida" required>
            <input type="hidden" name="id_aluno" value="<?=$_GET['id']?>">
        </div>
        <div class="mb-3">
            <label for="data_retorno" class="form-label" >Data de retorno</label>
            <input type="datetime-local" class="form-control" id="data_retorno" name="data_retorno">
        </div>
        <div class="mb-3">
          <label for="motivo" class="form-label">Motivo Da Liberacao</label>
          <input type="text" name="motivo" id="motivo" class="form-control">
        </div>
        <button type="submit" class="btn btn-success" name="gerar_requisicao">Enviar</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>