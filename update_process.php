<?php
include_once 'config/Database.php';
include_once 'core/Project.php';

$database = new Database();
$db = $database->connect();
$project = new Project($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set properti ID untuk diupdate
    $project->id = $_POST['id'];
    
    // Cek apakah ada file gambar baru yang diupload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES['image']['name'];
        $target_dir = "public/images/";
        $target_file = $target_dir . basename($image);

        // Pindahkan file baru
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $project->image = $image; // Gunakan nama gambar baru
        } else {
            echo "Gagal mengupload gambar baru.";
            $project->image = $_POST['old_image']; // Jika gagal, tetap gunakan gambar lama
        }
    } else {
        // Jika tidak ada gambar baru, gunakan nama gambar yang lama
        $project->image = $_POST['old_image'];
    }

    // Set properti project lainnya dari form
    $project->title = $_POST['title'];
    $project->description = $_POST['description'];
    $project->project_url = $_POST['project_url'];

    // Update project
    if($project->update()) {
        echo "Proyek berhasil diupdate.";
        header("refresh:2;url=index.php");
    } else {
        echo "Gagal mengupdate proyek.";
    }
}
?>