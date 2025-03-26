<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/CustomerController.php';

$customerController = new CustomerController($pdo);
$customerController->createCustomer();
?>
