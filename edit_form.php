<?php
include_once 'config/Database.php';
include_once 'core/Project.php';

// Inisialisasi DB & connect
$database = new Database();
$db = $database->connect();

$project = new Project($db);

// Dapatkan ID dari URL
$project->id = isset($_GET['id']) ? $_GET['id'] : die();

// Panggil method read_single untuk mendapatkan detail proyek
$project->read_single();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Proyek</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h2>Form Edit Proyek</h2>
    <form action="update_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $project->id; ?>">
        
        <p>Judul: <input type="text" name="title" value="<?php echo $project->title; ?>" required></p>
        <p>Deskripsi: <textarea name="description" required><?php echo $project->description; ?></textarea></p>
        <p>URL Proyek: <input type="text" name="project_url" value="<?php echo $project->project_url; ?>"></p>
        
        <p>Gambar Saat Ini: <br>
            <img src="public/images/<?php echo $project->image; ?>" width="150">
        </p>
        <p>Ganti Gambar (opsional): <input type="file" name="image"></p>
        <input type="hidden" name="old_image" value="<?php echo $project->image; ?>">

        <button type="submit">Update Proyek</button>
    </form>
</body>
</html>