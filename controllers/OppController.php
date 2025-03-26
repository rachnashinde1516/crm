<?php
// controllers/LeadController.php

require_once '../config/config.php';
require_once '../models/opportunity.php';

use App\Models\opportunity;

class oppController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Method to handle adding a new opp
    public function addopp()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['title']) || empty($_POST['lead_id']) || empty($_POST['amount']) || empty($_POST['stage'])) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: ../views/opportunity/add_opp.php');
                exit();
            }

            $opp = new opportunity($this->db);
            $opp->title = htmlspecialchars(strip_tags($_POST['title']));
            $opp->lead_id = htmlspecialchars(strip_tags($_POST['lead_id']));
            $opp->amount = htmlspecialchars(strip_tags($_POST['amount']));
            $opp->stage = htmlspecialchars(strip_tags($_POST['stage']));

            if ($opp->create()) {
                $_SESSION['success'] = 'opp added successfully.';
                header('Location: ../views/opportunity/list_opps.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add opp. Please try again.';
                header('Location: ../views/opportunity/add_opp.php');
                exit();
            }
        } else {
            header('Location: ../views/opportunity/add_opp.php');
            exit();
        }
    }
}
