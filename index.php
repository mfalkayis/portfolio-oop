<?php
// Include file konfigurasi dan model
include_once 'config/Database.php';
include_once 'core/Experience.php'; 
include_once 'core/Skill.php';

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object experience
$experience = new Experience($db);

$result_experiences = $experience->read(); 
$num_experiences = $result_experiences->rowCount(); 

// Inisialisasi object skill
$skill = new Skill($db);
$result_skills = $skill->read();
$num_skills = $result_skills->rowCount();
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
            <a href="#experience" class="nav-link">Experience</a>
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
            <a href="#experience" class="btn-primary">Lihat Pengalaman Saya</a>
        </div>
        <div class="hero-image">
            <img src="public/images/nova.jpg" alt="Nova Reskianti">
        </div>
    </section>

    <section id="experience" class="section-container">
        <h2>My Experience</h2>
        <div class="card-grid"> <?php
                // Reset pointer hasil query sertifikat
                $result_experiences->execute(); 
            ?>
            <?php if($num_experiences > 0): ?>
                <?php while($row = $result_experiences->fetch(PDO::FETCH_ASSOC)): ?>
                <?php extract($row); ?>

                <div class="card">
                    <div class="card-image-container">
                        <img src="public/images/<?php echo $image; ?>" 
                            alt="<?php echo $title; ?>"
                            onclick="openModal(this)">
                    </div>
                    <div class="card-content">
                        <h3><?php echo $title; ?></h3> 
                        <p class="card-description"><?php echo $description; ?></p> 
                        <?php if(!empty($issued_date)): ?>
                        <p>Tanggal Terbit: <?php echo date("d M Y", strtotime($issued_date)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php endwhile; ?>
            <?php else: ?>
                <p>Belum ada sertifikat untuk ditampilkan.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="skills" class="section-container">
        <h2>My Skills</h2>

        <?php if($num_skills > 0): ?>
            <div class="skills-grid">
                <?php while($row = $result_skills->fetch(PDO::FETCH_ASSOC)): ?>
                <?php extract($row); // Ini akan memberi kita variabel $name dan $percentage ?>

                <div class="skill-item">
                    <div class="skill-header">
                        <span class="skill-name"><?php echo $name; ?></span>
                        <span class="skill-percent"><?php echo $percentage; ?>%</span>
                    </div>
                    <div class="skill-bar-container">
                        <div class="skill-bar-fill" style="width: <?php echo $percentage; ?>%;"></div>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center;">Belum ada data skill. Silakan tambahkan melalui Admin Panel.</p>
        <?php endif; ?>
    </section>

    <section id="about" class="section-container">
        <h2>About Me</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="public/images/nova.jpg" alt="Foto Profil Nova Reskianti">
            </div>
            <div class="about-text">
                <p>
                    Halo! Saya Nova Reskianti, mahasiswi Sistem Informasi di Institut Teknologi Kalimantan. Saya adalah individu yang adaptif, efisien dalam memecahkan masalah, dan selalu terbuka untuk mencoba hal-hal baru.
                </p>
                <p>
                    Saya memiliki minat kuat di bidang desain UI/UX (Canva, Figma) dan External Relations, yang saya kembangkan secara aktif di Himpunan Mahasiswa (HMSI) dan IEEE ITK. Pengalaman kepanitiaan di divisi PDD dan Acara telah melatih saya untuk bertanggung jawab, mengelola deadline secara efisien, dan pentingnya koordinasi tim.
                </p>
                
            </div>
        </div>
    </section>

    <section id="admin" class="section-container admin-section">
        <h2>Admin Panel</h2>
        <p>Gunakan tombol di bawah untuk menambahkan Pengalaman atau Skill baru ke portofolio.</p>

        <div class="admin-action-cards">
            <div class="admin-card">
                <h3>Pengalaman</h3>
                <div class="card-buttons">
                    <a href="experience/exp_create_form.php" class="btn-plus" title="Tambah Pengalaman Baru">+</a>
                    <a href="experience/manage_experiences.php" class="btn-manage" title="Kelola Pengalaman">Kelola</a>
                </div>
            </div>

            <div class="admin-card">
                <h3>Skills</h3>
                <div class="card-buttons">
                    <a href="skill/skill_create_form.php" class="btn-plus" title="Tambah Skill Baru">+</a>
                    <a href="skill/manage_skills.php" class="btn-manage" title="Kelola Skills">Kelola</a>
                </div>
            </div>

            <div class="admin-card">
                <h3>Pendidikan</h3>
                <div class="card-buttons">
                    <a href="education/edu_create_form.php" class="btn-plus" title="Tambah Pendidikan Baru">+</a>
                    <a href="education/manage_education.php" class="btn-manage" title="Kelola Pendidikan">Kelola</a>
                </div>
            </div>
        </div>
    </section>

    </section>
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script src="public/js/main.js"></script>
    
</body>
</html>