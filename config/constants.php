
<?php
// Database configuration constants
define('DB_HOST', 'localhost');         // Hostname or IP address of the database server
define('DB_NAME', 'crm_system');        // Name of the database
define('DB_USER', 'root');              // Database username (default is 'root' for localhost)
define('DB_PASS', '');                  // Database password (set to '' if there is no password)
 
// Site-wide constants
define('SITE_NAME', 'My CRM System');  // Name of the CRM system (for title, branding, etc.)
define('ADMIN_EMAIL', 'admin@example.com');  // Admin email address for system alerts and notifications
 
// Other configuration constants
define('MAX_LOGIN_ATTEMPTS', 5);       // Max login attempts before account is locked
define('PASSWORD_RESET_EXPIRY', 3600); // Password reset link expiry time in seconds (1 hour)
 
// Email configuration constants (SMTP setup for sending emails)
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'no-reply@example.com');
define('SMTP_PASS', 'smtp_password');
 
// Define paths for image upload directories
define('UPLOAD_DIR', '/path/to/uploads/');
define('PROFILE_IMAGE_DIR', UPLOAD_DIR . 'profile_images/');
define('DOCUMENT_DIR', UPLOAD_DIR . 'documents/');
?>
