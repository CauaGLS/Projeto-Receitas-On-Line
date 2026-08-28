CREATE DATABASE receitasonline;


USE receitasonline;


CREATE TABLE Usuario (
ID_usuario int unsigned not null auto_increment,
login varchar(40) not null,
-- Hash bcrypt (password_hash/PASSWORD_DEFAULT) tem 60 caracteres; 255 dá folga
-- para algoritmos futuros (ex: Argon2, que pode gerar hashes mais longos).
senha varchar(255) not null,
primary key(ID_usuario)
);

-- Caso a tabela já exista em produção com senha varchar(40), rode:
-- ALTER TABLE Usuario MODIFY senha VARCHAR(255) NOT NULL;
-- Isso é OBRIGATÓRIO antes de usar password_hash(), senão o hash bcrypt
-- (60 caracteres) será truncado para 40 e nenhum login voltará a funcionar.


CREATE TABLE Receitas (
ID_receita INT UNSIGNED NOT NULL AUTO_INCREMENT,
ID_fk_usuario INT UNSIGNED NOT NULL,
nome VARCHAR(40) NOT NULL,
tipo VARCHAR(20) NOT NULL,
tutorial VARCHAR(3000) NOT NULL,
ingredientes VARCHAR(1500) NOT NULL,
categoria VARCHAR(20) NOT NULL,
descricao VARCHAR(500) NOT NULL,
notas VARCHAR(500) NULL,
PRIMARY KEY(ID_receita),
FOREIGN KEY (ID_fk_usuario) REFERENCES Usuario(ID_usuario)
);


CREATE TABLE Comentarios (
ID_comentario INT UNSIGNED NOT NULL AUTO_INCREMENT,
ID_fk_comentarista INT UNSIGNED NOT NULL,
ID_fk_receita INT UNSIGNED NOT NULL,
nome VARCHAR(40) NOT NULL,
comentario VARCHAR(2500) NOT NULL,
PRIMARY KEY(ID_comentario),
FOREIGN KEY (ID_fk_comentarista) REFERENCES Usuario(ID_usuario),
FOREIGN KEY (ID_fk_receita) REFERENCES Receitas(ID_receita)
);

CREATE TABLE Imagens (
ID_imagem INT UNSIGNED AUTO_INCREMENT,
ID_fk_receita INT UNSIGNED NOT NULL,
nome VARCHAR(255) NOT NULL,
tipo VARCHAR(50) NOT NULL,
tamanho INT NOT NULL,
imagem LONGBLOB NOT NULL,
PRIMARY KEY(ID_imagem),
FOREIGN KEY (ID_fk_receita) REFERENCES Receitas(ID_receita)
);
