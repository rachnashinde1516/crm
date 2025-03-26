<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Customer.php';


class CustomerController {
    private $customerModel;

    public function __construct($pdo) {
        $this->customerModel = new Customer($pdo);
    }

    // Create a new customer
    public function createCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if ($this->customerModel->createCustomer($name, $email, $phone, $address)) {
                $_SESSION['success'] = 'Customer added successfully!';
                header('Location: view_customers.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add customer!';
                header('Location: create_customer.php');
                exit();
            }
        }
    }

    // Fetch all customers
    public function viewCustomers() {
        return $this->customerModel->getAllCustomers();
    }
}
?>
