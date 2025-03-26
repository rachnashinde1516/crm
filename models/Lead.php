<?php
// models/Lead.php
 
namespace App\Models;
 
use PDO;
 
class Lead
{
    private $conn;
    private $table = 'leads';
 
    public $id;
    public $name;
    public $email;
    public $phone;
    public $status;
    public $created_at;
 
    // Constructor to initialize DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
    // Method to add a new lead
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (name, email, phone, status) VALUES (:name, :email, :phone, :status)';
        $stmt = $this->conn->prepare($query);
 
        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':status', $this->status);
 
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
 
        return false;
    }
 
    // Method to get all leads
    public function getAllLeads()
    {
        $query = 'SELECT id, name, email, phone, status FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
    // Method to get lead details by ID
    public function getLeadById($id)
    {
        $query = 'SELECT id, name, email, phone, status FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateLeadStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE leads SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
    

}
?>