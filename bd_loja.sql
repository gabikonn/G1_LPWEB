CREATE DATABASE loja;
CREATE TABLE loja.cadastro(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    produto varchar(255) NOT NULL,
    preco varchar(255) NOT NULL,
    qntd INT NOT NULL);

SELECT * FROM loja.cadastro;
