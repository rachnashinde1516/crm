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
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['phone']; ?></td>
                    <td><?php echo $customer['address']; ?></td>
                    <td>
                        <a href="create_customer.php?id=<?= urlencode($customer['id']) ?>&name=<?= urlencode($customer['name']) ?>&email=<?= urlencode($customer['email']) ?>&phone=<?= urlencode($customer['phone']) ?>&address=<?= urlencode($customer['address']) ?>">
                            <button style='border-radius: 9px; background-color: yellow; color: black; margin: 2px;border-width: thin;'>Edit</button>
                        </a><br/>
                        <a href="delete_customer.php?id=<?= urlencode($customer['id']) ?>">
                            <button style='border-radius: 9px; background-color: red; color: white; margin: 2px;border-width: thin;'>Delete</button>
                        </a><br/>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        <a href="create_customer.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add New Customer</a>
</div>
            </div>
<?php require_once '../../includes/footer.php'; ?>
