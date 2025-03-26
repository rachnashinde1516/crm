<?php
// controllers/login_process.php

require_once '../config/config.php';
require_once 'CommunicationController.php';

// Instantiate AuthController with the PDO instance
$CommunicationController = new CommunicationController($pdo);
$CommunicationController->createCommunication();
?>