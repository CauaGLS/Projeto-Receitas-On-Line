<?php
include("dbconex.php");

// Verifica se os IDs do comentário e da receita foram passados na URL
if (!isset($_GET['id_comentario']) || empty($_GET['id_comentario']) || !isset($_GET['id_receita']) || empty($_GET['id_receita'])) {
    die('Erro: ID do comentário ou ID da receita não foram fornecidos.');
}

$id_comentario = $_GET['id_comentario'];
$id_receita = $_GET['id_receita'];

// Executa a query de exclusão do comentário
$query = "DELETE FROM Comentarios WHERE ID_comentario = '$id_comentario'";
$result = mysqli_query($conexao, $query);

if ($result) {
    // Redireciona de volta para a página da receita
    header("Location: ../visualizar_receita.php?receita=" . $id_receita);
    exit;
} else {
    die('Erro ao excluir comentário.');
}
?>
