<?php

use PHPUnit\Framework\TestCase;

class QuotationTest extends TestCase {
    private $db;
    private $quotation;

    protected function setUp(): void {
        require_once 'config/database.php';
        require_once 'models/Quotation.php';
        
        // Initialize database and quotation
        $database = new Database();
        $this->db = $database->getConnection();
        $this->quotation = new Quotation($this->db);
    }

    public function testCreateQuotation() {
        $this->quotation->customer_id = 1;
        $this->quotation->date_generated = date('Y-m-d H:i:s');
        $this->quotation->total = 5000;
        
        $this->assertTrue($this->quotation->create(), "Quotation creation failed.");
    }

    public function testGetAllQuotations() {
        $result = $this->quotation->getAll();
        $this->assertGreaterThan(0, $result->rowCount(), "No quotations found.");
    }
}
