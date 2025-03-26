<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include necessary files
require_once '../../config/config.php';
require_once '../../models/Task.php';

use App\Models\Task;

// Initialize database connection
$pdo = new PDO("mysql:host=localhost;dbname=crm_system", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create Task object
$taskModel = new Task($pdo);

// Fetch Tasks using the model method
$stmt = $taskModel->getAllTasks();
$Tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<?php include '../../includes/sidebar.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>List of Tasks</h4>
                </div>
                <div class="card-body">
                    <?php if ($Tasks): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Lead Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Tasks as $Task): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($Task['name']); ?></td>
                                        <td><?php echo htmlspecialchars($Task['label']); ?></td>
                                        <td><?php echo htmlspecialchars($Task['description']); ?></td>
                                        <td><?php echo htmlspecialchars($Task['due_date']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">No Tasks found.</div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="create_task.php" class="btn btn-success">Add New Task</a>
                </div>
            </div>
        </div>
        </div>
</div></div>
</div>

<?php include '../../includes/footer.php'; ?>
