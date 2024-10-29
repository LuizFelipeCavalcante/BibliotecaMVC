<?php
interface UserDao {
    public function getAllUsers();
    public function getUser($id);
    public function createUser($user);
    public function updateUser($user);
    public function deleteUser($id);

}

