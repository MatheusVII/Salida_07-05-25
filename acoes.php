<?php
    session_start();
    require('conexao.php');

    // Botão do arquivo de login.php
    if (isset($_POST['login'])) {
        $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
        // Remove caracteres especiais do CPF
        $cpf = str_replace(['-','.'],'',$cpf);
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
        $tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo']));

        // Verifica na tabela moderador
        $sqlModerador = "SELECT * FROM moderador WHERE cpf = '$cpf' AND senha = '$senha'";
        $resultModerador = mysqli_query($conexao, $sqlModerador);
        if (mysqli_num_rows($resultModerador) > 0) {
            $_SESSION['tipo'] = 'moderador';
            $_SESSION['cpf'] = $cpf;
            header('Location: pendentes.php'); // Redireciona para o painel do moderador
            exit();
        }

        // Verifica na tabela responsavel
        $sqlResponsavel = "SELECT * FROM responsavel WHERE cpf = '$cpf' AND senha = '$senha'";
        $resultResponsavel = mysqli_query($conexao, $sqlResponsavel);
        if (mysqli_num_rows($resultResponsavel) > 0) {
            $_SESSION['tipo'] = 'responsavel';
            $_SESSION['cpf'] = $cpf;
            header('Location: responsavel.php'); // Redireciona para o painel do responsável
            exit();
        }

        // Caso as credenciais estejam incorretas
        $_SESSION['login_erro'] = "Credenciais inválidas. Verifique seu CPF e senha.";
        header('Location: login.php'); // Redireciona para a página de login
        exit();
    }

    // Ação do moderador de confirmar uma requisição
    if (isset($_POST['confirmar_requisicao'])) {
        $id = mysqli_real_escape_string($conexao, ($_POST['id_requisicao']));
        $sql = "UPDATE requisicao SET estado = 'confirmado' WHERE id = '$id'";
        mysqli_query($conexao, $sql);
        header('Location: pendentes.php');
    }
    
    // Botão do modal da justificativa
    if (isset($_POST['enviar'])) {
        $just = mysqli_real_escape_string($conexao, ($_POST['justificativa']));
        $id = mysqli_real_escape_string($conexao, ($_POST['id_requisicao']));
        $sql = "UPDATE requisicao SET estado = 'recusado', justificativa = '$just' WHERE id = '$id'";
        mysqli_query($conexao, $sql);
        header('Location: pendentes.php');
    }
    // Acao do responsavel de gerar requisicao
    if(isset($_POST['gerar_requisicao'])){
        $data_saida = mysqli_real_escape_string($conexao, $_POST['data_saida']);
        $data_retorno = mysqli_real_escape_string($conexao, $_POST['data_retorno']);
        if(empty($data_retorno)){
            $data_retorno = null;
        }
        $id_responsavel_aluno = mysqli_real_escape_string($conexao, $_POST['id_aluno']);
        $sql = "INSERT INTO requisicao (id_responsavel_aluno, data_saida_agendada, data_retorno_agendada, estado) VALUES ('$id_responsavel_aluno', '$data_saida', '$data_retorno', 'pendente')";
        mysqli_query($conexao, $sql);
        header('Location: responsavel.php');
    }

    if(isset($_POST['cadastrar'])){
            //Cadastra o cpf do responsavel no sql
        $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
        $cpf = str_replace(['-','.'],'',$cpf);
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo']));
        $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));

        if($tipo == 'responsavel'){
            $sqlModerador = "INSERT INTO responsavel (cpf, senha, nome, telefone) VALUES ('$cpf', '$senha', '$nome', '$telefone')";
            $resultModerador = mysqli_query($conexao, $sqlModerador);
            header('Location: cadastro.php');
        }
        else if($tipo == 'moderador'){
            $sqlModerador = "INSERT INTO moderador (cpf, senha, nome, telefone) VALUES ('$cpf', '$senha', '$nome', '$telefone')";
            $resultModerador = mysqli_query($conexao, $sqlModerador);
            header('Location: cadastro.php');
        }

        else{
            $_SESSION['cadastro_erro'] = "Prencha Todos os Campos!!";
            header('Location: cadastro.php');
        }
    }
?>