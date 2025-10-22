<!DOCTYPE html>
<html>
<head>
    <title>Tambah Skill</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h2>Form Tambah Skill</h2>
    <form action="skill_create_process.php" method="POST" enctype="multipart/form-data">
        <p>Nama Skill: <input type="text" name="name" required></p>
        <p>Persentase: <input type="number" name="percentage" min="0" max="100" required></p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>