<?php
// controllers/register_process.php

require_once '../config/config.php';
require_once 'AuthController.php';

$authController = new AuthController($pdo);
$authController->register();
?>