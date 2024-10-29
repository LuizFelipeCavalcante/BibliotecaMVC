<?php

require_once '../Model/Customer.php';
require_once '../Model/CustomerDaoImpl.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$customerDao = new CustomerDaoImpl();
$customer = new Customer();



switch ($action) {
    case 'create_customer':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
        
            // Verifica se o e-mail já existe
            if ($customerDao->emailExists($email)) {
                echo '<script type="text/javascript">
                        alert("E-mail já cadastrado. Tente outro.");
                        window.location.href="../index.php";
                      </script>';
            } else {
                $customer->setNome($_POST['nome']);
                $customer->setEmail($email);
                $customer->setSenha($_POST['senha']);

                $newCustomerId = $customerDao->createCustomer($customer);

                if ($newCustomerId) {
                    // Inicia a sessão e salva o ID do usuário
                    session_start();
                    $_SESSION['customer_id'] = $newCustomerId;
                    
                    header('Location: ../Controller/BookController?action=readall_books'); 
                    exit();
                } else {
                    
                }
            }
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            $customer = $customerDao->login($email, $senha);
            if ($customer) {
                session_start();
                $_SESSION['customer_id'] = $customer->getId();
                // header('Location: '); Direcionar para onde deverá ir após logado
                exit();
            } else {
                echo '<script type="text/javascript">
                        alert("Email ou senha incorretos.");
                        window.location.href="../index.php";
                      </script>';
            }
        }
        break;


    default:
        echo 'Ação inválida.';
        break;
}

?>
