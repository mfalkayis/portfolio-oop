<!DOCTYPE html>
<html>
<head>
    <title>Tambah Sertifikat</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h2>Form Tambah Sertifikat</h2>
    <form action="cert_create_process.php" method="POST" enctype="multipart/form-data">
        <p>Judul: <input type="text" name="title" required></p>
        <p>Gambar: <input type="file" name="image" required></p>
        <p>URL Verifikasi (opsional): <input type="text" name="verification_url"></p>
        <p>Tanggal Terbit (opsional): <input type="date" name="issued_date"></p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>