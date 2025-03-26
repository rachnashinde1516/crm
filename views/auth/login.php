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
  <title>Login - CRM System</title>
  
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
    .login-wrapper {
      display: flex;
      min-height: 100vh;
    }
    .login-image {
      flex: 1;
      background: url('../../assets/images/1.jpg') no-repeat center center;
      background-size: cover;
      /* Ensure the image takes the full height without gaps */
      min-height: 100vh;
    }
    .login-form-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background: #fff;
    }
    .login-card {
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 10px;
      /* Add a light shaded border */
      border: 1px solid #e0e0e0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      background: #ffffff;
    }
    .login-card h2 {
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    .footer-text {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    @media (max-width: 768px) {
      .login-image {
        display: none;
      }
      .login-form-container {
        flex: 1 0 100%;
      }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <!-- Left Column: Image -->
    <div class="login-image"></div>

    <!-- Right Column: Login Form -->
    <div class="login-form-container">
      <div class="login-card">
        <h2 class="text-center">Login</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger" role="alert">
            <?php 
              echo htmlspecialchars($_SESSION['error']); 
              unset($_SESSION['error']);
            ?>
          </div>
        <?php endif; ?>
        
        <form action="../../controllers/login_process.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
        
        <p class="text-center footer-text">
          Don't have an account? <a href="register.php">Register here</a>
        </p>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
