<?php
include_once '../config/Database.php';
include_once '../core/Skill.php'; 

$database = new Database();
$db = $database->connect();
$skill = new Skill($db); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    $skill->name = $_POST['name'];
    $skill->percentage = $_POST['percentage'];

    // Buat skill
    if($skill->create()) {
        echo "Skill berhasil ditambahkan.";
        header("refresh:2;url=manage_skills.php"); 
    } else {
        echo "Gagal menambahkan skill.";
    }
}
?>