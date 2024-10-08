<?php
interface UserDao {
    public function createUser($user);
    public function validaLogin($email, $senha);
}
?>
