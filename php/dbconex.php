<?php

//Informação do banco de dados
//As credenciais são lidas de variáveis de ambiente, com fallback para
//desenvolvimento local. Defina as variáveis reais no seu ambiente (ou em
//um .env carregado pelo servidor) — veja .env.example.
$nomeServidor = getenv('DB_HOST') ?: 'localhost';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS') ?: '';
$nomeBanco = getenv('DB_NAME') ?: 'receitasonline';

//Cria conexão
$conexao = new mysqli($nomeServidor,$usuario,$senha,$nomeBanco);


//Checa conexão
/*if ($conexao->connect_error) {
    die("deu ruim". $conexao->connect_error);
} echo "DEU CERTOOOOOOOO";*/

