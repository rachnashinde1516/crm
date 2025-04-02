<?php
session_start();

require_once '../../config/config.php';
require_once '../../models/Lead.php';

use App\Models\Lead;

try {
    // Initialize PDO with error reporting and default fetch mode
    $pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $leadId = $_GET['id'];

    // Instantiate the Lead model and fetch lead details
    $leadModel = new Lead($pdo);
    $lead = $leadModel->getLeadById($leadId);

    if (!$lead) {
        die("Lead not found.");
    }

    // Update lead status to 'converted'
    $deleteResult = $leadModel->delete($leadId);

    if (!$deleteResult) {
        die("Error deleting lead.");
    }

    $_SESSION['success'] = "Lead deleted successfully!";
}

header("Location: list_leads.php");
exit();
?>