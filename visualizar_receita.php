<!DOCTYPE html>

<?php
    // Controle de sessão
    include("php/dbconex.php");
    session_start();
    if (!isset($_SESSION["ID_fk_usuario"])) {
        header("Location: tela_login.php");
        exit;
    }

    // Verifica se o ID da receita foi passado na URL
    if (!isset($_GET['receita']) || empty($_GET['receita'])) {
        die('Erro: ID da receita não foi fornecido.');
    }

    // Busca os dados da receita com base no ID
    $auxId = $_GET['receita'];
    $query = "SELECT * FROM Receitas WHERE ID_receita = '$auxId'";
    $result = mysqli_query($conexao, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        die('Erro: Receita não encontrada.');
    }
    $row = mysqli_fetch_array($result);

    // Recupera os dados da receita do resultado da busca
    $nome = $row['nome'];
    $tipo = $row['tipo'];
    $tutorial = $row['tutorial'];
    $ingredientes = $row['ingredientes'];
    $categoria = $row['categoria'];
    $descricao = $row['descricao'];
    $notas = $row['notas'];
    $id = $row['ID_receita'];  // Correção: Usar ID_receita em vez de ID_fk_receita
    $ID_fk_usuario = $_SESSION['ID_fk_usuario'];

    // Busca os comentários
    $query3 = "SELECT * FROM Comentarios WHERE ID_fk_receita = '$id'";
    $result3 = mysqli_query($conexao, $query3);

    // Busca as imagens
    $query4 = "SELECT imagem, tipo FROM Imagens WHERE ID_fk_receita = $id";
    $result4 = mysqli_query($conexao, $query4);
    if ($result4 && mysqli_num_rows($result4) > 0) {
        $imagem_dados = mysqli_fetch_assoc($result4);
        $tipo_imagem = $imagem_dados['tipo'];
        $conteudo_imagem = $imagem_dados['imagem'];
    } else {
        // Se nenhuma imagem for encontrada, use um placeholder ou deixe a variável vazia
        $tipo_imagem = '';
        $conteudo_imagem = '';
    }

    // Links das classes PHP
    $exUrl = "php/dbexcluir_receita.php?id=" . $id;
    $atUrl = "alterar_receita.php?id=" . $id;
    $logout = "php/logout.php";
