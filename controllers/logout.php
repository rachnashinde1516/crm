<?php
// controllers/logout.php

// Include your configuration (which sets up $pdo) and the AuthController
require_once '../config/config.php';
require_once 'AuthController.php';

$authController = new AuthController($pdo);
$authController->logout();
