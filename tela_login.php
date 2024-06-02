<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receitas On-Line | Login</title>

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
                <a href="#"><img src="img/little-logo2.png" width="290" height="85" alt=""></a>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header FIM -->

    <!-- Banner COMEÇO -->
    <div class="hero-search set-bg" data-setbg="img/search-bg.jpg">
        <div class="container">
            <div class="filter-table">
            </div>
        </div>
    </div>
    <!-- Banner FIM -->

    <!-- Área de Login COMEÇO -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="php/verificalogin.php" method="post" class="contact-form">
                        <h3>Login de Usuário</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="email" name="email" placeholder="e-mail">
                            </div>
                            <div class="col-lg-6">
                                <input type="password" id="senha" name="senha" placeholder="Senha">
                            </div>
                        </div>
                        <button type="submit">Entrar</button>
                    </form>
                    <a href="tela_cadastro.php">Cadastre-se</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Área de Login FIM -->

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