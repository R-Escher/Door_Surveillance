CREATE DATABASE acesso_db1
	CHARACTER SET utf8
	COLLATE utf8_unicode_ci;

use acesso_db1;

DROP TABLE IF EXISTS cadastros;
CREATE TABLE cadastros (
	id INT(6) UNSIGNED AUTO_INCREMENT,
    tagId VARCHAR(30) NOT NULL UNIQUE,
    nome VARCHAR(30) NOT NULL,
    data TIMESTAMP,
    PRIMARY KEY (id, tagId)
);

DROP TABLE IF EXISTS registros;
CREATE TABLE registros (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tagId VARCHAR(30) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    data TIMESTAMP,
    estado VARCHAR(30) DEFAULT NULL
);