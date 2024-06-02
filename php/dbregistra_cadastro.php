<?php
include("dbconex.php");

    //Checa se os campos estão vazios
    if(empty($_POST['email']) || empty($_POST['senha'])) {
        header('Location: ../tela_cadastro.php');
        exit();
    }

    //Registra um novo cadastro de Usuário no banco de dados
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $sql = "INSERT INTO Usuario (login, senha) VALUES('$email','$senha')";
    $salvar = mysqli_query($conexao,$sql);
    
    //Redireciona o usuário para a tela de login
    header('Location: ../tela_login.php');
?>