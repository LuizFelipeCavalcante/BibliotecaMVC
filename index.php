<?php
if ($_SESSION['customer_id'] == null) {
    header('Location: View/LoginCustomer.php');
}
else {
    $nomeUsuário = '';
$_SESSION ['customer_id'] = $nomeUsuário;
echo "carlinhos maia";












};
