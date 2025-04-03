use bancogenioquiz;
select * from usuario;
DESC usuario;


/*create database bancogenioquiz;
use bancogenioquiz;

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
    pontuacao INT DEFAULT 0,
    posicao INT DEFAULT 0,
    CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) 
    REFERENCES usuario(usuario_id) 
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
    correta BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (pergunta_id) REFERENCES perguntas(pergunta_id)
);

-- Inserir perguntas
INSERT INTO perguntas (pergunta_texto, categoria) VALUES
('Quanto é 5 + 3?', 'Adição'),
('Qual é o resultado de 12 - 7?', 'Subtração'),
('Quanto é 6 × 4?', 'Multiplicação'),
('Se eu dividir 20 por 4, qual será o resultado?', 'Divisão'),
('Qual é o valor de 2²?', 'Potenciação'),
('Quanto é a raiz quadrada de 81?', 'Raiz Quadrada'),
('Se João tem 3 caixas com 5 maçãs em cada, quantas maçãs ele tem no total?', 'Multiplicação'),
('Qual é o próximo número da sequência: 2, 4, 6, 8, ...?', 'Sequências Numéricas'),
('Se um triângulo tem lados de 3 cm, 4 cm e 5 cm, ele é um triângulo...', 'Geometria'),
('Se um relógio marca 2h45min e avançamos 90 minutos, que horas serão?', 'Horas e Minutos');

-- Inserir alternativas para cada pergunta
INSERT INTO alternativas (pergunta_id, alternativa_letra, alternativa_texto, correta) VALUES
(1, 'A', '6', 0),  (1, 'B', '8', 1),  (1, 'C', '10', 0),  (1, 'D', '7', 0),
(2, 'A', '3', 0),  (2, 'B', '5', 1),  (2, 'C', '7', 0),  (2, 'D', '6', 0),
(3, 'A', '20', 0), (3, 'B', '22', 0), (3, 'C', '24', 1), (3, 'D', '26', 0),
(4, 'A', '4', 0),  (4, 'B', '5', 1),  (4, 'C', '6', 0),  (4, 'D', '7', 0),
(5, 'A', '2', 0),  (5, 'B', '4', 1),  (5, 'C', '8', 0),  (5, 'D', '6', 0),
(6, 'A', '9', 1),  (6, 'B', '8', 0),  (6, 'C', '7', 0),  (6, 'D', '6', 0),
(7, 'A', '10', 0), (7, 'B', '12', 0), (7, 'C', '15', 1), (7, 'D', '20', 0),
(8, 'A', '10', 0), (8, 'B', '9', 0),  (8, 'C', '8', 1),  (8, 'D', '6', 0),
(9, 'A', 'Equilátero', 0), (9, 'B', 'Isósceles', 0), (9, 'C', 'Retângulo', 1), (9, 'D', 'Escaleno', 0),
(10, 'A', '3h15min', 1), (10, 'B', '4h00min', 0), (10, 'C', '3h30min', 0), (10, 'D', '3h45min', 0);

