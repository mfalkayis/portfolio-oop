<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengalaman</title>
    <link rel="stylesheet" href="../public/css/forms.css"> </head>
<body>
    <div class="form-container">
        <h2>Form Tambah Pengalaman</h2>
        <form action="exp_create_process.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="title">Nama Kegiatan:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Gambar:</label>
                <input type="file" id="image" name="image" required>
            </div>

            <div class="form-group">
                <label for="verification_url">URL Verifikasi (opsional):</label>
                <input type="text" id="verification_url" name="verification_url">
            </div>

            <div class="form-group">
                <label for="issued_date">Tanggal Terbit (opsional):</label>
                <input type="date" id="issued_date" name="issued_date">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan</button>
                <a href="manage_experiences.php" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>