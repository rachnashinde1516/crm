<?php
// models/Communication.php
 
namespace App\Models;
 
use PDO;
 
class Communication
{
    private $conn;
    private $table = 'communications';
 
    public $id;
    public $lead_id;
    public $customer_id;
    public $message;
    public $date_time;
    public $type; // Type of communication (e.g., email, call, message)
 
    // Constructor to initialize DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
    // Method to create a new communication entry
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (lead_id, customer_id, message, date_time, type) VALUES (:lead_id, :customer_id, :message, :date_time, :type)';
        $stmt = $this->conn->prepare($query);
 
        // Bind data
        $stmt->bindParam(':lead_id', $this->lead_id);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':date_time', $this->date_time);
        $stmt->bindParam(':type', $this->type);
 
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
 
        return false;
    }
 
    // Method to get all communications
    public function getAllCommunications()
    {
        $query = 'SELECT customers.name, communications.message, communications.date_time, communications.type FROM ' . $this->table . ' INNER JOIN customers ON communications.customer_id = customers.id ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
    // Method to get communication details by ID
    public function getCommunicationById($id)
    {
        $query = 'SELECT id, lead_id, customer_id, message, date_time, type FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>