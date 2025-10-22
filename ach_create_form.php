<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengalaman</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h2>Form Tambah Pengalaman</h2>
    <form action="ach_create_process.php" method="POST" enctype="multipart/form-data">
        <p>Nama Kegiatan: <input type="text" name="title" required></p>
        <p>Gambar: <input type="file" name="image" required></p>
        <p>URL Verifikasi (opsional): <input type="text" name="verification_url"></p>
        <p>Tanggal Terbit: <input type="date" name="issued_date"></p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>