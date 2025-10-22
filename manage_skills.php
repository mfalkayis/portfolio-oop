<?php
// Include file konfigurasi dan model
include_once 'config/Database.php';
include_once 'core/Skill.php'; 

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi object
$skill = new Skill($db); 
$result_skills = $skill->read(); 
$num_skills = $result_skills->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Skill</title>
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
            background-color: #586457;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="manage-container">
        <div class="manage-header">
            <h2>Kelola Skill</h2>
            <a href="index.php#admin" class="btn-back">Kembali ke Portfolio</a>
        </div>

        <table class="admin-table"> <thead>
                <tr>
                    <th>Nama Skill</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num_skills > 0): ?>
                    <?php while($row = $result_skills->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php extract($row); ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $percentage; ?>%</td>
                        <td>
                            <a href="skill_edit_form.php?id=<?php echo $id; ?>">Edit</a>
                            <a href="skill_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada skill.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>