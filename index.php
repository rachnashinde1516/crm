<?php
session_start();

// Redirect logged-in users to the dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: views/dashboard/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CRM System</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Background Styling */
        body {
            background: url('assets/images/1.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            background-attachment: fixed;
        }

        .landing-container {
            background: rgba(0, 0, 0, 0.7); /* Dark overlay for readability */
            padding: 3rem;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
        }

        .btn-custom {
            width: 150px;
            padding: 10px;
            font-size: 1.2rem;
        }

        .lead {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

    </style>
</head>
<body>

<div class="landing-container">
    <h1 class="mb-3">Welcome to CRM System</h1>
    <p class="lead">
        Our CRM system helps you manage leads, customers, and communications effortlessly.
    </p>
    <div class="mt-4">
        <a href="views/auth/login.php" class="btn btn-primary btn-custom me-2">Login</a>
        <a href="views/auth/register.php" class="btn btn-secondary btn-custom">Register</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
