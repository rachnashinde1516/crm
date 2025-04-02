<?php
 
require_once __DIR__ . '/../config/config.php';  // Correct path

class Customer {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new customer
    public function createCustomer($id, $name, $email, $phone, $address) {

        if (!empty($id)) {
            // Update existing record
            $query = 'UPDATE ' . 'customers' . ' 
                    SET name = :name, email = :email, phone = :phone, address = :address 
                    WHERE id = :id';
            $stmt = $this->pdo->prepare($query);

            // Bind data
            $stmt->bindParam(':id', $id);
        } else {
            // Insert new record
            $sql = "INSERT INTO customers (name, email, phone, address) VALUES (:name, :email, :phone, :address)";
            $stmt = $this->pdo->prepare($sql);
        }

        // Bind common parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        // Execute query
        return $stmt->execute();
    }

    // Get all customers
    public function getAllCustomers() {
        $stmt = $this->pdo->query("SELECT * FROM customers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function delete($id)
    {

        $query = 'DELETE FROM ' . 'customers' . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        $result;
        try{
            $result = $stmt->execute();
        }catch(Exception $e){
            if(str_contains($e->getMessage(), 'Cannot delete or update a parent row')){
                $result = 'Cannot delete account with open communications.';
            }else{
                $result = $e->getMessage();
            }
        }
        return $result;
    }

    // Method to get Customer details by ID
    public function getCustomerById($id)
    {
        $query = 'SELECT id, name, email, phone, address FROM ' . 'customers' . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>
