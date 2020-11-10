-- Criar banco 'biblioteca'
CREATE DATABASE IF NOT EXISTS biblioteca;


-- Estrutura da tabela 'clientes'
CREATE TABLE IF NOT EXISTS clientes (
    matricula int(11) NOT NULL AUTO_INCREMENT,
    nome text NOT NULL,
    telefone int(11) NOT NULL,
    PRIMARY KEY (matricula)
);


-- Estrutura da tabela 'livros'
CREATE TABLE IF NOT EXISTS livros (
    id int AUTO_INCREMENT NOT NULL,
    isbn int(13) NOT NULL,
    titulo text NOT NULL,
    autor text NOT NULL,
    editora text NOT NULL,
    ano int(4),
    PRIMARY KEY (iD)
)


