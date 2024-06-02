<?php
//Controle de sessão
include("dbconex.php");
session_start();

if (!isset($_SESSION["ID_fk_usuario"])) {
    header("Location: tela_login.php");
    exit;
}

// Redirecionar para explorar_receitas.php se o formulário não foi enviado
if (!isset($_POST['submit'])) {
    header('Location: ../explorar_receitas.php');
    exit(); 
}

$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$tutorial = $_POST['tutorial'];
$ingredientes = $_POST['ingredientes'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$notas = $_POST['notas'];
$ID_fk_usuario = $_SESSION['ID_fk_usuario'];
$id = $_POST['id_receita'];

// Verifica se um arquivo de imagem foi enviado
if (!empty($_FILES['imagem']['name'])) {
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp_nome = $_FILES['imagem']['tmp_name'];
    $imagem_tamanho = $_FILES['imagem']['size'];
    $imagem_tipo = $_FILES['imagem']['type'];

    // Lê o conteúdo do arquivo de imagem
    $conteudo_imagem = file_get_contents($imagem_tmp_nome);

    // Escapa o conteúdo para evitar SQL injection
    $conteudo_imagem = mysqli_real_escape_string($conexao, $conteudo_imagem);

    // Verifica se já existe uma imagem para essa receita
    $sql_verificar_imagem = "SELECT * FROM Imagens WHERE ID_fk_receita = '$id'";
    $resultado_verificar_imagem = mysqli_query($conexao, $sql_verificar_imagem);

    if (mysqli_num_rows($resultado_verificar_imagem) > 0) {
        // Se a imagem já existe, atualiza-a
        $sql_atualizar_imagem = "UPDATE Imagens SET 
            nome = '$imagem_nome',
            tipo = '$imagem_tipo', 
            tamanho = '$imagem_tamanho',
            imagem = '$conteudo_imagem'
            WHERE ID_fk_receita = '$id'";
        $salvar_imagem = mysqli_query($conexao, $sql_atualizar_imagem);
    } else {
        // Se não existe imagem, insere uma nova
        $sql_inserir_imagem = "INSERT INTO Imagens (ID_fk_receita, nome, tipo, tamanho, imagem) 
            VALUES ('$id', '$imagem_nome', '$imagem_tipo', '$imagem_tamanho', '$conteudo_imagem')";
        $salvar_imagem = mysqli_query($conexao, $sql_inserir_imagem);
    }
}

// Atualiza os outros detalhes da receita
$sql_atualizar_receita = "UPDATE Receitas SET 
    nome = '$nome',
    tipo = '$tipo',
    tutorial = '$tutorial',
    ingredientes = '$ingredientes',
    categoria = '$categoria',
    descricao = '$descricao',
    notas = '$notas'
    WHERE ID_receita = $id";

$salvar_receita = mysqli_query($conexao, $sql_atualizar_receita);

// Redirecionar para explorar_receitas.php após o processamento
header('Location: ../explorar_receitas.php');
exit();
?>