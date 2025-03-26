<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - CRM System</title>
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      background: #f8f9fa;
    }
    .register-wrapper {
      display: flex;
      min-height: 100vh;
    }
    /* Left side: full-height image */
    .register-image {
      flex: 1;
      background: url('../../assets/images/1.jpg') no-repeat center center;
      background-size: cover;
      min-height: 100vh;
    }
    /* Right side: form container */
    .register-form-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background: #fff;
    }
    .register-card {
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 10px;
      border: 1px solid #e0e0e0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      background: #ffffff;
    }
    .register-card h2 {
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    .footer-text {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    @media (max-width: 768px) {
      .register-image {
        display: none;
      }
      .register-form-container {
        flex: 1 0 100%;
      }
    }
  </style>
</head>
<body>
  <div class="register-wrapper">
    <!-- Left Side: Image -->
    <div class="register-image"></div>
    
    <!-- Right Side: Registration Form -->
    <div class="register-form-container">
      <div class="register-card">
        <h2 class="text-center">Register</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger" role="alert">
            <?php 
              echo htmlspecialchars($_SESSION['error']); 
              unset($_SESSION['error']);
            ?>
          </div>
        <?php endif; ?>
        
        <form action="../../controllers/register_process.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Select Role:</label>
            <select name="role" class="form-control" required>
              <option value="user">User</option>
              <option value="sales">Sales</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </form>
        
        <p class="text-center footer-text">
          Already have an account? <a href="login.php">Login here</a>
        </p>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
