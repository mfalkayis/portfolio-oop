<?php
include_once '../config/Database.php';
include_once '../core/Education.php';

$database = new Database();
$db = $database->connect();
$education = new Education($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $education->id = $_POST['id'];

    // Cek jika ada gambar baru
    if (!empty($_FILES["logo"]["name"])) {
        $logo_name = $_FILES['logo']['name'];
        $target_file = "../public/images/" . basename($logo_name);

        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            $education->logo = $logo_name;
        } else {
            echo "Gagal upload logo baru.";
            $education->logo = $_POST['old_logo'];
        }
    } else {
        $education->logo = $_POST['old_logo'];
    }

    // Set properti lainnya
    $education->school_name = $_POST['school_name'];
    $education->degree = $_POST['degree'];
    $education->field_of_study = $_POST['field_of_study'];
    $education->year_period = $_POST['year_period'];

    // Update data
    if($education->update()) {
        echo "Data pendidikan berhasil diupdate.";
        header("refresh:2;url=manage_education.php");
    } else {
        echo "Gagal mengupdate data pendidikan.";
    }
}
?>