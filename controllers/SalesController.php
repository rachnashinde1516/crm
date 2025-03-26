<?php
require_once 'config/config.php';
require_once 'models/Sale.php';
 
class SalesController
{
    // View all sales
    public function viewSales()
    {
        $sales = Sale::getAllSales();
        require 'views/sales.php';
    }
 
    // Create a new sale
    public function createSale()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $product_id = $_POST['product_id'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
 
            if (Sale::createSale($customer_id, $product_id, $amount, $date)) {
                $_SESSION['success'] = 'Sale created successfully!';
                header('Location: sales.php');
            } else {
                $_SESSION['error'] = 'Failed to create sale!';
                header('Location: create_sale.php');
            }
        } else {
            require 'views/create_sale.php';
        }
    }
}
?>
