CREATE DATABASE db_banco_digital;

USE db_banco_digital;

CREATE TABLE correntista
(
	id INT AUTO_INCREMENT,
    nome VARCHAR(150),
    data_nasc DATE,
    cpf CHAR(11),
    senha VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE conta
(
	id INT AUTO_INCREMENT,
    numero VARCHAR(150),
    tipo ENUM("Corrente", "Poupança", "Pagamento", "Salário"),
    senha VARCHAR(100),
    id_correntista INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_correntista) REFERENCES correntista(id)
);

CREATE TABLE chave_pix
(
	id INT AUTO_INCREMENT,
    tipo ENUM("CPF", "Número Celular", "E-mail", "Aleatório"),
    id_conta INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_conta) REFERENCES conta (id)
); 

CREATE TABLE transacao
(
	id INT AUTO_INCREMENT,
    valor DOUBLE,
    data_transacao DATE,
    conta_remetente VARCHAR(150),
    conta_destinatario VARCHAR(150),
    PRIMARY KEY (id)
);

CREATE TABLE conta_transacao_assoc
(
	id INT AUTO_INCREMENT,
    id_conta INT,
    id_transacao INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_conta) REFERENCES conta (id),
    FOREIGN KEY (id_transacao) REFERENCES transacao (id)
);

INSERT INTO correntista (nome, data_nasc, cpf, senha) VALUES ("hugo", "2005-10-21", "12345678910", sha1("123"));