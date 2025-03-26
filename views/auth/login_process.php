<?php
// login_process.php

// Start the session to enable session variables
session_start();

// Include the database connection
require_once '../config/database.php'; // Ensure this file sets up a PDO instance in $pdo

// Check if form data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and fetch input values
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please enter both email and password.';
        header('Location: ../views/auth/login.php');
        exit;
    }

    try {
        // Prepare a query to fetch the user by email
        $stmt = $pdo->prepare("SELECT id, name, email, password, role FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Fetch the user data as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify if the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables for logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect to the dashboard or home page
            header('Location: ../views/dashboard/index.php');
            exit;
        } else {
            // Invalid credentials
            $_SESSION['error'] = 'Invalid email or password.';
            header('Location: ../views/auth/login.php');
            exit;
        }
    } catch (PDOException $e) {
        // Log error details in production instead of displaying them
        $_SESSION['error'] = 'An error occurred while processing your request. Please try again later.';
        header('Location: ../views/auth/login.php');
        exit;
    }
} else {
    // If not a POST request, redirect back to login
    header('Location: ../views/auth/login.php');
    exit;
}
?>