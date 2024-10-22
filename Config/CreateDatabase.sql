create database biblioteca;

use biblioteca;

create table user (
  id INT AUTO_INCREMENT not null  PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone varchar(15) NOT NULL,
  senha VARCHAR(40) NOT NULL
);

create table customer (
  id INT AUTO_INCREMENT not null  PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(40) NOT NULL
);

create table book(
  id INT AUTO_INCREMENT not null PRIMARY KEY,
  nome VARCHAR(60) NOT NULL,
  autor VARCHAR(60) NOT NULL,
  genero VARCHAR(60) NOT NULL,
  estoque int not null,
  dataEntrada date not null,
  dataSaida date not null
);