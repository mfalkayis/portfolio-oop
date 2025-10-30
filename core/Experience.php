<?php
class Experience {
    private $conn;
    private $table = 'experiences';

    // Properti Sertifikat
    public $id;
    public $title;
    public $description;
    public $image;
    public $verification_url;
    public $issued_date;
    

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method untuk Read (Membaca data)
    public function read() {
        $query = 'SELECT id, title, description, image, verification_url, issued_date FROM ' . $this->table . ' ORDER BY created_at DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function create() {
    $query = 'INSERT INTO ' . $this->table . ' SET title = :title, description = :description, image = :image, verification_url = :verification_url, issued_date = :issued_date';
        
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));

        

        // Binding data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);

        if (is_null($this->verification_url)) {
            $stmt->bindValue(':verification_url', null, PDO::PARAM_NULL);
        } else {
            $clean_url = htmlspecialchars(strip_tags($this->verification_url));
            $stmt->bindParam(':verification_url', $clean_url);
        }

        if (is_null($this->issued_date)) {
            $stmt->bindValue(':issued_date', null, PDO::PARAM_NULL);
        } else {
            $clean_date = htmlspecialchars(strip_tags($this->issued_date));
            $stmt->bindParam(':issued_date', $clean_date);
        }

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Method untuk Delete Data
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

    public function read_single() {
        $query = 'SELECT
                    id,
                    title,
                    image,
                    verification_url,
                    issued_date
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
        if ($row) {
          $this->title = $row['title'];
          $this->image = $row['image'];
          $this->verification_url = $row['verification_url'];
          $this->issued_date = $row['issued_date'];
          return true;
        }

        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . '
                  SET
                    title = :title,
                    description = :description,
                    image = :image,
                    verification_url = :verification_url,
                    issued_date = :issued_date
                  WHERE
                    id = :id';
        
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id = htmlspecialchars(strip_tags($this->id));

        if (is_null($this->verification_url)) {
            $stmt->bindValue(':verification_url', null, PDO::PARAM_NULL);
        } else {
            $clean_url = htmlspecialchars(strip_tags($this->verification_url));
            $stmt->bindParam(':verification_url', $clean_url);
        }

        if (is_null($this->issued_date)) {
            $stmt->bindValue(':issued_date', null, PDO::PARAM_NULL);
        } else {
            $clean_date = htmlspecialchars(strip_tags($this->issued_date));
            $stmt->bindParam(':issued_date', $clean_date);
        }

        // Binding data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':verification_url', $this->verification_url);
        $stmt->bindParam(':issued_date', $this->issued_date);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}
?>