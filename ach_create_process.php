<?php
include_once 'config/Database.php';
include_once 'core/Achievement.php'; 

$database = new Database();
$db = $database->connect();
$achievement = new Achievement($db); // Ganti object

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image']['name'];
    $target_dir = "public/images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Set properti
        $achievement->title = $_POST['title'];
        $achievement->description = $_POST['description'];
        $achievement->image = $image;
        $achievement->verification_url = $_POST['verification_url'];
        $achievement->issued_date = $_POST['issued_date'];

        // Buat pencapaian
        if($achievement->create()) {
            echo "Kegiatan berhasil ditambahkan.";
            header("refresh:2;url=index.php#achievements"); 
        } else {
            echo "Gagal menambahkan kegiatan.";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}
?>