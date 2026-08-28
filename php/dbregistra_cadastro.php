<?php
include("dbconex.php");

    //Checa se os campos estão vazios
    if(empty($_POST['email']) || empty($_POST['senha'])) {
        header('Location: ../tela_cadastro.php');
        exit();
    }

    //Registra um novo cadastro de Usuário no banco de dados
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    //Gera o hash seguro da senha (bcrypt) antes de salvar no banco
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuario (login, senha) VALUES('$email','$senhaHash')";
    $salvar = mysqli_query($conexao,$sql);
    
    //Redireciona o usuário para a tela de login
    header('Location: ../tela_login.php');
?>