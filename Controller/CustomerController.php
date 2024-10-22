<?php

require_once '../Model/Customer.php';
require_once '../Model/Dao/CustomerDaoImpl.php';

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

            
                if ($customerDao->createCustomer($customer)) {
                    // Inicia a sessão e salva o ID do usuário
                    session_start();
                    $_SESSION['id'] = $customerDao->getCustomer($customer->getId())->getId();
                    
                    // Redireciona para a página nav.php
                    header('Location: ../index.php');
                    exit();
                } else {
                    echo 'Erro ao criar o usuário.';
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
                $_SESSION['customer_name'] = $customer->getNome();
                $_SESSION['customer_email'] = $customer->getEmail();
                header('Location: ../inde.php');
                exit();
            } else {
                echo 'E-mail ou senha incorretos<br><a href="../index.php">Voltar à página de login</a>';
            }
        }
        break;

    default:
        echo 'Ação inválida.';
        break;
}

?>
