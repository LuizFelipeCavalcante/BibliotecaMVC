<?php
if ($_SESSION['user_id'] == null) {
    header('Location: View/Users/LoginUsuario.php');
}
else {
    $nomeUsuário = '';
$_SESSION ['user_id'] = $nomeUsuário;
echo "carlinhos maia";












};
