<?php
// includes/sidebar.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'guest';
?>
<!-- Sidebar using Bootstrap classes -->
<div class="d-flex">
  <!-- Sidebar navigation -->
  <nav class="bg-light p-3" style="min-width: 220px;">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="/crm/views/dashboard/index.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#leadsSubmenu" role="button" aria-expanded="false" aria-controls="leadsSubmenu">
          Leads
        </a>
        <div class="collapse" id="leadsSubmenu">
          <ul class="nav flex-column ms-3">
            <?php if (in_array($user_role, [    'admin', 'sales'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="../leads/add_lead.php">Add Lead</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="../leads/list_leads.php">View Leads</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#customersSubmenu" role="button" aria-expanded="false" aria-controls="leadsSubmenu">
          Customers
        </a>
        <div class="collapse" id="customersSubmenu">
          <ul class="nav flex-column ms-3">
            <?php if (in_array($user_role, ['admin', 'sales'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="../customers/create_customer.php">Add Customers</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="../customers/view_customers.php">View Customers</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#callSubmenu" role="button" aria-expanded="false" aria-controls="leadsSubmenu">
          Calls
        </a>
        <div class="collapse" id="callSubmenu">
          <ul class="nav flex-column ms-3">
            <?php if (in_array($user_role, ['admin', 'sales'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="../communications/log_call.php">Add Call</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="../communications/list_communications.php">List Communications</a>
            </li>
          </ul>
        </div>
      </li>





      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#taskSubmenu" role="button" aria-expanded="false" aria-controls="leadsSubmenu">
          Task
        </a>
        <div class="collapse" id="taskSubmenu">
          <ul class="nav flex-column ms-3">
            <?php if (in_array($user_role, ['admin', 'sales'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="../Task/Task.php">Add Task</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="../Task/Task.php">View Task</a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#opportunitySubmenu" role="button" aria-expanded="false" aria-controls="leadsSubmenu">
          Opportunity
        </a>
        <div class="collapse" id="opportunitySubmenu">
          <ul class="nav flex-column ms-3">
            <?php if (in_array($user_role, ['admin', 'sales'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="../opportunity/opportunity.php">New Opportunity</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="../opportunity/opportunity.php">View Opportunity</a>
            </li>
          </ul>
        </div>
      </li>








    </ul>
  </nav>
  
  <!-- Main content placeholder for pages that include this sidebar -->
  <div class="flex-grow-1 p-3">
    <!-- The including page's content goes here -->
