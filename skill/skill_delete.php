<?php
include_once '../config/Database.php';
include_once '../core/Skill.php'; // Ganti model

$database = new Database();
$db = $database->connect();
$skill = new Skill($db); // Ganti object

if(isset($_GET['id'])) {
    $skill->id = $_GET['id'];
    if($skill->delete()) {
        echo "Skill berhasil dihapus.";
        header("refresh:1;url=manage_skills.php"); // Arahkan ke halaman skill
    } else {
        echo "Gagal menghapus skill.";
    }
}
?>