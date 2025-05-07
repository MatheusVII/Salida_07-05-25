<?php
require('conexao.php');
session_start();
?>
<?php

?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container{
            max-width:400px;
            padding:1rem;
            margin-top:12rem;
        }
    </style>
  </head>
  <body class=" h-100">
    <?php
    include('navbar.php');
    ?>
    <main class="d-flex align-itens-center mx-auto form-container bg-light border border-tertiary rounded-3 shadow-sm">
        <form action="acoes.php" method="post">
            <h1 class="d-flex h3 justify-center mb-3 fw-normal">Login</h1>

            <!-- Exibe mensagem de erro -->
            <?php if (isset($_SESSION['login_erro'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['login_erro']; ?>
                </div>
                <?php unset($_SESSION['login_erro']); // Remove a mensagem após exibi-la ?>
            <?php endif; ?>

            
            <div class="form-floating mb-3">
                <input name="cpf" type="text" class="form-control" id="floatingInput" placeholder="Cpf" maxlength="14" onkeyup="this.value = formatarCPF(this.value)">
                <label for="floatingInput">Cpf</label>
            </div>
            <div class="form-floating">
                <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha">
                <label for="senha">Senha</label>
            <div class="form-check form-check-inline">              
                <input type="checkbox" class="form-check-input mt-2 ms-" name="mostrar_senha" id="mostrar_senha" onclick="mostrarSenha()">
                <p for="mostrar_senha" class="mt-1">Mostrar Senha</p>
            </div>
                
            </div>
            <div class="form-check form-check-inline text-start my-3 ms-2">
                <label for="tipo" class="form-check-label" required>Responsavel</label>
                <input name="tipo"type="radio" class="form-check-input" id="tipo" value="responsavel">
            </div>
            <div class="form-check form-check-inline text-start my-3">
                <label for="tipo" class="form-check-label">Moderador</label>
                <input name="tipo" type="radio" class="form-check-input" id="tipo" value="moderador">
            </div>
          <div class="form-check form-check-inline text-start my-3">
                <label for="tipo" class="form-check-label">Portaria</label>
                <input name="tipo" type="radio" class="form-check-input" id="tipo" value="portaria">
            </div>
            <button type="submit" class="btn btn-success w-50 py-2" name="login">ENTRAR</button>
        </form>
    </main>
    <script>
        function formatarCPF(cpf){
            cpf = cpf.replace(/\D/g,'');
            cpf = cpf.replace(/(\d{3})(\d)/,'$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/,'$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/,'$1-$2');

            return cpf;

        }

        function mostrarSenha(){
            var inputPass = document.getElementById('senha');
            var btnMostrar = document.getElementById('mostrar_senha');

            if(inputPass.type === 'password'){
                inputPass.setAttribute('type','text');
            }

            else{
                inputPass.setAttribute('type','password');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
