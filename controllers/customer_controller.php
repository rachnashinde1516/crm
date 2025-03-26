<?php
// controllers/login_process.php

require_once '../config/config.php';
require_once 'CustomerController.php';

// Instantiate AuthController with the PDO instance
$customerController = new CustomerController($pdo);
$customerController->createCustomer();
?>