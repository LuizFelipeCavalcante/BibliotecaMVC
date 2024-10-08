<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/Book.php';
include_once '../Model/Dao/BookDaoImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$bookDao = new BookDAOImpl();
$book = new Book();



switch ($action) {
    case 'create_book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book->setNome($_POST['nome']);
            $book->setEmail($_POST['email']);
            $book->setAutor($_POST['autor']);
            $book->setGenero($_POST['genero']);
            $book->setEstoque($_POST['estoque']);
            $book->setDataEntrada($_POST['dataentrada']);
            $book->setDataSaida($_POST['datasaida']);


            if (
                $bookDao->createbook($conta)
            ) {
                displayMessage('Registro inserido com sucesso!', '../index.php');
            } else {
                displayMessage('Erro ao inserir o registro.');
            }
        
            exit();
        }
        break;

    case 'valida_book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $books = $contaDao->validabook($email, $senha);
            if ($books == null) {
                displayMessage('Nome de usuário ou senha incorretos', '../index.php');
            } else {
                session_start();
                $_SESSION['user_id'] = $books->getId();
                $_SESSION['user_name'] = $books->getNome();
                $_SESSION['email'] = $books->getEmail();
                $_SESSION['telefone'] = $books->getTelefone();
                $_SESSION['senha'] = $books->getSenha();
                header('Location: ../index.php');
                exit();
            }
        }
        break;

    case 'update_book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book->setNome($_POST['nome']);
            $book->setEmail($_POST['email']);
            $book->setTelefone($_POST['telefone']);
            $book->setId($_SESSION['user_id']);
            $book->setSenha($_SESSION['senha']);
            $books = $contaDao->updatebook($book);
            if ($books) {
                $_SESSION['user_id'] = $books->getId();
                $_SESSION['user_name'] = $books->getNome();
                $_SESSION['email'] = $books->getEmail();
                $_SESSION['telefone'] = $books->getTelefone();
                $_SESSION['senha'] = $books->getSenha();
                $_SESSION['foto'] = $books->getFoto();

                header('Location: ../View/Usuario/Perfil.php');
                exit();
            } else {
                displayMessage('Erro ao atualizar o registro.');
            }
        }
        break;


    default:
        displayMessage('Ação não reconhecida.');
        break;
}

// Mensagem 
function displayMessage($message, $redirectUrl = null)
{
    echo '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>' . htmlspecialchars($message) . '</p>';
    if ($redirectUrl) {
        echo '<a href="' . htmlspecialchars($redirectUrl) . '">Voltar</a>';
    }
    echo '  </div>
</body>
</html>';
}