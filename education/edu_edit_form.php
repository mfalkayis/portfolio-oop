<?php
include_once '../config/Database.php';
include_once '../core/Education.php';

$database = new Database();
$db = $database->connect();
$education = new Education($db);

$education->id = isset($_GET['id']) ? $_GET['id'] : die();
$education->read_single();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendidikan</title>
    <link rel="stylesheet" href="../public/css/forms.css">
</head>
<body>
    <div class="form-container">
        <h2>Form Edit Pendidikan</h2>
        <form action="edu_update_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $education->id; ?>">
            
            <div class="form-group">
                <label for="school_name">Nama Sekolah/Universitas:</label>
                <input type="text" id="school_name" name="school_name" value="<?php echo $education->school_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="degree">Gelar:</label>
                <input type="text" id="degree" name="degree" value="<?php echo $education->degree; ?>" required>
            </div>

            <div class="form-group">
                <label for="field_of_study">Jurusan:</label>
                <input type="text" id="field_of_study" name="field_of_study" value="<?php echo $education->field_of_study; ?>" required>
            </div>

            <div class="form-group">
                <label for="year_period">Periode Tahun:</label>
                <input type="text" id="year_period" name="year_period" value="<?php echo $education->year_period; ?>" required>
            </div>

            <div class="form-group">
                <label>Logo Saat Ini:</label><br>
                <?php if(!empty($education->logo)): ?>
                    <img src="../public/images/<?php echo $education->logo; ?>" width="150">
                <?php else: ?>
                    (Tidak ada logo)
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="logo">Ganti Logo (Opsional):</label>
                <input type="file" id="logo" name="logo">
                <input type="hidden" name="old_logo" value="<?php echo $education->logo; ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Update</button>
                <a href="manage_education.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>