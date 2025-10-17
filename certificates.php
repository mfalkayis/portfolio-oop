<?php
// Include file konfigurasi dan model
include_once 'config/Database.php';
include_once 'core/Certificate.php'; // Ganti model

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object certificate
$certificate = new Certificate($db); // Ganti object

// Query certificates
$result = $certificate->read(); // Ganti method
$num = $result->rowCount();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Sertifikat</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Manajemen Sertifikat</h1>
        <a href="index.php">Kembali ke Portfolio</a>
    </header>

    <main>
        <a href="cert_create_form.php" class="btn-add">Tambah Sertifikat Baru</a>
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Sertifikat</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num > 0): ?>
                    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php extract($row); ?>
                    <tr>
                        <td>
                            <img src="public/images/<?php echo $image; ?>" alt="<?php echo $title; ?>" width="100">
                        </td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $issued_date; ?></td>
                        <td>
                            <a href="cert_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Belum ada sertifikat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>