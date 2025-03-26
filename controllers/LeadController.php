<?php
// controllers/LeadController.php

require_once '../config/config.php';
require_once '../models/Lead.php';

use App\Models\Lead;

class LeadController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Method to handle adding a new lead
    public function addLead()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['status'])) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: ../views/leads/add_lead.php');
                exit();
            }

            $lead = new Lead($this->db);
            $lead->name = htmlspecialchars(strip_tags($_POST['name']));
            $lead->email = htmlspecialchars(strip_tags($_POST['email']));
            $lead->phone = htmlspecialchars(strip_tags($_POST['phone']));
            $lead->status = htmlspecialchars(strip_tags($_POST['status']));

            if ($lead->create()) {
                $_SESSION['success'] = 'Lead added successfully.';
                header('Location: ../views/leads/list_leads.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add lead. Please try again.';
                header('Location: ../views/leads/add_lead.php');
                exit();
            }
        } else {
            header('Location: ../views/leads/add_lead.php');
            exit();
        }
    }
}
