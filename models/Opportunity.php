<?php
// models/Lead.php
 
namespace App\Models;
 
use PDO;
 
class Opportunity
{
    private $conn;
    private $table = 'opportunities';
 
    public $id;
    public $title;
    public $lead_id;
    public $amount;
    public $stage;
 
    // Constructor to initialize DB connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
    // Method to add a new lead
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (title, lead_id, amount, stage) VALUES (:title, :lead_id, :amount, :stage)';
        $stmt = $this->conn->prepare($query);
 
        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':lead_id', $this->lead_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':stage', $this->stage);
 
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
 
        return false;
    }
 
    // Method to get all leads
    public function getAllOpps()
    {
        $query = 'SELECT leads.name, opportunities.title, opportunities.amount, opportunities.stage FROM ' . $this->table . ' INNER JOIN leads ON opportunities.lead_id = leads.id ORDER BY leads.name ASC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
    // Method to get lead details by ID
    public function getOppById($id)
    {
        $query = 'SELECT id, title, lead_id, amount, stage FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateOppstage($id, $stage) {
        $stmt = $this->conn->prepare("UPDATE leads SET stage = ? WHERE id = ?");
        return $stmt->execute([$stage, $id]);
    }
    

}
?>