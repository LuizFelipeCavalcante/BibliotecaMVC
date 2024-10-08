<?php
interface CustomerDao {
    public function getAllCustomers();
    public function getCustomer($id);
    public function createCustomer($customer);
    public function updateCustomer($customer);
    public function deleteCustomer($id);
}
?>
