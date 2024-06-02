<?php
    //Controle de sessão
    include("php/dbconex.php");
    session_start();
    if (!isset($_SESSION["ID_fk_usuario"])) {
        header("Location: tela_login.php");
        exit;
    }    


    //Verifica se possui categoria categoria
    if(isset($_GET['selectCat']) && $_GET['selectCat'] != null) {
        $auxGetCat = $_GET['selectCat'];
    } else {
        $auxGetCat = null;
    }

    
    //Busca receitas com base na categoria caso haja uma
    if($auxGetCat < 1){
        $query = "SELECT * FROM Receitas";
        $result = mysqli_query($conexao, $query);
    }else{
        $query = "SELECT * FROM Receitas WHERE categoria = '$auxGetCat'";
        $result = mysqli_query($conexao, $query);
    }
    

    //Busca categorias das receitas
    $nPost = mysqli_num_rows($result);

    $queryCategoria = "SELECT categoria FROM Receitas";
    $resultCategoria = mysqli_query($conexao, $queryCategoria);
    $nCategoria = mysqli_num_rows($resultCategoria);



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
    <title>Receitas On-Line | Explorar</title>

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

    <!-- Barra de Filtro COMEÇO -->
    <div class="hero-search set-bg" data-setbg="img/search-bg.jpg">
        <div class="container">
            <div class="filter-table text-center">
                <form method="get" action="explorar_receitas.php" class="filter-search">
                            <select id="category" name="selectCat">
                                <?php 
                                    if($nCategoria < 1) {
                                        echo "Não tem Categoria";
                                    } else {
                                        while($row1 = mysqli_fetch_array($resultCategoria)){
                                            $auxCat = $row1['categoria']; ?>
                                    <option value="<?php echo $auxCat;?>"><?php echo $auxCat;?></option>
                                <?php } }?>
                            </select>
                    <button type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Barra de Filtro FIM -->

    <!-- Catálogo de Receitas COMEÇO -->
    <section class="recipe-section spad">
    <div class="container">
    <div class="row justify-content-start">
        <?php 
        if($nPost < 1) {
            echo "Não tem Post";
        } else {
            while($row = mysqli_fetch_array($result)){
                $id = $row['ID_receita'];
                $nome = $row['nome'];
                $tipo = $row['tipo'];
                $tutorial = $row['tutorial'];
                $ingredientes = $row['ingredientes'];
                $categoria = $row['categoria'];
                $descricao = $row['descricao'];
                
                $url = "visualizar_receita.php?receita=".urlencode($id);


                //Busca as imagens
                $query4 = "SELECT imagem, tipo FROM Imagens WHERE ID_fk_receita = $id";
                $result4 = mysqli_query($conexao, $query4);

                    // Recupera os dados da imagem do resultado da busca
                    $imagem_dados = mysqli_fetch_assoc($result4);
                    $tipo_imagem = $imagem_dados['tipo'];
                    $conteudo_imagem = $imagem_dados['imagem'];
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="recipe-item">
                <a href="<?php echo $url;?>">
                    <?php  { ?>
                        <img src="data:<?php echo $tipo_imagem; ?>;base64,<?php echo base64_encode($conteudo_imagem); ?>" alt="Imagem da Receita" style="width: 290px; height: 282px;">
                    <?php } ?>                
                </a>
                <div class="ri-text">
                    <div class="cat-name"><?php echo $categoria;?></div>
                    <a href="<?php echo $url;?>">
                        <h4><?php echo $nome;?></h4>
                    </a>
                    <p><?php echo substr($descricao, 0, 105); ?>...</p>
                </div>
            </div>
        </div>
        <?php }}?>
    </div>
    <div class="row justify-content-start">
        <div class="col-lg-12">
            <div class="recipe-pagination">
                <a href="#" class="active">01</a>
                <a href="#">02</a>
                <a href="#">03</a>
                <a href="#">04</a>
                <a href="#">Next</a>
            </div>
        </div>
    </div>
</div>
    </section>
    <!-- Catálogo de Receitas FIM -->

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
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i>
                        by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
