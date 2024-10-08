<?php

require_once '../../Config/Connection.php';
require_once 'UserDao.php';
require_once '../User.php';

class UserDaoImpl implements UserDao {
    private $conn;

    public function __construct() {
        $this->conn = (new Connection())->getConnection();
    }

    public function getAllUsers() {
        try {
            $statement = $this->conn->prepare("SELECT * FROM user");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUser($id) {
        try {
            $statement = $this->conn->prepare("SELECT * FROM user WHERE id = :id");
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
            $statement->bindParam(':nome', $user->getTitulo());
            $statement->bindParam(':email', $user->getEmail());
            $statement->bindParam(':telefone', $user->getTelefone());
            $statement->bindParam(':senha', $user->getSenha());
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUser($user) {
        try {
            $statement = $this->conn->prepare("UPDATE user SET nome = :nome, email = :email, telefone = :telefone, senha = :senha, dataEntrada = :dataEntrada, datasaida = :datasaida, dataSaida = :dataSaida, dono_user = :dono_user WHERE id = :id");
            $statement->bindParam(':id', $user->getId());
            $statement->bindParam(':nome', $user->getNome());
            $statement->bindParam(':email', $user->getEmail());
            $statement->bindParam(':telefone', $user->getTelefone());
            $statement->bindParam(':senha', $user->getSenha());
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
    }
}
?>
