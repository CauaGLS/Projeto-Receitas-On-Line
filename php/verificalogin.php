<?php
include("dbconex.php");

session_start();

//Checa se os campos estão vazios
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: ../tela_login.php');
    exit();
}

//Confere se o login existe no banco de dados
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senhaDigitada = $_POST['senha'];

$query = "SELECT ID_usuario, login, senha FROM Usuario WHERE login = '{$email}'";

$resultado = mysqli_query($conexao, $query);

$autenticado = false;
$row = null;

if ($resultado && mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    $senhaArmazenada = $row['senha'];

    //Tenta validar contra um hash bcrypt (fluxo normal, já migrado)
    if (password_verify($senhaDigitada, $senhaArmazenada)) {
        $autenticado = true;
    } else {
        //Fallback para contas antigas com senha em texto puro:
        //só é aceito se a senha armazenada NÃO parecer um hash válido
        $infoHash = password_get_info($senhaArmazenada);
        $pareceHash = ($infoHash['algo'] !== null) || (strpos($senhaArmazenada, '$2y$') === 0);

        if (!$pareceHash && $senhaDigitada === $senhaArmazenada) {
            $autenticado = true;

            //Migração transparente: re-salva a senha já com hash bcrypt
            $novoHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);
            $idUsuario = (int) $row['ID_usuario'];
            $updateSql = "UPDATE Usuario SET senha = '{$novoHash}' WHERE ID_usuario = {$idUsuario}";
            mysqli_query($conexao, $updateSql);
        }
    }
}

//Redireciona o usuário para a tela principal caso o login exista
if ($autenticado) {
    $_SESSION['ID_fk_usuario'] = $row['ID_usuario'];
    header('Location:../index.php');
    exit();

} else {
    $_SESSION['nao_autenticado'] = TRUE;
    header('Location: ../tela_login.php');
    exit();
}
?>
