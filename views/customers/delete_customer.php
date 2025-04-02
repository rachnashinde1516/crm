<?php
session_start();

require_once '../../config/config.php';
require_once '../../models/Customer.php';

//use App\Models\Customer;

try {
    // Initialize PDO with error reporting and default fetch mode
    $pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Instantiate the customer model and fetch customer details
    $customerModel = new Customer($pdo);
    $customer = $customerModel->getcustomerById($customerId);

    if (!$customer) {
        die("customer not found.");
    }

    // Update customer status to 'converted'
    $deleteResult = $customerModel->delete($customerId);

    if (!$deleteResult) {
        die("Error deleting customer.");
    }
    if($deleteResult === 'Cannot delete account with open communications.'){
        $_SESSION['error'] = $deleteResult;
    }else{
        $_SESSION['success'] = "customer deleted successfully!";
    }

}

header("Location: view_customers.php");
exit();
?>