<?php
// Include file konfigurasi dan model
include_once 'config/Database.php';
include_once 'core/Project.php';

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object project
$project = new Project($db);

// Query projects
$result = $project->read();
$num = $result->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>My Awesome Portfolio</h1>
        <p>Seorang Mahasiswa Magang di Perusahaan IT</p>
    </header>

    <main>
        <h2>My Projects</h2>
        <a href="create_form.php" class="btn-add">Tambah Proyek Baru</a>
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Proyek</th>
                    <th>Deskripsi</th>
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
                        <td><?php echo $description; ?></td>
                        <td>
                            <a href="edit_form.php?id=<?php echo $id; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Belum ada proyek.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>