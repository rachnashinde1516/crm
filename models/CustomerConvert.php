<?php
namespace App\Models;
 
require_once __DIR__ . '/../config/config.php';  // Correct path

class CustomerConvert {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new customer
    public function createCustomer($name, $email, $phone, $address) {
        $sql = "INSERT INTO customers (name, email, phone, address) VALUES (:name, :email, :phone, :address)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address
        ]);
    }

    // Get all customers
    public function getAllCustomers() {
        $stmt = $this->pdo->query("SELECT * FROM customers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
