<?php
include_once 'config/Database.php';
include_once 'core/Achievement.php'; // Ganti model

$database = new Database();
$db = $database->connect();
$achievement = new Achievement($db); // Ganti object

if(isset($_GET['id'])) {
    $achievement->id = $_GET['id'];
    if($achievement->delete()) {
        echo "Kegiatan berhasil dihapus.";
        header("refresh:1;url=manage_achievements.php"); // Arahkan ke halaman pencapaian
    } else {
        echo "Gagal menghapus sertifikat.";
    }
}
?>