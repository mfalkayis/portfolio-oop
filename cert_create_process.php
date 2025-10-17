<?php
include_once 'config/Database.php';
include_once 'core/Certificate.php'; // Ganti model

$database = new Database();
$db = $database->connect();
$certificate = new Certificate($db); // Ganti object

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image']['name'];
    $target_dir = "public/images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Set properti
        $certificate->title = $_POST['title'];
        $certificate->image = $image;
        $certificate->verification_url = $_POST['verification_url'];
        $certificate->issued_date = $_POST['issued_date'];

        // Buat sertifikat
        if($certificate->create()) {
            echo "Sertifikat berhasil ditambahkan.";
            header("refresh:2;url=certificates.php"); // Arahkan ke halaman sertifikat
        } else {
            echo "Gagal menambahkan sertifikat.";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}
?>