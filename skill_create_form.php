<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Skill</title>
    <link rel="stylesheet" href="public/css/forms.css"> </head>
<body>
    <div class="form-container">
        <h2>Form Tambah Skill</h2>
        <form action="skill_create_process.php" method="POST">
            
            <div class="form-group">
                <label for="name">Nama Skill:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="percentage">Persentase (0-100):</label>
                <input type="number" id="percentage" name="percentage" min="0" max="100" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan</button>
                <a href="manage_skills.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>