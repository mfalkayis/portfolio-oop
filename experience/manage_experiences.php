<?php
// Include file konfigurasi dan model
include_once '../config/Database.php';
include_once '../core/Experience.php'; 

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object
$experience = new Experience($db); 
$result_experiences = $experience->read(); 
$num_experiences = $result_experiences->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengalaman</title>
    <link rel="stylesheet" href="../public/css/main.css">
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
            alig
        }
        .manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            text-align: center;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background-color: #F7a399;
            color: #333;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: transform 0.2s ease; 
        }
        .btn-back:hover {
            transform: scale(1.05);
        }
        .admin-table th{
            text-align: center;
            background-color: #f7a399;
            color: #333;
            padding: 12px;
        }
    </style>
</head>
<body>

    <div class="manage-container">
        <div class="manage-header">
            <h2>Kelola Pengalaman</h2>
            <a href="../index.php#admin" class="btn-back">Kembali ke Portfolio</a>
        </div>

        <table class="admin-table"> <thead>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num_experiences > 0): ?>
                    <?php while($row = $result_experiences->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php extract($row); ?>
                    <tr>
                        <td>
                            <img src="../public/images/<?php echo $image; ?>" alt="<?php echo $title; ?>" width="100">
                        </td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $issued_date; ?></td>
                        <td>
                            <a href="exp_edit_form.php?id=<?php echo $id; ?>" class="btn-action btn-edit">Edit</a>
                            <a href="exp_delete.php?id=<?php echo $id; ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada Pengalaman.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>