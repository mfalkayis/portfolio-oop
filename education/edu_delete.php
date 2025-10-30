<?php
include_once '../config/Database.php';
include_once '../core/Education.php'; 

$database = new Database();
$db = $database->connect();
$education = new Education($db); 

if(isset($_GET['id'])) {
    $education->id = $_GET['id'];
    if($education->delete()) {
        echo "Data pendidikan berhasil dihapus.";
        header("refresh:1;url=manage_education.php");
    } else {
        echo "Gagal menghapus data pendidikan.";
    }
}
?>