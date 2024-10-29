<?php

require_once 'Connection.php';
require_once 'BookDao.php';
require_once 'Book.php';

class BookDaoImpl implements BookDao {
    private $conn;

    public function __construct() {
        $this->conn = (new Connection())->getConnection();
    }

    public function getAllBooks() {
        try {
            $statement = $this->conn->prepare("SELECT * FROM book");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, 'Book');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getBook($id) {
        try {
            $statement = $this->conn->prepare("SELECT * FROM book WHERE id = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $statement->fetchObject('Book');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createBook($book) {
        try {
            $statement = $this->conn->prepare("INSERT INTO book (nome, autor, genero, estoque, dataEntrada, dataSaida) VALUES (:nome, :autor, :genero, :estoque, :dataEntrada, :dataSaida)");
            $statement->bindParam(':nome', $book->getTitulo());
            $statement->bindParam(':autor', $book->getAutor());
            $statement->bindParam(':genero', $book->getGenero());
            $statement->bindParam(':estoque', $book->getEstoque());
            $statement->bindParam(':dataEntrada', $book->getDataEntrada());
            $statement->bindParam(':dataSaida', $book->getDataSaida());
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateBook($book) {
        try {
            $statement = $this->conn->prepare("UPDATE book SET nome = :nome, autor = :autor, genero = :genero, estoque = :estoque, dataEntrada = :dataEntrada, datasaida = :datasaida, dataSaida = :dataSaida WHERE id = :id");
            $statement->bindParam(':id', $book->getId());
            $statement->bindParam(':nome', $book->getTitulo());
            $statement->bindParam(':autor', $book->getAutor());
            $statement->bindParam(':genero', $book->getGenero());
            $statement->bindParam(':estoque', $book->getEstoque());
            $statement->bindParam(':dataEntrada', $book->getDataEntrada());
            $statement->bindParam(':dataSaida', $book->getDataSaida());
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteBook($id) {
        try {
            $statement = $this->conn->prepare("DELETE FROM book WHERE id = :id");
            $statement->bindParam(':id', $id);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
