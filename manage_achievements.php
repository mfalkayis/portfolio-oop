<?php
// Include file konfigurasi dan model
include_once 'config/Database.php';
include_once 'core/Achievement.php'; 

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object
$achievement = new Achievement($db); 
$result_achievements = $achievement->read(); 
$num_achievements = $result_achievements->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pencapaian</title>
    <link rel="stylesheet" href="public/css/main.css">
    <style>
        /* Style khusus untuk halaman manage */
        body { background-color: #f4f4f4; color: #333; }
        .manage-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background-color: #f9b5a9;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="manage-container">
        <div class="manage-header">
            <h2>Kelola Pencapaian</h2>
            <a href="index.php#admin" class="btn-back">Kembali ke Portfolio</a>
        </div>

        <table class="admin-table"> <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num_achievements > 0): ?>
                    <?php while($row = $result_achievements->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php extract($row); ?>
                    <tr>
                        <td>
                            <img src="public/images/<?php echo $image; ?>" alt="<?php echo $title; ?>" width="100">
                        </td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $issued_date; ?></td>
                        <td>
                            <a href="ach_edit_form.php?id=<?php echo $id; ?>">Edit</a>
                            <a href="ach_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada kegiatan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>