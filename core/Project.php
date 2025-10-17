<?php
class Project {
    private $conn;
    private $table = 'projects';

    // Properti Proyek
    public $id;
    public $title;
    public $description;
    public $project_url;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method untuk Read (Membaca data)
    public function read() {
        $query = 'SELECT id, title, description, project_url, image FROM ' . $this->table . ' ORDER BY created_at DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>