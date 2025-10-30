<?php
include_once '../config/Database.php';
include_once '../core/Skill.php';

$database = new Database();
$db = $database->connect();
$skill = new Skill($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $skill->id = $_POST['id'];
    $skill->name = $_POST['name'];
    $skill->percentage = $_POST['percentage'];

    // Set properti lainnya
    $skill->name = $_POST['name'];
    $skill->percentage = $_POST['percentage'];

    // Update data
    if($skill->update()) {
        echo "Skill berhasil diupdate.";
        header("refresh:2;url=manage_skills.php");
    } else {
        echo "Gagal mengupdate skill.";
    }
}
?>