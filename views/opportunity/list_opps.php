<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include necessary files
require_once '../../config/config.php';
require_once '../../models/Opportunity.php';

use App\Models\Opportunity;

// Initialize database connection
$pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create Lead object
$oppModel = new Opportunity($pdo);

// Fetch opps using the model method
$opps = $oppModel->getAllOpps();
?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<?php include '../../includes/sidebar.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>List of opportunities</h4>
                </div>
                <div class="card-body">
                    <?php if ($opps): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Lead Name</th>
                                    <th>Amount</th>
                                    <th>Stage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($opps as $opp): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($opp['title']); ?></td>
                                        <td><?php echo htmlspecialchars($opp['name']); ?></td>
                                        <td><?php echo htmlspecialchars($opp['amount']); ?></td>
                                        <td><?php echo htmlspecialchars($opp['stage']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">No opportunities found.</div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="add_opp.php" class="btn btn-success">Add New opportunity</a>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
