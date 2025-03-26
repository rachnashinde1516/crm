<?php
require_once '../config/config.php';
require_once '../models/Communication.php';

use App\Models\Communication;

class CommunicationController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    // View all communications
    public function viewCommunications()
    {
        $communications = Communication::getAllCommunications();
        require 'views/communications.php';
    }
 
    // Create a new communication record
    public function createCommunication()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['customer_id']) || empty($_POST['type']) || empty($_POST['message'])) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: ../views/communications/log_call.php');
                exit();
            }

            $Communication = new Communication($this->db);
            $Communication->customer_id = htmlspecialchars(strip_tags($_POST['customer_id']));
            $Communication->type = htmlspecialchars(strip_tags($_POST['type']));
            $Communication->message = htmlspecialchars(strip_tags($_POST['message']));
            $Communication->date_time = date("Y/m/d");

            if ($Communication->create()) {
                $_SESSION['success'] = 'Communication added successfully.';
                header('Location: ../views/Communications/list_communications.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add Communication. Please try again.';
                header('Location: ../views/communications/log_call.php');
                exit();
            }
        } else {
            header('Location: ../views/communications/log_call.php');
            exit();
        }

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $customer_id = $_POST['customer_id'];
        //     $type = $_POST['type']; // Email, Call, Meeting, etc.
        //     $details = $_POST['message'];
        //     $date = $_POST['date'];
 
        //     if (Communication::createCommunication($customer_id, $type, $details, $date)) {
        //         $_SESSION['success'] = 'Communication recorded successfully!';
        //         header('Location: communications.php');
        //     } else {
        //         $_SESSION['error'] = 'Failed to record communication!';
        //         header('Location: create_communication.php');
        //     }
        // } else {
        //     require 'views/create_communication.php';
        // }
    }
}
?>
