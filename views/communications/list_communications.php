<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include necessary files
require_once '../../config/config.php';
require_once '../../models/Communication.php';

use App\Models\Communication;

// Initialize database connection
$pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create communication object
$commModel = new Communication($pdo);

// Fetch communications using the model method
$communications = $commModel->getAllCommunications();
?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<?php include '../../includes/sidebar.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>List of communications</h4>
                </div>
                <div class="card-body">
                    <?php if ($communications): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Message</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($communications as $communication): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($communication['name']); ?></td>
                                        <td><?php echo htmlspecialchars($communication['message']); ?></td>
                                        <td><?php echo htmlspecialchars($communication['type']); ?></td>
                                        <td><?php echo htmlspecialchars($communication['date_time']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">No communications found.</div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="log_call.php" class="btn btn-success">Add New communication</a>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
