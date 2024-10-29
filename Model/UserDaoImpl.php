<?php

require_once 'Connection.php';
require_once 'UserDao.php';
require_once 'User.php';

class UserDaoImpl implements UserDao {
    private $conn;

    public function __construct() {
        $this->conn = (new Connection())->getConnection();
    }

    public function getAllUsers() {
        try {
            $statement = $this->conn->prepare("SELECT * FROM usuario");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUser($id) {
        try {
            $statement = $this->conn->prepare("SELECT * FROM usuario WHERE id = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $statement->fetchObject('User');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function createUser($user) {
        try {
            $statement = $this->conn->prepare("INSERT INTO user (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)");
    
            // Criando variáveis para armazenar os valores
            $nome = $user->getNome();
            $email = $user->getEmail();
            $telefone = $user->getTelefone();
            $senha = $user->getSenha();
    
            // Usando as variáveis para o bindParam
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':telefone', $telefone);
            $statement->bindParam(':senha', $senha);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function updateUser($user) {
        try {
            $statement = $this->conn->prepare("UPDATE user SET nome = :nome, email = :email, telefone = :telefone, senha = :senha WHERE id = :id");
            $statement->bindParam(':nome', $user->getNome());
            $statement->bindParam(':email', $user->getEmail());
            $statement->bindParam(':telefone', $user->getTelefone());
            $statement->bindParam(':senha', $user->getSenha());
            $statement->bindParam(':id', $user->getId());
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUser($id) {
        try {
            $statement = $this->conn->prepare("DELETE FROM user WHERE id = :id");
            $statement->bindParam(':id', $id);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }
    
}