<?php
include_once '../config/Database.php';
include_once '../core/Skill.php';

$database = new Database();
$db = $database->connect();
$skill = new Skill($db);

// Ambil ID dari URL
$skill->id = isset($_GET['id']) ? $_GET['id'] : die();

// Ambil data tunggal
$skill->read_single();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Skill</title>
    <link rel="stylesheet" href="../public/css/main.css"> <style>
        body { background-color: #f4f4f4; }
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .form-container p { margin-bottom: 1rem; color: #333; }
        .form-container input, .form-container textarea { width: 100%; padding: 8px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Form Edit Skill</h2>
        <form action="skill_update_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $skill->id; ?>">

            <p>Nama Skill: <input type="text" name="name" value="<?php echo $skill->name; ?>" required></p>
            <p>Persentase: <input type="number" name="percentage" min="0" max="100" value="<?php echo $skill->percentage; ?>" required></p>
            
            <button type="submit" class="btn-manage">Update</button>
            <a href="manage_skills.php" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
</body>
</html>