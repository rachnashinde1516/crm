<?php
require_once '../../config/config.php';
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../includes/sidebar.php';
require_once '../../controllers/CustomerController.php';

// Fetch customers for the dropdown
$customerController = new CustomerController($pdo);
$customers = $customerController->viewCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Communication</title>
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
                    <h2 class="mb-3 text-center text-primary">Log Communication</h2>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="../../controllers/communication_controller.php" method="POST">
                        <!-- Customer Selection -->
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Select Customer:</label>
                            <select name="customer_id" class="form-control" required>
                                <option value="">-- Select Customer --</option>
                                <?php foreach ($customers as $customer): ?>
                                    <option value="<?= $customer['id']; ?>"><?= htmlspecialchars($customer['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message:</label>
                            <textarea name="message" class="form-control" rows="4" required></textarea>
                        </div>

                        <!-- Communication Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Communication Type:</label>
                            <select name="type" class="form-control" required>
                                <option value="call">Call</option>
                                <option value="email">Email</option>
                                <option value="message">Message</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Log Communication</button>
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
