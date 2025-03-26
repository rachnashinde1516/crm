<!-- views/communications/list_communications.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
 
<h1>List of Communications</h1>
 
<?php
// Fetch communications from the database and display
$communications = getCommunications();  // Assuming getCommunications() fetches communications from DB
 
if ($communications) {
    foreach ($communications as $communication) {
        echo "<p>Customer: {$communication['customer_name']} | Type: {$communication['type']} | Message: {$communication['message']}</p>";
    }
} else {
    echo "<p>No communications found.</p>";
}
?>
<a href="log_call.php">Log New Communication</a>
