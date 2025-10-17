<?php
include_once 'config/Database.php';
include_once 'core/Certificate.php'; // Ganti model

$database = new Database();
$db = $database->connect();
$certificate = new Certificate($db); // Ganti object

if(isset($_GET['id'])) {
    $certificate->id = $_GET['id'];
    if($certificate->delete()) {
        echo "Sertifikat berhasil dihapus.";
        header("refresh:1;url=certificates.php"); // Arahkan ke halaman sertifikat
    } else {
        echo "Gagal menghapus sertifikat.";
    }
}
?>