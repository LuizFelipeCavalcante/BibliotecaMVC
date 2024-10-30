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
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getBook($id) {
        try {
            $sql = "SELECT * FROM book WHERE id = :id";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createBook($book) {
        try {
            $statement = $this->conn->prepare("INSERT INTO book (nome, autor, genero, estoque, dataEntrada, dataSaida) VALUES (:nome, :autor, :genero, :estoque, :dataEntrada, :dataSaida)");
            $statement->bindValue(':nome', $book->getNome());
            $statement->bindValue(':autor', $book->getAutor());
            $statement->bindValue(':genero', $book->getGenero());
            $statement->bindValue(':estoque', $book->getEstoque());
            $statement->bindValue(':dataEntrada', $book->getDataEntrada());
            $statement->bindValue(':dataSaida', $book->getDataSaida());
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateBook($book) {
        try {
            $statement = $this->conn->prepare("UPDATE book SET nome = :nome, autor = :autor, genero = :genero, estoque = :estoque, dataEntrada = :dataEntrada, dataSaida = :dataSaida WHERE id = :id");
            $statement->bindValue(':id', $book->getId());
            $statement->bindValue(':nome', $book->getNome());
            $statement->bindValue(':autor', $book->getAutor());
            $statement->bindValue(':genero', $book->getGenero());
            $statement->bindValue(':estoque', $book->getEstoque());
            $statement->bindValue(':dataEntrada', $book->getDataEntrada());
            $statement->bindValue(':dataSaida', $book->getDataSaida());
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
