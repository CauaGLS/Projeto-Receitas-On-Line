<!DOCTYPE html>
<?php
    //Controle de sessão
    session_start();
    if (!isset($_SESSION["ID_fk_usuario"])) {
        header("Location: tela_login.php");
        exit;
    }

    
    //Links das classes PHP
    $logout = "php/logout.php";
?>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receitas On-Line | Postar Receita</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Preloder da Página -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header COMEÇO -->
    <header class="header-section-other">
        <div class="container-fluid">
            <div class="logo">
                <a href="./index.php"><img src="img/little-logo2.png" width="290" height="85" alt=""></a>
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

    <!-- Área de Postagem COMEÇO -->
    <section class="blog-section spad">
        <div class="blog-pic">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="img/blog-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-text">
                        <div class="blog-title">
                            <h2>Compartilhe Suas Receitas Com Outros Usuários</h2>
                            <span>Preencha os Campos*</span>
                        </div>
                        <form action="php/dbregistra_receita.php" method="post" enctype="multipart/form-data" class="comment-form">
                            <div class="row">
                                <div class="col-lg-4">
                                    <select id="categoria" name="categoria">
                                        <option selected>Selecione a Categoria</option>
                                        <option value="Salgados">Salgado</option>
                                        <option value="Doces">Sobremesa</option>
                                        <option value="Driks">Drink</option>
                                        <option value="Saladas">Salada</option>
                                        <option value="Drinks Alcólicos">Drink Alcólico</option>
                                        <option value="Pratos de Entrada">Prato de Entrada</option>
                                        <option value="Petiscos">Petisco</option>
                                        <option value="Refeições Rápidas">Refeição Rápida</option>
                                        <option value="Pratos Principais">Prato Principal</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" id="nome" name="nome" placeholder="Nome da Receita">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" id="tipo" name="tipo" placeholder="Tipo de Culinária">
                                </div>
                                <div class="col-lg-12">
                                    <textarea id="descricao" name="descricao" placeholder="Descreva brevemente sua receita" style="height: 100px"></textarea>
                                </div>
                                <div class="col-lg-4">
                                    <textarea id="ingredientes" name="ingredientes" placeholder="Ingredientes"></textarea>
                                </div>
                                <div class="col-lg-8">
                                    <textarea id="tutorial" name="tutorial" placeholder="Tutorial"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" id="notas" name="notas" placeholder="Notas(Opcional)">
                                </div>
                                <div class="col-lg-12">
                                    <h3>Selecione uma imagem para enviar:</h3>
                                    <input type="file" name="imagem" id="imagem"/>
                                </div>
                            <button type="submit" name="submit">Postar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Área de Postagem FIM -->

    <!-- Footer COMEÇO -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="fs-left">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/little-logo-blog.png" alt="">
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
</body>

</html>