<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - CRM System</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <style>
    body {
      background: #f8f9fa;
    }
    /* Sidebar styling without background color */
    .sidebar {
      /* background: #e9ecef; */  /* Removed background color */
      min-height: 100vh;
      padding: 20px;
    }
    /* Footer styling */
    .footer {
      background: #f1f1f1;
      padding: 10px;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Include Navbar -->
  <?php include '../../includes/navbar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar Column -->
      <div class="col-md-3 sidebar">
        <?php include '../../includes/sidebar.php'; ?>
      </div>
      
      <!-- Main Content Column -->
      <div class="col-md-9">
        <div class="p-4">
          <h1 class="fw-bold">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
          <p class="fs-5">
            This is your dashboard where you can manage your leads, customers, and communications.
          </p>
          <!-- Additional dashboard content goes here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Include Footer -->
  <div class="footer">
    <?php include '../../includes/footer.php'; ?>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
