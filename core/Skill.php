<?php
class Skill {
    private $conn;
    private $table = 'skills';

    // Properti
    public $id;
    public $name;
    public $percentage;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method Read (Membaca semua data)
    public function read() {
        // Urutkan dari persentase tertinggi
        $query = 'SELECT id, name, percentage FROM ' . $this->table . ' ORDER BY percentage DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method Read Single (Untuk form edit)
    public function read_single() {
        $query = 'SELECT id, name, percentage FROM ' . $this->table . ' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->name = $row['name'];
            $this->percentage = $row['percentage'];
            return true;
        }
        return false;
    }

    // Method Create
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, percentage = :percentage';
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->percentage = htmlspecialchars(strip_tags($this->percentage));

        // Binding data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':percentage', $this->percentage);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method Update
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, percentage = :percentage WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->percentage = htmlspecialchars(strip_tags($this->percentage));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':percentage', $this->percentage);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method Delete
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>