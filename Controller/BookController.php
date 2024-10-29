<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../Model/Book.php';
include_once '../Model/BookDaoImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$bookDao = new BookDAOImpl();
$book = new Book();

$bookController = new BookController();
class BookController{
    private BookDao $bookDAOl; // Propriedade declarada com tipo

    public function __construct()
    {
        // Injeção de dependência do DAO
        $this->bookDAOl = new BookDaoImpl();
    }

    public function listarAllBooks()
    {
        // Obtém todas as filas do banco de dados via DAO
        $allbooks = $this->bookDAOl->getAllBooks();
        $_SESSION['allbooks'] = $allbooks;

        header("Location: ../View/Books/ListarLivros.php");
        exit();
    }
}

switch ($action) {
    case 'create_book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book->setNome($_POST['title']);
            $book->setAutor($_POST['author']);
            $book->setGenero($_POST['genero']);
            $book->setEstoque($_POST['estoque']);
            $book->setDataEntrada($_POST['dataEntrada']);
            $book->setDataSaida($_POST['dataSaida']);

            if (
                $bookDao->createbook($book)
            ) {
                displayMessage('Registro inserido com sucesso!', '../index.php');
            } else {
                displayMessage('Erro ao inserir o registro.');
            }

            
        }
        break;

    case 'update_book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $book->setId($id);
            $book->setNome($_POST['nome']);
            $book->setAutor($_POST['autor']);
            $book->setGenero($_POST['genero']);
            $book->setEstoque($_POST['estoque']);
            $book->setDataEntrada($_POST['dataentrada']);
            $book->setDataSaida($_POST['datasaida']);
            $books = $bookDao->updateBook($book);
            if ($books) {
                $_SESSION['book_id'] = $book->getId();
                $_SESSION['book_name'] = $book->getNome();
                $_SESSION['book_genero'] = $book->getGenero();
                $_SESSION['book_estoque'] = $book->getEstoque();
                $_SESSION['book_dataentrada'] = $book->getDataEntrada();
                $_SESSION['book_datasaida'] = $book->getDataSaida();

                header('Location: ../index.php');
                exit();
            } else {
                displayMessage('Erro ao atualizar o registro.');
            }
        }
        break;

    case 'delete_book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = $bookDao->deleteBook($_SESSION['book_id']);
            if ($book) {
                header('Location: ../index.php');
            } else {
                displayMessage('Erro ao deletar o registro.');
            }
        }

        case 'readall_books':
            $bookController->listarAllBooks();
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