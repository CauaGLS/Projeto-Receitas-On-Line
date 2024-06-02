<?php
//Controle de sessão
include("dbconex.php");
session_start();
if (!isset($_SESSION["ID_fk_usuario"])) {
    header("Location: tela_login.php");
    exit;
}

// Verifica se os campos necessários estão preenchidos
if(empty($_POST['comentarista']) || empty($_POST['comentario']) || empty($_POST['id_receita'])) {
    header('Location: ../visualizar_receita.php');
    exit();
}

// Verifica se o usuário está logado e obtém o ID do usuário
if(isset($_SESSION['ID_fk_usuario'])) {
    $id_comentarista = $_SESSION['ID_fk_usuario'];
} else {
    // Se o usuário não estiver logado, redirecione-o para fazer login
    header('Location: ../tela_login.php');
    exit();
}

// Armazena a URL da página anterior
$pagina_anterior = $_SERVER['HTTP_REFERER'];

// Dados enviados pelo formulário
$comentarista = $_POST['comentarista'];
$comentario = $_POST['comentario'];
$id_receita = $_POST['id_receita'];

// Insere o comentário no banco de dados
$sql = "INSERT INTO Comentarios (nome, comentario, ID_fk_comentarista, ID_fk_receita) VALUES ('$comentarista', '$comentario', '$id_comentarista', '$id_receita')";
$salvar = mysqli_query($conexao, $sql);

// Redireciona o usuário de volta para a página anterior
header('Location: ' . $pagina_anterior);
?>
