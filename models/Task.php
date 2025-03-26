<?php
// models/Task.php
 
namespace App\Models;
 
use PDO;
 
class Task
{
    private $conn;
    private $table = 'Tasks';
 
    public $id;
    public $lead_id;
    public $label;
    public $due_date;
    public $description; // Type of Task (e.g., email, call, message)
 
    // Constructor to initialize DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
    // Method to create a new Task entry
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (lead_id, label, due_date, description) VALUES (:lead_id, :label, :due_date, :description)';
        $stmt = $this->conn->prepare($query);
 
        // Bind data
        $stmt->bindParam(':lead_id', $this->lead_id);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':label', $this->label);
        $stmt->bindParam(':due_date', $this->due_date);
 
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
 
        return false;
    }
 
    // Method to get all Tasks
    public function getAllTasks()
    {
        $query = 'SELECT leads.name, Tasks.label, Tasks.due_date, Tasks.description FROM ' . $this->table . ' INNER JOIN leads ON Tasks.lead_id = leads.id ORDER BY due_date ASC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
    // Method to get Task details by ID
    public function getTaskById($id)
    {
        $query = 'SELECT id, lead_id, label, due_date, description FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>