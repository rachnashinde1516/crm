
<!-- views/customers/list_customers.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
 
<h1>List of Customers</h1>
 
<?php
// Fetch customers from the database and display
$customers = getCustomers();  // Assuming getCustomers() fetches customers from DB
 
if ($customers) {
    foreach ($customers as $customer) {
        echo "<p>Name: {$customer['name']} | Email: {$customer['email']}</p>";
    }
} else {
    echo "<p>No customers found.</p>";
}
?>
<a href="add_customer.php">Add New Customer</a>
