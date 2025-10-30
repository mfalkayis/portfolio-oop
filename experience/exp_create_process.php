<?php
include_once '../config/Database.php';
include_once '../core/Experience.php'; 

$database = new Database();
$db = $database->connect();
$experience = new Experience($db); // Ganti object

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image']['name'];
    $target_dir = "../public/images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Set properti
        $experience->title = $_POST['title'];
        $experience->description = $_POST['description'];
        $experience->image = $image;
        $experience->verification_url = !empty($_POST['verification_url']) ? $_POST['verification_url'] : null;
        $experience->issued_date = !empty($_POST['issued_date']) ? $_POST['issued_date'] : null;

        // Buat pencapaian
        if($experience->create()) {
            echo "Pengalaman berhasil ditambahkan.";
            header("refresh:2;url=../index.php#experiences"); 
        } else {
            echo "Gagal menambahkan pengalaman.";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}
?>