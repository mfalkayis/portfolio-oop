<?php
include_once 'config/Database.php';
include_once 'core/Project.php';

$database = new Database();
$db = $database->connect();
$project = new Project($db);

if(isset($_GET['id'])) {
    $project->id = $_GET['id'];
    if($project->delete()) {
        echo "Proyek berhasil dihapus.";
        header("refresh:1;url=index.php");
    } else {
        echo "Gagal menghapus proyek.";
    }
}
?>