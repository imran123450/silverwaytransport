<?php

class Quotation {
    private $conn;
    private $table = 'quotations';

    public $id;
    public $customer_id;
    public $date_generated;
    public $total;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all quotations
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get a single quotation by ID
    public function getSingle($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // Create a new quotation
    public function create() {
        $query = "INSERT INTO " . $this->table . " (customer_id, date_generated, total) 
                  VALUES (:customer_id, :date_generated, :total)";
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':date_generated', $this->date_generated);
        $stmt->bindParam(':total', $this->total);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update an existing quotation
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET customer_id = :customer_id, date_generated = :date_generated, total = :total 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':date_generated', $this->date_generated);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a quotation
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
