<?php
// controllers/login_process.php

require_once '../config/config.php';
require_once 'AuthController.php';

// Instantiate AuthController with the PDO instance
$authController = new AuthController($pdo);
$authController->login();
?>