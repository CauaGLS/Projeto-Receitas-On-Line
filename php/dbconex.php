<?php

//Informação do banco de dados
$nomeServidor = "localhost";
$usuario = "root";
$senha = "91813244";
$nomeBanco = "receitasonline";

//Cria conexão
$conexao = new mysqli($nomeServidor,$usuario,$senha,$nomeBanco);


//Checa conexão
/*if ($conexao->connect_error) {
    die("deu ruim". $conexao->connect_error);
} echo "DEU CERTOOOOOOOO";*/

