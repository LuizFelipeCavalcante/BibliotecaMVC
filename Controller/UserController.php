<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/User.php';
include_once '../Model/Dao/UserDaoImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$contaDao = new UserDAOImpl();
$conta = new User();



switch ($action) {
    case 'create_conta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conta->setNome($_POST['nome']);
            $conta->setEmail($_POST['email']);
            $conta->setTelefone($_POST['telefone']);
            $conta->setSenha($_POST['senha']);

            if (
                $contaDao->createUser($conta)
            ) {
                displayMessage('Registro inserido com sucesso!', '../index.php');
            } else {
                displayMessage('Erro ao inserir o registro.');
            }
            $contas = $contaDao->validateLogin($conta->getEmail(), $conta->getSenha());
            if ($contas == null||$contas == false) {
                displayMessage('Nome de usuário ou senha incorretos', '../index.php');
            } else {
                $_SESSION['user_id'] = $contas->getId();
                $_SESSION['user_name'] = $contas->getNome();
                $_SESSION['email'] = $contas->getEmail();
                $_SESSION['telefone'] = $contas->getTelefone();
                $_SESSION['senha'] = $contas->getSenha();
            }
            exit();
        }
        break;

    case 'valida_conta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $contas = $contaDao->validateLogin($email, $senha);
            if ($contas == null||$contas == false) {
                displayMessage('Nome de usuário ou senha incorretos', '../index.php');
            } else {
                
                $_SESSION['user_id'] = $contas->getId();
                $_SESSION['user_name'] = $contas->getNome();
                $_SESSION['email'] = $contas->getEmail();
                $_SESSION['telefone'] = $contas->getTelefone();
                $_SESSION['senha'] = $contas->getSenha();
                header('Location: ../index.php');
                exit();
            }
        }
        break;

    case 'update_conta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conta->setNome($_POST['nome']);
            $conta->setEmail($_POST['email']);
            $conta->setTelefone($_POST['telefone']);
            $conta->setId($_SESSION['user_id']);
            $conta->setSenha($_SESSION['senha']);
            $contas = $contaDao->updateUser($conta);
            if ($contas) {
                $_SESSION['user_id'] = $conta->getId();
                $_SESSION['user_name'] = $conta->getNome();
                $_SESSION['email'] = $conta->getEmail();
                $_SESSION['telefone'] = $conta->getTelefone();
                $_SESSION['senha'] = $conta->getSenha();

                header('Location: ../index.php');
                exit();
            } else {
                displayMessage('Erro ao atualizar o registro.');
            }
        }
        break;
        case 'delete_conta':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $conta = $contaDao->deleteUser($_SESSION['user_id']);
                if ($conta) {
                    header('Location: ../index.php');
                }
                else {displayMessage('Erro ao deletar o registro.');}
            }

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