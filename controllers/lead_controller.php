<?php
// controllers/login_process.php

require_once '../config/config.php';
require_once 'LeadController.php';

// Instantiate AuthController with the PDO instance
$leadController = new LeadController($pdo);
$leadController->addLead();
?>