<?php
// Include constants file
require_once 'config/constants.php';
 
// Display the site name
echo "Welcome to " . SITE_NAME;
 
// Send an email using the SMTP configuration constants
mail('recipient@example.com', 'Subject', 'Message body', 'From: ' . SMTP_USER);
?>