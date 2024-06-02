<?php
//Controle de sessão
include("dbconex.php");
session_start();
if (!isset($_SESSION["ID_fk_usuario"])) {
    header("Location: tela_login.php");
    exit;
}

// Checa se os campos estão vazios
if (empty($_POST['nome']) || empty($_POST['tipo']) || empty($_POST['tutorial']) || empty($_POST['ingredientes']) || empty($_POST['categoria']) || empty($_POST['descricao'])) {
    header('Location: ../postar_receita.php');
    exit();
}

// Insere uma nova receita no banco de dados
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$tutorial = $_POST['tutorial'];
$ingredientes = $_POST['ingredientes'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$notas = $_POST['notas'];
$ID_fk_usuario = $_SESSION['ID_fk_usuario'];

$sql1 = "INSERT INTO Receitas (nome, tipo, tutorial, ingredientes, categoria, descricao, notas, ID_fk_usuario) VALUES ('$nome','$tipo','$tutorial','$ingredientes','$categoria', '$descricao', '$notas', '$ID_fk_usuario')";
$salvar1 = mysqli_query($conexao, $sql1); 

// Obtém o ID auto incrementável gerado na primeira consulta
$ultimo_id = $conexao->insert_id;

// Lê o conteúdo do arquivo de imagem
$imagem_nome = $_FILES['imagem']['name'];
$imagem_tmp_nome = $_FILES['imagem']['tmp_name'];
$imagem_tamanho = $_FILES['imagem']['size'];
$imagem_tipo = $_FILES['imagem']['type'];

// Verifica se a imagem foi carregada corretamente
if (isset($imagem_nome) && !empty($imagem_nome)) {
    // Lê o conteúdo do arquivo de imagem
    $conteudo_imagem = file_get_contents($imagem_tmp_nome);
    $conteudo_imagem = mysqli_real_escape_string($conexao, $conteudo_imagem);

    // Insere a imagem no banco de dados
    $sql2 = "INSERT INTO Imagens (nome, tipo, tamanho, imagem, ID_fk_receita) VALUES ('$imagem_nome', '$imagem_tipo', '$imagem_tamanho', '$conteudo_imagem', '$ultimo_id')";
    $salvar2 = mysqli_query($conexao, $sql2);

    if (!$salvar2) {
        echo "Erro ao inserir imagem: " . mysqli_error($conexao);
        exit();
    }
}

// Redireciona o usuário para a tela explorar
header('Location: ../explorar_receitas.php');
?>