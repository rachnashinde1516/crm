<?php
session_start();

require_once '../../config/config.php';
require_once '../../models/Lead.php';
require_once '../../models/Customer.php';

use App\Models\Lead;
use App\Models\Customer;

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

    if ($lead['status'] === 'converted') {
        die("This lead has already been converted.");
    }

    // Instantiate the Customer model and add the customer
    $customerModel = new Customer($pdo);
    $result = $customerModel->addCustomer($lead['name'], $lead['email'], $lead['phone']);

    if (!$result) {
        die("Error adding customer.");
    }

    // Update lead status to 'converted'
    $updateResult = $leadModel->updateLeadStatus($leadId, 'converted');

    if (!$updateResult) {
        die("Error updating lead status.");
    }

    $_SESSION['success'] = "Lead converted to customer successfully!";
}

header("Location: list_leads.php");
exit();
?>