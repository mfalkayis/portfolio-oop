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
    <title>Nova Reskianti</title>
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
            <h1>Nova Reskianti</h1>
            <h2>Information System</h2>
            <p>Institut Teknologi Kalimantan</p>
            <a href="#certificates" class="btn-primary">View My Certificates</a>
        </div>
        <div class="hero-image">
            <img src="public/images/nova.jpg" alt="Nova Reskianti">
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
        <div class="skills-grid">

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">HTML5</span>
                    <span class="skill-percent">90%</span>
                </div>
                <div class="skill-bar-container">
                    <div class="skill-bar-fill" style="width: 90%;"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">CSS3</span>
                    <span class="skill-percent">85%</span>
                </div>
                <div class="skill-bar-container">
                    <div class="skill-bar-fill" style="width: 85%;"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">JavaScript</span>
                    <span class="skill-percent">80%</span>
                </div>
                <div class="skill-bar-container">
                    <div class="skill-bar-fill" style="width: 80%;"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">PHP</span>
                    <span class="skill-percent">75%</span>
                </div>
                <div class="skill-bar-container">
                    <div class="skill-bar-fill" style="width: 75%;"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">MySQL</span>
                    <span class="skill-percent">70%</span>
                </div>
                <div class="skill-bar-container">
                    <div class="skill-bar-fill" style="width: 70%;"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-name">Python</span>
                    <span class="skill-percent">65%</span>
                </div>
                <div class="skill-bar-container">
                    <div class="skill-bar-fill" style="width: 65%;"></div>
                </div>
            </div>

        </div>
    </section>

    <section id="about" class="section-container">
        <h2>About Me</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="public/images/nova.jpg" alt="Foto Profil Nova Reskianti">
            </div>
            <div class="about-text">
                <p>
                    Hi, I'm Nathan Sterling, a passionate web developer and designer with over 5 years of experience in creating beautiful, functional, and user-centered digital experiences.
                </p>
                <p>
                    I specialize in building responsive websites and web applications using modern technologies like React, Node.js, and Python. My background in both development and design allows me to bridge the gap between aesthetics and functionality, ensuring that the websites I create not only look great but also perform exceptionally.
                </p>
                <p>
                    When I'm not coding or designing, you can find me exploring new technologies, contributing to open-source projects, or sharing my knowledge through tech meetups and online communities.
                </p>
            </div>
        </div>
    </section>

    <section id="admin" class="section-container admin-section">
        <h2>Admin Panel</h2>
        <p>Tambah Proyek atau sertifikat</p>

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