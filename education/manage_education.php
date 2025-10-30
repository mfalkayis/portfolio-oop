<?php
// (Perhatikan ../ untuk naik 1 level folder)
include_once '../config/Database.php';
include_once '../core/Education.php'; 

$database = new Database();
$db = $database->connect();

$education = new Education($db); 
$result_education = $education->read(); 
$num_education = $result_education->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendidikan</title>
    <link rel="stylesheet" href="../public/css/main.css">
    <style>
        /* Style khusus untuk halaman manage */
        body { background-color: #f4f4f4; color: #333; font-family: 'Poppins', sans-serif; }
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
            background-color: #F98B88;
            color: #333;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: transform 0.2s ease; 
        }
        .btn-back:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    
    <div class="manage-container">
        <div class="manage-header">
            <h2>Kelola Pendidikan</h2>
            <a href="../index.php#admin" class="btn-back">Kembali ke Portfolio</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nama Sekolah/Universitas</th>
                    <th>Gelar</th>
                    <th>Jurusan</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num_education > 0): ?>
                    <?php while($row = $result_education->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php extract($row); ?>
                    <tr>
                        <td>
                            <?php if(!empty($logo)): ?>
                                <img src="../public/images/<?php echo $logo; ?>" alt="<?php echo $school_name; ?>" width="100">
                            <?php else: ?>
                                (No Logo)
                            <?php endif; ?>
                        </td>
                        <td><?php echo $school_name; ?></td>
                        <td><?php echo $degree; ?></td>
                        <td><?php echo $field_of_study; ?></td>
                        <td><?php echo $year_period; ?></td>
                        <td class="cell-actions">
                            <a href="edu_edit_form.php?id=<?php echo $id; ?>" class="btn-action btn-edit">Edit</a>
                            <a href="edu_delete.php?id=<?php echo $id; ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">Belum ada data pendidikan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>