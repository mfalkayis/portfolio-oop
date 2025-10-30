<?php
class Education {
    private $conn;
    private $table = 'education'; // Nama tabel kita

    // Properti (sesuai kolom tabel)
    public $id;
    public $school_name;
    public $degree;
    public $field_of_study;
    public $year_period;
    public $logo; // Opsional

    public function __construct($db) {
        $this->conn = $db;
    }

    // --- Method READ (Membaca data) ---
    public function read() {
        $query = 'SELECT id, school_name, degree, field_of_study, year_period, logo 
                  FROM ' . $this->table . ' 
                  ORDER BY id DESC'; // Urutkan (bisa ganti ke ASC jika mau)
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // --- Method READ SINGLE (Untuk form edit) ---
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->school_name = $row['school_name'];
            $this->degree = $row['degree'];
            $this->field_of_study = $row['field_of_study'];
            $this->year_period = $row['year_period'];
            $this->logo = $row['logo'];
            return true;
        }
        return false;
    }

    // --- Method CREATE ---
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET 
                    school_name = :school_name, 
                    degree = :degree, 
                    field_of_study = :field_of_study, 
                    year_period = :year_period, 
                    logo = :logo';
        
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->school_name = htmlspecialchars(strip_tags($this->school_name));
        $this->degree = htmlspecialchars(strip_tags($this->degree));
        $this->field_of_study = htmlspecialchars(strip_tags($this->field_of_study));
        $this->year_period = htmlspecialchars(strip_tags($this->year_period));
        
        // Binding data
        $stmt->bindParam(':school_name', $this->school_name);
        $stmt->bindParam(':degree', $this->degree);
        $stmt->bindParam(':field_of_study', $this->field_of_study);
        $stmt->bindParam(':year_period', $this->year_period);

        // Binding opsional untuk logo
        if (is_null($this->logo)) {
            $stmt->bindValue(':logo', null, PDO::PARAM_NULL);
        } else {
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $stmt->bindParam(':logo', $this->logo);
        }

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // --- Method UPDATE ---
    public function update() {
        $query = 'UPDATE ' . $this->table . '
                  SET
                    school_name = :school_name,
                    degree = :degree,
                    field_of_study = :field_of_study,
                    year_period = :year_period,
                    logo = :logo
                  WHERE
                    id = :id';
        
        $stmt = $this->conn->prepare($query);

        // Bersihkan data
        $this->school_name = htmlspecialchars(strip_tags($this->school_name));
        $this->degree = htmlspecialchars(strip_tags($this->degree));
        $this->field_of_study = htmlspecialchars(strip_tags($this->field_of_study));
        $this->year_period = htmlspecialchars(strip_tags($this->year_period));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding data
        $stmt->bindParam(':school_name', $this->school_name);
        $stmt->bindParam(':degree', $this->degree);
        $stmt->bindParam(':field_of_study', $this->field_of_study);
        $stmt->bindParam(':year_period', $this->year_period);
        $stmt->bindParam(':id', $this->id);

        // Binding opsional untuk logo
        if (is_null($this->logo)) {
            $stmt->bindValue(':logo', null, PDO::PARAM_NULL);
        } else {
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $stmt->bindParam(':logo', $this->logo);
        }

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // --- Method DELETE ---
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