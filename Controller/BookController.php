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
    case 'create_livro':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $livro->setNome($_POST['nome']);
            $livro->setEmail($_POST['email']);
            $livro->setTelefone($_POST['telefone']);
            $livro->setSenha($_POST['senha']);

            if (
                $bookDao->createlivro($conta)
            ) {
                displayMessage('Registro inserido com sucesso!', '../index.php');
            } else {
                displayMessage('Erro ao inserir o registro.');
            }
            $livros = $contaDao->validalivro($livro->getEmail(), $livro->getSenha());
            if ($livros == null) {
                displayMessage('Nome de usuário ou senha incorretos', '../index.php');
            } else {
                $_SESSION['user_id'] = $livros->getId();
                $_SESSION['user_name'] = $livros->getNome();
                $_SESSION['email'] = $livros->getEmail();
                $_SESSION['telefone'] = $livros->getTelefone();
                $_SESSION['senha'] = $livros->getSenha();
            }
            exit();
        }
        break;

    case 'valida_livro':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $livros = $contaDao->validalivro($email, $senha);
            if ($livros == null) {
                displayMessage('Nome de usuário ou senha incorretos', '../index.php');
            } else {
                session_start();
                $_SESSION['user_id'] = $livros->getId();
                $_SESSION['user_name'] = $livros->getNome();
                $_SESSION['email'] = $livros->getEmail();
                $_SESSION['telefone'] = $livros->getTelefone();
                $_SESSION['senha'] = $livros->getSenha();
                header('Location: ../index.php');
                exit();
            }
        }
        break;

    case 'update_livro':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $livro->setNome($_POST['nome']);
            $livro->setEmail($_POST['email']);
            $livro->setTelefone($_POST['telefone']);
            $livro->setId($_SESSION['user_id']);
            $livro->setSenha($_SESSION['senha']);
            $livros = $contaDao->updatelivro($livro);
            if ($livros) {
                $_SESSION['user_id'] = $livros->getId();
                $_SESSION['user_name'] = $livros->getNome();
                $_SESSION['email'] = $livros->getEmail();
                $_SESSION['telefone'] = $livros->getTelefone();
                $_SESSION['senha'] = $livros->getSenha();
                $_SESSION['foto'] = $livros->getFoto();

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