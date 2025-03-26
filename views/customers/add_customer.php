<!-- views/customers/add_customer.php -->
<?php
if (isset($_SESSION['error'])) {
    echo "<p>{$_SESSION['error']}</p>";
    unset($_SESSION['error']);
}
?>
<form action="../../controllers/customer_controller.php" method="POST">
    <label for="name">Customer Name:</label>
    <input type="text" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    
    <label for="phone">Phone:</label>
    <input type="text" name="phone" required>
    
    <label for="address">Address:</label>
    <textarea name="address" required></textarea>
    
    <button type="submit">Add Customer</button>
</form>
