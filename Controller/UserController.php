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

    public function listarUser($idUser)
    {
        // Obtém todas as filas do banco de dados via DAO
        $oneuser = $this->userDAOl->getUser($idUser);
        $_SESSION['oneuser'] = $oneuser;

        header("Location: ../View/Users/updateUsuarios.php");
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
                    displayMessage('Registro inserido com sucesso!', '../Controller/UserController?action=readall_users');
                } else {
                    displayMessage('Erro ao inserir o registro.');
                }
    
            
        }
        break;    

        
    case 'update_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->setNome($_POST['nome']);
            $user->setEmail($_POST['email']);
            $user->setTelefone($_POST['telefone']);
            $user->setId($id);
            $user->setSenha($_POST['senha']);
            $users = $userDao->updateUser($user);
            if ($users) {
                // $_SESSION['user_id'] = $user->getId();
                // $_SESSION['user_name'] = $user->getNome();
                // $_SESSION['email'] = $user->getEmail();
                // $_SESSION['telefone'] = $user->getTelefone();
                // $_SESSION['senha'] = $user->getSenha();

                header('Location: ../Controller/UserController?action=readall_users');
                exit();
            } else {
                displayMessage('Erro ao atualizar o registro.');
            }
        }
        break;

    case 'delete_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $userDao->deleteUser($id);
            if ($user) {
                header('Location: ../Controller/UserController?action=readall_users');
            } else {
                displayMessage('Erro ao deletar o registro.');
            }
        }
        break;

    case 'readall_users':
        $userController->listarAllUsers();
        break;

     case 'read_user':
         $userController->listarUser($id);
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