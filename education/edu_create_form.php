<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pendidikan</title>
    <link rel="stylesheet" href="../public/css/forms.css"> </head>
<body>
    <div class="form-container">
        <h2>Form Tambah Pendidikan</h2>
        <form action="edu_create_process.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="school_name">Nama Sekolah/Universitas:</label>
                <input type="text" id="school_name" name="school_name" required>
            </div>

            <div class="form-group">
                <label for="degree">Gelar (Contoh: S1, SMA):</label>
                <input type="text" id="degree" name="degree" required>
            </div>

            <div class="form-group">
                <label for="field_of_study">Jurusan (Contoh: Sistem Informasi, IPA):</label>
                <input type="text" id="field_of_study" name="field_of_study" required>
            </div>

            <div class="form-group">
                <label for="year_period">Periode Tahun (Contoh: 2021 - 2025):</label>
                <input type="text" id="year_period" name="year_period" required>
            </div>

            <div class="form-group">
                <label for="logo">Logo (Opsional):</label>
                <input type="file" id="logo" name="logo">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan</button>
                <a href="manage_education.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>