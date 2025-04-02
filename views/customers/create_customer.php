<?php
require_once '../../config/config.php';
include '../../includes/header.php';
include '../../includes/navbar.php';
include '../../includes/sidebar.php';

// Role Check (Only Admin & Sales Can Access)
// if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'sales') {
//     $_SESSION['error'] = "Access Denied!";
//     header("Location: ../index.php");
//     exit();
// }
?>

<div class="container mt-4">
    <h2 class="mb-3">Add New Customer</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="process_customer.php" method="POST" class="card p-4 shadow-sm">

        <div style='display:none'>
            <label for="id" class="form-label">Customer Id:</label>
            <input type="text" name="id" class="form-control" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" class="form-control" required value="<?php echo isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Address:</label>
            <textarea name="address" class="form-control" required><?php echo isset($_GET['address']) ? htmlspecialchars($_GET['address']) : ''; ?>
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add Customer</button>
    </form>

    <br>
    <a href="view_customers.php" class="btn btn-secondary"><i class="fas fa-eye"></i> View Customers</a>
</div>
    </div>

<?php require_once '../../includes/footer.php'; ?>
