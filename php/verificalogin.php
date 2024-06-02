<?php
include("dbconex.php");


    //Checa se os campos estão vazios
    if(empty($email = $_POST['email'] || $senha = $_POST['senha'])) {
        header('Location: ../tela_login.php');
        exit();
    }

    //Confere se o login existe no banco de dados
    $email = mysqli_real_escape_string($conexao,$_POST['email']);
    $senha = mysqli_real_escape_string($conexao,$_POST['senha']);

    $query = "SELECT ID_usuario, login, senha FROM Usuario WHERE login = '{$email}' AND senha = '{$senha}'";

    $resultado = mysqli_query($conexao, $query);


    //Redireciona o usuário para a tela principal caso o login exista
    if(mysqli_num_rows($resultado) == 1) {
        session_start();

        $row = mysqli_fetch_assoc($resultado);
        $ID_fk_usuario = $row['ID_usuario'];
        $_SESSION['ID_fk_usuario'] = $ID_fk_usuario;
        header('Location:../index.php');
        exit();

    } else {
        $_SESSION['nao_autenticado']=TRUE;
        header('Location: ../tela_login.php');
        exit();
    }   
?>