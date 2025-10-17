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
    public function create() {
    $query = 'INSERT INTO ' . $this->table . ' SET title = :title, description = :description, project_url = :project_url, image = :image';

    $stmt = $this->conn->prepare($query);

    // Bersihkan data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->project_url = htmlspecialchars(strip_tags($this->project_url));
    $this->image = htmlspecialchars(strip_tags($this->image));

    // Binding data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':project_url', $this->project_url);
    $stmt->bindParam(':image', $this->image);

    if($stmt->execute()) {
        return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
    }

    public function delete() {
    // Query untuk menghapus data berdasarkan ID
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()) {
        return true;
    }
    return false;
    }

    public function read_single() {
        $query = 'SELECT
                    id,
                    title,
                    description,
                    project_url,
                    image
                  FROM
                    ' . $this->table . '
                  WHERE
                    id = ?
                  LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->project_url = $row['project_url'];
        $this->image = $row['image'];
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . '
                  SET
                    title = :title,
                    description = :description,
                    project_url = :project_url,
                    image = :image
                  WHERE
                    id = :id';
        
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->project_url = htmlspecialchars(strip_tags($this->project_url));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':project_url', $this->project_url);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    
}
?>