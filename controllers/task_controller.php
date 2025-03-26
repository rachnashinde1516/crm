<?php
// controllers/login_process.php

require_once '../config/config.php';
require_once 'TaskController.php';

// Instantiate AuthController with the PDO instance
$TaskController = new TaskController($pdo);
$TaskController->createTask();
?>