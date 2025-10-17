<?php
include_once 'config/Database.php';
include_once 'core/Project.php';

$database = new Database();
$db = $database->connect();
$project = new Project($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "public/images/";
    $target_file = $target_dir . basename($image);

    // Pindahkan file yang di-upload ke folder public/images
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Set properti project
        $project->title = $_POST['title'];
        $project->description = $_POST['description'];
        $project->project_url = $_POST['project_url'];
        $project->image = $image; // Simpan hanya nama filenya

        // Buat project
        if($project->create()) {
            echo "Proyek berhasil ditambahkan.";
            // Redirect ke halaman utama setelah 2 detik
            header("refresh:2;url=index.php");
        } else {
            echo "Gagal menambahkan proyek.";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}
?>