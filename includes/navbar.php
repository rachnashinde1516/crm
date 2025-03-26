<?php
// includes/navbar.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRM System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/views/dashboard/index.php">CRM System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Dashboard -->
          <li class="nav-item">
            <a class="nav-link" href="/crm/views/dashboard/index.php">Dashboard</a>
          </li>
          <!-- Leads Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="leadsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Leads
            </a>
            <ul class="dropdown-menu" aria-labelledby="leadsDropdown">
              <?php if (in_array($user_role, ['admin', 'sales'])): ?>
                <li><a class="dropdown-item" href="/crm/views/leads/add_lead.php">Add Lead</a></li>
                <li><hr class="dropdown-divider"></li>
              <?php endif; ?>
              <li><a class="dropdown-item" href="/crm/views/leads/list_leads.php">View Leads</a></li>
            </ul>
          </li>
          <!-- Customers -->
          <li class="nav-item">
            <a class="nav-link" href="/crm/views/customers/view_customers.php">Customers</a>
          </li>
          <!-- Communications -->
          <li class="nav-item">
            <a class="nav-link" href="/crm/views/communications/list_communications.php">Communications</a>
          </li>
        </ul>
        <!-- Right side: User info and Logout -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <span class="navbar-text">
                Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
              </span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../controllers/logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="/views/auth/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/views/auth/register.php">Register</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
