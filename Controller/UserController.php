<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/User.php';
include_once '../Model/UserDaoImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$userDao = new UserDAOImpl();
$user = new User();

$userController = new UserController();
class UserController{
    private UserDao $userDAOl; // Propriedade declarada com tipo

    public function __construct()
    {
        // Injeção de dependência do DAO
        $this->userDAOl = new UserDaoImpl();
    }

    public function listarAllUsers()
    {
        // Obtém todas as filas do banco de dados via DAO
        $allusers = $this->userDAOl->getAllUsers();
        $_SESSION['allusers'] = $allusers;

        header("Location: ../View/Users/ListarUsuarios.php");
        exit();
    }
}


switch ($action) {
    case 'create_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->setNome($_POST['nome']);
            $user->setEmail($_POST['email']);
            $user->setTelefone($_POST['telefone']);
            $user->setSenha($_POST['senha']);

            if (
                $userDao->createUser($user)
            ) {
                displayMessage('Registro inserido com sucesso!', '../index.php');
            } else {
                displayMessage('Erro ao inserir o registro.');
            }
            $users = $userDao->validateLogin($user->getEmail(), $user->getSenha());
            if ($users == null||$users == false) {
                displayMessage('Nome de usuário ou senha incorretos', '../index.php');
            } else {
                $_SESSION['user_id'] = $users->getId();
                $_SESSION['user_name'] = $users->getNome();
                $_SESSION['email'] = $users->getEmail();
                $_SESSION['telefone'] = $users->getTelefone();
                $_SESSION['senha'] = $users->getSenha();
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
        
    case 'update_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->setNome($_POST['nome']);
            $user->setEmail($_POST['email']);
            $user->setTelefone($_POST['telefone']);
            $user->setId($_SESSION['user_id']);
            $user->setSenha($_SESSION['senha']);
            $users = $userDao->updateUser($user);
            if ($users) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_name'] = $user->getNome();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['telefone'] = $user->getTelefone();
                $_SESSION['senha'] = $user->getSenha();

                header('Location: ../index.php');
                exit();
            } else {
                displayMessage('Erro ao atualizar o registro.');
            }
        }
        break;

    case 'delete_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $userDao->deleteUser($_SESSION['user_id']);
            if ($user) {
                header('Location: ../index.php');
            }
            else {displayMessage('Erro ao deletar o registro.');}
        }
        break;

    case 'readall_users':
        $userController->listarAllUsers();
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
        .useriner {
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
    <div class="useriner">
        <p>' . htmlspecialchars($message) . '</p>';
    if ($redirectUrl) {
        echo '<a href="' . htmlspecialchars($redirectUrl) . '">Voltar</a>';
    }
    echo '  </div>
</body>
</html>';
}