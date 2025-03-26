<?php
// controllers/login_process.php

require_once '../config/config.php';
require_once 'OppController.php';

// Instantiate AuthController with the PDO instance
$OppController = new OppController($pdo);
$OppController->addOpp();
?>