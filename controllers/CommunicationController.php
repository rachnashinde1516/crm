<?php
require_once 'config/config.php';
require_once 'models/Communication.php';
 
class CommunicationController
{
    // View all communications
    public function viewCommunications()
    {
        $communications = Communication::getAllCommunications();
        require 'views/communications.php';
    }
 
    // Create a new communication record
    public function createCommunication()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $type = $_POST['type']; // Email, Call, Meeting, etc.
            $details = $_POST['details'];
            $date = $_POST['date'];
 
            if (Communication::createCommunication($customer_id, $type, $details, $date)) {
                $_SESSION['success'] = 'Communication recorded successfully!';
                header('Location: communications.php');
            } else {
                $_SESSION['error'] = 'Failed to record communication!';
                header('Location: create_communication.php');
            }
        } else {
            require 'views/create_communication.php';
        }
    }
}
?>
