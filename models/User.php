<?php
// models/User.php

namespace App\Models;

use PDO;

class User
{
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $role; // This will store 'admin', 'sales', or 'user'

    // Constructor to initialize DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create a new user (registration)
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (name, email, password, role)
                  VALUES (:name, :email, :password, :role)';
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);

        // Hash the password securely
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }

    // Attempt to log in a user
    public function login()
    {
        $query = 'SELECT id, name, email, password, role FROM ' . $this->table . ' 
                  WHERE email = :email LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the submitted password against the stored hash
            if (password_verify($this->password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}
?>