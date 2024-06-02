<?php
//Controle de sessão
include("dbconex.php");
session_start();
if (!isset($_SESSION["ID_fk_usuario"])) {
    header("Location: tela_login.php");
    exit;
}

    $id = $_GET['id'];

    // Primeiro, exclua os comentários associados à receita
    $sql_delete_comentarios = "DELETE FROM Comentarios WHERE ID_fk_receita = '$id'";
    $excluir_comentarios = mysqli_query($conexao, $sql_delete_comentarios);

    // Em seguida, exclua as imagens associadas à receita
    $sql_delete_imagem = "DELETE FROM Imagens WHERE ID_fk_receita = '$id'";
    $excluir_imagem = mysqli_query($conexao, $sql_delete_imagem);

    // Em seguida, exclua a receita
    $sql_excluir_receita = "DELETE FROM Receitas WHERE ID_receita = '$id'";
    $excluir_receita = mysqli_query($conexao, $sql_excluir_receita);

    // Verifique se as consultas foram executadas com sucesso e redireciona pra tela de explorar
    if($excluir_comentarios && $excluir_receita) {
        header('Location: ../explorar_receitas.php');
    } else {
        echo "Erro ao excluir receita ou comentários.";
    }
?>