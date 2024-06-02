<?php
include("dbconex.php");

// Verifica se os IDs do comentário e da receita foram passados na URL
if (!isset($_POST['id_comentario']) || empty($_POST['id_comentario']) || !isset($_POST['id_receita']) || empty($_POST['id_receita'])) {
    die('Erro: ID do comentário ou ID da receita não foram fornecidos.');
}

$id_comentario = $_POST['id_comentario'];
$id_receita = $_POST['id_receita'];
$novo_comentario = $_POST['novo_comentario'];

// Executa a query de atualização do comentário
$query = "UPDATE Comentarios SET comentario = '$novo_comentario' WHERE ID_comentario = '$id_comentario'";
$result = mysqli_query($conexao, $query);

if ($result) {
    // Redireciona de volta para a página da receita
    header("Location: ../visualizar_receita.php?receita=" . $id_receita);
    exit;
} else {
    die('Erro ao atualizar comentário.');
}
?>
