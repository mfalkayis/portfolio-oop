<?php
// Include file konfigurasi dan model
include_once 'config/Database.php';
include_once 'core/Project.php';
include_once 'core/Certificate.php'; // TAMBAHKAN INI

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object project
$project = new Project($db);
$result_projects = $project->read();
$num_projects = $result_projects->rowCount();

// Inisialisasi object certificate
$certificate = new Certificate($db); // TAMBAHKAN INI
$result_certificates = $certificate->read(); // TAMBAHKAN INI
$num_certificates = $result_certificates->rowCount(); // TAMBAHKAN INI
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathan Sterling - Web Developer</title>
    <link rel="stylesheet" href="public/css/main.css"> 
</head>
<body>
    
    <header class="navbar">
        <nav class="nav-container">
            <a href="#home" class="nav-link">Home</a>
            <a href="#certificates" class="nav-link">Certificates</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#about" class="nav-link">About</a>
            <a href="#admin" class="nav-link">Admin Panel</a>
        </nav>
    </header>

    <section id="home" class="section-container hero-section">
        <div class="hero-text">
            <h1>Nathan Sterling</h1>
            <h2>Web Developer & Designer</h2>
            <p>Crafting modern, responsive, and user-friendly web experiences.</p>
            <a href="#projects" class="btn-primary">View My Work</a>
        </div>
        <div class="hero-image">
            <img src="public/images/nama-gambar-kamu.jpg" alt="Nathan Sterling">
        </div>
    </section>

    <section id="certificates" class="section-container">
        <h2>My Certificates</h2>
        <div class="certificates-grid">
            <?php if($num_certificates > 0): ?>
                <?php while($row = $result_certificates->fetch(PDO::FETCH_ASSOC)): ?>
                <?php extract($row); ?>
                <div class="cert-card">
                    <img src="public/images/<?php echo $image; ?>" 
                        alt="<?php echo $title; ?>" 
                        class="cert-thumbnail"
                        onclick="openModal(this)">
                    <p class="cert-title"><?php echo $title; ?></p>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Belum ada sertifikat untuk ditampilkan.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="skills" class="section-container">
        <h2>Skills</h2>
        <p>Tampilkan logo-logo teknologi yang kamu kuasai (PHP, MySQL, JS, CSS, dll.)</p>
    </section>

    <section id="about" class="section-container">
        <h2>About Me</h2>
        <p>Paragraf singkat tentang dirimu, latar belakang pendidikan, dan minatmu di bidang IT.</p>
    </section>

    <section id="admin" class="section-container admin-section">
        <h2>Admin Panel</h2>
        <p>Area ini hanya untuk kamu mengelola konten website.</p>

        <h3>Kelola Proyek</h3>
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
                <?php if($num_projects > 0): ?>
                    <?php while($row = $result_projects->fetch(PDO::FETCH_ASSOC)): ?>
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
                    <tr><td colspan="4">Belum ada proyek.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3 style="margin-top: 40px;">Kelola Sertifikat</h3>
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
                <?php if($num_certificates > 0): ?>
                    <?php while($row = $result_certificates->fetch(PDO::FETCH_ASSOC)): ?>
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
                    <tr><td colspan="4">Belum ada sertifikat.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

    </section>
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
    
    <script src="public/js/main.js"></script>
    
</body>
</html>