<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/CustomerController.php';
require_once '../../includes/header.php';
require_once '../../includes/navbar.php';
require_once '../../includes/sidebar.php';

$customerController = new CustomerController($pdo);
$customers = $customerController->viewCustomers();
?>

<div class="container mt-4">
    <h2 class="mb-3">Customer List</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td><?php echo $customer['address']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        <a href="create_customer.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add New Customer</a>
</div>
            </div>
<?php require_once '../../includes/footer.php'; ?>
