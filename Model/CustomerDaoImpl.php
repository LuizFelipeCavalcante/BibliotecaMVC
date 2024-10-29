<?php

require_once 'Connection.php';
require_once 'CustomerDao.php';
require_once 'Customer.php';

class CustomerDaoImpl implements CustomerDao {
    private $conn;

    public function __construct() {
        $this->conn = (new Connection())->getConnection();
    }

    
    public function getCustomer($id) {
        try {
            $statement = $this->conn->prepare("SELECT * FROM customer WHERE id = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $statement->fetchObject('Customer');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createCustomer($user) {
        try {
            $statement = $this->conn->prepare("INSERT INTO customer (nome, email, senha) VALUES (:nome, :email, :senha)");
    
            // Criando variáveis para armazenar os valores
            $nome = $user->getNome();
            $email = $user->getEmail();
            $senha = $user->getSenha();
    
            // Usando as variáveis para o bindParam
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':senha', $senha);

            $statement->execute();

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function login($email, $senha) {
        try {
            $statement = $this->conn->prepare("SELECT * FROM customer WHERE email = :email AND senha = :senha");
            $statement->bindParam(':email', $email);
            $statement->bindParam(':senha', $senha);
            $statement->execute();
            return $statement->fetchObject('Customer');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function emailExists($email) {
        try {
            $statement = $this->conn->prepare("SELECT COUNT(*) FROM customer WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();
            
            // Retorna true se o e-mail já existe, false caso contrário
            return $statement->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}

?>