?>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receitas On-Line | Receita</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
    <!-- Preloder da Página -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header COMEÇO-->
    <header class="header-section-other">
        <div class="container-fluid">
            <div class="logo">
                <a href="./index.php"><img src="img/little-logo-blog.png" width="290" height="85" alt=""></a>
            </div>
            <div class="nav-menu">
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="index.php">Home</a></li> 
                        <li><a href="explorar_receitas.php">Receitas</a></li>
                        <li><a href="postar_receita.php">Postar</a></li>
                        <li><a href="<?php echo $logout; ?>">Logout</a></li>
                    </ul>
                </nav>
                <div class="nav-right search-switch">
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header FIM -->

    <!-- Banner COMEÇO -->
    <div class="hero-search set-bg" data-setbg="img/search-bg.jpg"></div>
    <!-- Banner FIM -->

    <!-- Seção Informações da Receita COMEÇO -->
    <section class="single-page-recipe spad">
        <div class="recipe-top">
            <div class="container-fluid">
                <div class="recipe-title">
                    <h2><?php echo $nome;?></h2>
                    <ul class="tags">
                        <li><?php echo $tipo;?></li>
                        <li><?php echo $categoria;?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="ingredients-item">
                        <div class="intro-item">
                            <?php if (!empty($conteudo_imagem)) : ?>
                                <img src="data:<?php echo $tipo_imagem; ?>;base64,<?php echo base64_encode($conteudo_imagem); ?>" alt="Imagem da Receita">
                            <?php else : ?>
                                <img src="img/no-image.png" alt="Imagem não disponível">
                            <?php endif; ?>
                            <h2><?php echo $nome;?></h2>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <div class="ingredient-list">
                            <div class="recipe-btn text-center">
                                <?php if($ID_fk_usuario == $row['ID_fk_usuario']): ?>
                                    <a href="<?php echo $atUrl; ?>" class="black-btn">Alterar</a>
                                <?php endif; ?>
                                <?php if($ID_fk_usuario == $row['ID_fk_usuario']): ?>
                                    <a href="<?php echo $exUrl; ?>" class="black-btn">Excluir</a>
                                <?php endif; ?>
                            </div>
                            <div class="list-item">
                                <h5>Ingredientes</h5>
                                <div class="salad-list">
                                    <h6>Para preparar <?php echo $nome; ?>:</h6>
                                </div>    
                                <div class="salad-list col-lg-12">
                                    <?php $ingredientes_formatados = "- " . str_replace("\n", "<br>- ", $ingredientes); echo $ingredientes_formatados;  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="recipe-right">
                        <div class="recipe-desc">
                            <h3>Descrição</h3>
                            <p><?php echo $descricao; ?></p>
                        </div>
                        <div class="instruction-list">
                            <h3>Instruções</h3>
                            <ul>
                                <li><?php echo $tutorial; ?></li>
                            </ul>
                        </div>
                        <div class="notes">
                            <h3>Nota</h3>
                            <div class="notes-item">
                                <span>i</span>
                                <p><?php echo $notas; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Seção Informações da Receita FIM -->

    <!-- Comentários COMEÇO -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-text">
                    <div class="blog-comment">
                        <h3>Comentários</h3>
                        <?php
                            while($row3 = mysqli_fetch_array($result3)) {
                                $comentarista = $row3['nome'];
                                $comentario = $row3['comentario'];
                                $id_comentario = $row3['ID_comentario']; // Obter o ID do comentário
                                $id_comentarista = $row3['ID_fk_comentarista']; // Obter o ID do usuário que postou o comentário
                                $exCom = "php/dbexcluir_comentario.php?id_comentario=" . $id_comentario . "&id_receita=" . $id; // Link correto para excluir comentário
                                
                                // Verifica se o usuário atual é o mesmo que postou o comentário
                                if ($_SESSION["ID_fk_usuario"] == $id_comentarista) {
                                    // Mostra os botões de atualização e exclusão
                        ?>
                                    <div class="single-comment">
                                        <ul>
                                            <li><?php echo $comentarista; ?></li>
                                        </ul>
                                        <p><?php echo $comentario; ?></p>
                                        <ul>
                                            <li><button class="black-btn update-btn" data-id="<?php echo $row3['ID_comentario']; ?>">Atualizar</button></li>
                                            <li><a href="<?php echo $exCom; ?>" class="black-btn">Excluir</a></li>
                                        </ul>
                                    </div>
                        <?php
                                } else {
                                    // Se o usuário atual não é o mesmo que postou o comentário, apenas mostra o comentário sem os botões de atualização e exclusão
                        ?>
                                    <div class="single-comment">
                                        <ul>
                                            <li><?php echo $comentarista; ?></li>
                                        </ul>
                                        <p><?php echo $comentario; ?></p>
                                    </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                        <!-- Modal de Atualização de Comentário -->
                        <div id="updateCommentModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <form action="php/dbatualizar_comentario.php" method="post" class="comment-form">
                                    <h3>Atualizar Comentário</h3>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea placeholder="Novo comentário..." name="novo_comentario"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_comentario" id="id_comentario">
                                    <input type="hidden" name="id_receita" value="<?php echo $id; ?>"> <!-- Campo oculto para o ID da receita -->
                                    <button type="submit">Atualizar</button>
                                </form>
                            </div>
                        </div>
                        <form action="php/dbpostar_comentario.php" method="post" class="comment-form">
                            <h3>Deixe seu Comentário</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Nome" name="comentarista">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Comente..." name="comentario"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id_receita" value="<?php echo $id; ?>">
                            <button type="submit">Postar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Comentários FIM -->

    <!-- Footer COMEÇO -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="fs-left">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/little-logo2.png" alt="">
                            </a>
                        </div>
                        <p>Receitas On-Line, sabor em um clique, na tela do seu dispositivo, a culinária que deslumbra e vicia!</p>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="social-links">
                        <a href="#"><i class="fa fa-instagram"></i><span>Instagram</span></a>
                        <a href="#"><i class="fa fa-pinterest"></i><span>Pinterest</span></a>
                        <a href="#"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                        <a href="#"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                        <a href="#"><i class="fa fa-youtube"></i><span>Youtube</span></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer FIM -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/modal.js"></script>
</body>

</html>
