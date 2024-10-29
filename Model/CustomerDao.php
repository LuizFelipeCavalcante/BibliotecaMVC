<?php
interface CustomerDao {
    public function getCustomer($id);
    public function createCustomer($customer);
    public function login($email,$senha);
    public function emailExists($email);
}
?>  
