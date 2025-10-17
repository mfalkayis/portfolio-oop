<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Proyek</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h2>Form Tambah Proyek</h2>
    <form action="create_process.php" method="POST" enctype="multipart/form-data">
        <p>Judul: <input type="text" name="title" required></p>
        <p>Deskripsi: <textarea name="description" required></textarea></p>
        <p>URL Proyek: <input type="text" name="project_url"></p>
        <p>Gambar: <input type="file" name="image" required></p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>