

<?php
session_start();
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../includes/sidebar.php';
include '../../models/Lead.php';

use App\Models\Lead;

// Initialize database connection
$pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create Lead object
$leadModel = new Lead($pdo);

// Fetch leads using the model method
$leads = $leadModel->getAllLeads();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">Add New Opportunity</div>
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
                    <form action="../../controllers/opp_controller.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Opportunity title:</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount:</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="lead_id" class="form-label">Select Lead:</label>
                            <select name="lead_id" class="form-control" required>
                                <option value="">-- Select Lead --</option>
                                <?php foreach ($leads as $lead): ?>
                                    <option value="<?= $lead['id']; ?>"><?= htmlspecialchars($lead['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stage" class="form-label">Stage:</label>
                            <select name="stage" class="form-select" required>
                                <option value="new">New</option>
                                <option value="closedwon">Closed Won</option>
                                <option value="clsoedlost">Closed Lost</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Opportunity</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
