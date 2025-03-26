<?php
// routes/web.php
 
// Simple routing structure (this can be done using a router class, or via frameworks like Laravel)
$router->get('/', function () {
    include '../views/dashboard/index.php';  // Dashboard page
});
 
$router->get('/login', function () {
    include '../views/auth/login.php';  // Login page
});
 
$router->post('/login', function () {
    // Process login credentials and authenticate
    include '../controllers/auth/login_controller.php';
});
 
$router->get('/register', function () {
    include '../views/auth/register.php';  // Register page
});
 
$router->post('/register', function () {
    // Process registration credentials
    include '../controllers/auth/register_controller.php';
});
 
$router->get('/leads/add', function () {
    include '../views/leads/add_lead.php';  // Add Lead page
});
 
$router->post('/leads/add', function () {
    // Handle new lead addition
    include '../controllers/lead_controller.php';
});
 
$router->get('/leads/list', function () {
    include '../views/leads/list_leads.php';  // List Leads page
});
 
// More routes can be added for customers, communications, etc.
$router->get('/customers/add', function () {
    include '../views/customers/add_customer.php';  // Add Customer page
});
 
$router->post('/customers/add', function () {
    // Handle new customer addition
    include '../controllers/customer_controller.php';
});
 
$router->get('/communications/log', function () {
    include '../views/communications/log_call.php';  // Log Communication page
});
 
$router->post('/communications/log', function () {
    // Handle logging communication
    include '../controllers/communication_controller.php';
});
?>