<?php
require_once '../../config/config.php';
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../includes/sidebar.php';
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    <!-- Navbar -->

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card shadow-lg p-4">
                    <h2 class="mb-3 text-center text-primary">Create Task</h2>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="../../controllers/task_controller.php" method="POST">
                        <!-- Customer Selection -->
                        <div class="mb-3">
                            <label for="lead_id" class="form-label">Select Lead:</label>
                            <select name="lead_id" class="form-control" required>
                                <option value="">-- Select Lead --</option>
                                <?php foreach ($leads as $lead): ?>
                                    <option value="<?= $lead['id']; ?>"><?= htmlspecialchars($lead['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- label -->
                        <div class="mb-3">
                            <label for="label" class="form-label">Title:</label>
                            <textarea name="label" class="form-control" rows="1" required></textarea>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date:</label>
                            <input type="date" name="due_date" class="form-control" required></input>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include '../../includes/footer.php'; ?>

</body>
</html>
