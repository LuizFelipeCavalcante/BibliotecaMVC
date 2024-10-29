<?php
session_start();
if ($_SESSION['customer_id'] == null) {
    header('Location: View/LoginCustomer.php');
}
else {
$customerId = $_SESSION['customer_id'];

echo '<script type="text/javascript">
                        alert("Email ou senha incorretos.");
                        window.location.href="../index.php";
                      </script>';


};
