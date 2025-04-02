<?php
// controllers/LeadController.php

require_once '../../config/config.php';
require_once '../../models/Lead.php';

use App\Models\Lead;

class LeadController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
        if (isset($_GET['id'])) {
            $leadId = $_GET['id'];
        
            // Instantiate the Lead model and fetch lead details
            $leadModel = new Lead($pdo);
            $lead = $leadModel->getLeadById($leadId);
            alert($lead);
            // CHATGPT code update here

        }
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
                header('Location: ../views/leads/add_lead.php');
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

?>

<!-- views/leads/add_lead.php -->
<?php
session_start();
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../includes/sidebar.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">Add New Lead</div>
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    ?>
                    <form action="../../controllers/lead_controller.php" method="POST">
                        <div style='display:none'>
                            <label for="id" class="form-label">Lead Id:</label>
                            <input type="text" name="id" class="form-control" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Lead Name:</label>
                            <input type="text" name="name" class="form-control" required value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" name="phone" class="form-control" required value="<?php echo isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" class="form-select" required>
                                <option value="new" <?= isset($_GET['status']) && ($_GET['status'] == 'new') ? 'selected' : '' ?>>New</option>
                                <option value="contacted" <?= isset($_GET['status']) && ($_GET['status'] == 'contacted') ? 'selected' : '' ?>>Contacted</option>
                                <option value="converted" <?= isset($_GET['status']) && ($_GET['status'] == 'converted') ? 'selected' : '' ?>>Converted</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Lead</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
