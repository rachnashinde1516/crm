<?php
// controllers/LeadController.php

//require_once '../../config/config.php';
//require_once '../../models/Task.php';

use App\Models\opportunity;

class TaskController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Method to handle adding a new lead
    public function newopportunity()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['status']) || empty($_POST['due_date'])) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: ../views/opportunity/opportunity.php');
                exit();
            }

            $opportunity = new opportunity($this->db);
            $opportunity->name = htmlspecialchars(strip_tags($_POST['name']));
            $opportunity->email = htmlspecialchars(strip_tags($_POST['email']));
            $opportunity->status = htmlspecialchars(strip_tags($_POST['status']));
            $opportunity->due_date = htmlspecialchars(strip_tags($_POST['due_date']));

            if ($opportunity->create()) {
                $_SESSION['success'] = 'Task added successfully.';
                header('Location: ../views/opportunity/opportunity.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add Task. Please try again.';
                header('Location: ../views/opportunity/opportunity.php');
                exit();
            }
        } else {
            header('Location: ../views/opportunity/opportunity.php');
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
                <div class="card-header bg-primary text-white"> New Opportunity</div>
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
                        <div class="mb-3">
                            <label for="name" class="form-label">Opportunity Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" class="form-select" required>
                                <option value="new">New</option>
                                <option value="contacted">Contacted</option>
                                <option value="converted">Converted</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">New Opportunity</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
