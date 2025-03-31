create database bancoGenioQuiz;
use bancoGenioQuiz;

SHOW CREATE TABLE usuario;




CREATE TABLE usuario (
    usuario_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    pontuacao INT DEFAULT 0
);

CREATE TABLE ranking (
    ranking_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    pontuacao INT,
    posicao INT,
    CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) 
    REFERENCES usuario(id_usuario) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

CREATE TABLE perguntas (
    pergunta_id INT PRIMARY KEY AUTO_INCREMENT,
    pergunta_texto TEXT NOT NULL,
    categoria VARCHAR(50)
);


CREATE TABLE alternativas (
    alternativa_id INT PRIMARY KEY AUTO_INCREMENT,
    pergunta_id INT,
    alternativa_letra CHAR(1) NOT NULL,
    alternativa_texto VARCHAR(255) NOT NULL,
    correta BOOLEAN,
    FOREIGN KEY (pergunta_id) REFERENCES perguntas(pergunta_id)
);
