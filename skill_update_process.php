<?php
include_once 'config/Database.php';
include_once 'core/Achievement.php';

$database = new Database();
$db = $database->connect();
$achievement = new Achievement($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $achievement->id = $_POST['id'];

    // Cek jika ada gambar baru
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES['image']['name'];
        $target_file = "public/images/" . basename($image);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $achievement->image = $image;
        } else {
            echo "Gagal upload gambar baru.";
            $achievement->image = $_POST['old_image']; // Pakai gambar lama jika gagal
        }
    } else {
        $achievement->image = $_POST['old_image']; // Tidak ada gambar baru
    }

    // Set properti lainnya
    $achievement->title = $_POST['title'];
    $achievement->description = $_POST['description'];
    $achievement->verification_url = $_POST['verification_url'];
    $achievement->issued_date = $_POST['issued_date'];

    // Update data
    if($achievement->update()) {
        echo "Pencapaian berhasil diupdate.";
        header("refresh:2;url=manage_achievements.php");
    } else {
        echo "Gagal mengupdate pencapaian.";
    }
}
?>