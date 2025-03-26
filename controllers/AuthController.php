<?php
// controllers/AuthController.php

require_once '../config/config.php';
require_once '../models/User.php';

use App\Models\User;

class AuthController
{
    private $db;

    // Pass in the PDO connection via the constructor
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Process the login request
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $userModel = new User($this->db);
            $userModel->email = $email;
            $userModel->password = $password;

            $user = $userModel->login();
            if ($user) {
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: ../views/dashboard/index.php');
                exit;
            } else {
                $_SESSION['error'] = 'Invalid credentials!';
                header('Location: ../views/auth/login.php');
                exit;
            }
        } else {
            require '../views/auth/login.php';
        }
    }

    // Process the registration request with role selection
    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            // Get the role from the registration form. In a secure app, you might restrict this.
            $role     = $_POST['role'] ?? 'user';

            // Validate the selected role; only allow known values.
            $allowedRoles = ['admin', 'sales', 'user'];
            if (!in_array($role, $allowedRoles)) {
                $_SESSION['error'] = 'Invalid role selected.';
                header('Location: ../views/auth/register.php');
                exit;
            }

            $userModel = new User($this->db);
            $userModel->name     = $name;
            $userModel->email    = $email;
            $userModel->password = $password;
            $userModel->role     = $role;

            if ($userModel->create()) {
                $_SESSION['success'] = 'Registration successful! Please log in.';
                header('Location: ../views/auth/login.php');
                exit;
            } else {
                $_SESSION['error'] = 'Registration failed!';
                header('Location: ../views/auth/register.php');
                exit;
            }
        } else {
            require '../views/auth/register.php';
        }
    }

    // Log out the user
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: ../views/auth/login.php');
        exit;
    }
}
?>