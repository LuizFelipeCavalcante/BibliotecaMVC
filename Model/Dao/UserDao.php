<?php
interface UserDao {
    public function createUser($user);
    public function validateLogin($email, $senha);
    public function updateUser($conta);
    public function deleteUser($id);
}

