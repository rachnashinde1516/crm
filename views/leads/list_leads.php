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
                <div class="card-body">
                    <?php if ($leads): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($leads as $lead): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($lead['name']); ?></td>
                                        <td><?php echo htmlspecialchars($lead['email']); ?></td>
                                        <td><?php echo htmlspecialchars($lead['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($lead['status']); ?></td>
                                        <td>
                                            <a href="convert_lead.php?id=<?= urlencode($lead['id']) ?>">
                                                <button style='border-radius: 9px; background-color: green; color: white; margin: 2px;border-width: thin;'>Convert</button>
                                            </a><br/>
                                            <a href="add_lead.php?id=<?= urlencode($lead['id']) ?>&name=<?= urlencode($lead['name']) ?>&email=<?= urlencode($lead['email']) ?>&phone=<?= urlencode($lead['phone']) ?>&status=<?= urlencode($lead['status']) ?>">
                                                <button style='border-radius: 9px; background-color: yellow; color: black; margin: 2px;border-width: thin;'>Edit</button>
                                            </a><br/>
                                            <a href="delete_lead.php?id=<?= urlencode($lead['id']) ?>">
                                                <button style='border-radius: 9px; background-color: red; color: white; margin: 2px;border-width: thin;'>Delete</button>
                                            </a><br/>
                                        </td>
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
