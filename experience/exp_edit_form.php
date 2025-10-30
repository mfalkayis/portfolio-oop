<?php
include_once '../config/Database.php';
include_once '../core/Experience.php';

$database = new Database();
$db = $database->connect();
$experience = new Experience($db);

// Ambil ID dari URL
$experience->id = isset($_GET['id']) ? $_GET['id'] : die();

// Ambil data tunggal
$experience->read_single();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Pengalaman</title>
    <link rel="stylesheet" href="../public/css/main.css"> <style>
        body { background-color: #f4f4f4; }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .form-container p { margin-bottom: 1rem; color: #333; }
        .form-container input, .form-container textarea { width: 100%; padding: 8px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Form Edit Pengalaman</h2>
        <form action="exp_update_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $experience->id; ?>">

            <p>Nama Kegiatan: <input type="text" name="title" value="<?php echo $experience->title; ?>" required></p>
            <p>Deskripsi: <textarea name="description"><?php echo $experience->description; ?></textarea></p>

            <p>Gambar Saat Ini: <br>
                <img src="public/images/<?php echo $experience->image; ?>" width="150">
            </p>
            <p>Ganti Gambar (opsional): <input type="file" name="image"></p>
            <input type="hidden" name="old_image" value="<?php echo $experience->image; ?>">

            <p>URL Verifikasi: <input type="text" name="verification_url" value="<?php echo $experience->verification_url; ?>"></p>
            <p>Tanggal Terbit: <input type="date" name="issued_date" value="<?php echo $experience->issued_date; ?>"></p>

            <button type="submit" class="btn-manage">Update</button>
            <a href="manage_experiences.php" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
</body>
</html>