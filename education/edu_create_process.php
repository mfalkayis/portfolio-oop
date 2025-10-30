<?php
include_once '../config/Database.php';
include_once '../core/Education.php'; 

$database = new Database();
$db = $database->connect();
$education = new Education($db); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Set properti
    $education->school_name = $_POST['school_name'];
    $education->degree = $_POST['degree'];
    $education->field_of_study = $_POST['field_of_study'];
    $education->year_period = $_POST['year_period'];
    $education->logo = null; // Default null

    // Cek jika ada file logo yang di-upload
    if (!empty($_FILES["logo"]["name"])) {
        $logo_name = $_FILES['logo']['name'];
        $target_dir = "../public/images/"; // Target di folder images
        $target_file = $target_dir . basename($logo_name);

        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            $education->logo = $logo_name; // Set nama logo jika berhasil
        } else {
            echo "Gagal mengupload logo.";
        }
    }

    // Buat data
    if($education->create()) {
        echo "Data pendidikan berhasil ditambahkan.";
        header("refresh:2;url=manage_education.php");
    } else {
        echo "Gagal menambahkan data pendidikan.";
    }
}
?>