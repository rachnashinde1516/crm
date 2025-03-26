<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include necessary files
require_once '../../config/config.php';
require_once '../../models/Lead.php';

use App\Models\Lead;

// Initialize database connection
$pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create Lead object
$leadModel = new Lead($pdo);

// Fetch leads using the model method
$leads = $leadModel->getAllLeads();
?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<?php include '../../includes/sidebar.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>List of Leads</h4>
                </div>
                <div class="card-body">
                    <?php if ($leads): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($leads as $lead): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($lead['name']); ?></td>
                                        <td><?php echo htmlspecialchars($lead['email']); ?></td>
                                        <td><?php echo htmlspecialchars($lead['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($lead['status']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">No leads found.</div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="add_lead.php" class="btn btn-success">Add New Lead</a>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
