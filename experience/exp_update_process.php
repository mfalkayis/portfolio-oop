<?php
include_once '../config/Database.php';
include_once '../core/Experience.php';

$database = new Database();
$db = $database->connect();
$experience = new Experience($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $experience->id = $_POST['id'];

    // Cek jika ada gambar baru
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES['image']['name'];
        $target_file = "../public/images/" . basename($image);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $experience->image = $image;
        } else {
            echo "Gagal upload gambar baru.";
            $experience->image = $_POST['old_image']; // Pakai gambar lama jika gagal
        }
    } else {
        $experience->image = $_POST['old_image']; // Tidak ada gambar baru
    }

    // Set properti lainnya
    $experience->title = $_POST['title'];
    $experience->description = $_POST['description'];

    if (empty($_POST['verification_url'])) {
        $experience->verification_url = null;
    } else {
        $experience->verification_url = $_POST['verification_url'];
    }
    
    if (empty($_POST['issued_date'])) {
        $experience->issued_date = null;
    } else {
        $experience->issued_date = $_POST['issued_date'];
    }

    // Update data
    if($experience->update()) {
        echo "Pengalaman berhasil diupdate.";
        header("refresh:2;url=manage_experiences.php");
    } else {
        echo "Gagal mengupdate pengalaman.";
    }
}
?>