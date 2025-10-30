<?php
include_once 'config/Database.php';
include_once 'core/Experience.php'; // Ganti model

$database = new Database();
$db = $database->connect();
$experience = new Experience($db); // Ganti object

if(isset($_GET['id'])) {
    $experience->id = $_GET['id'];
    if($experience->delete()) {
        echo "Pengalaman berhasil dihapus.";
        header("refresh:1;url=manage_experiences.php"); // Arahkan ke halaman pencapaian
    } else {
        echo "Gagal menghapus sertifikat.";
    }
}
?>