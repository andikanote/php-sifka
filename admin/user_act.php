<?php
    include '../koneksi.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // Check if form data is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $foto = $_FILES['foto'];

    $allowed_extensions = array('gif', 'png', 'jpg', 'jpeg');

    // Check if a file is uploaded
    if (!empty($foto['name'])) {
    $file_extension = pathinfo($foto['name'], PATHINFO_EXTENSION);

    // Check if the uploaded file has a valid extension
    if (in_array($file_extension, $allowed_extensions)) {
    $unique_filename = uniqid() . '_' . $foto['name'];
    $upload_path = '../assets/pictures/' . $unique_filename;

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($foto['tmp_name'], $upload_path)) {
    // Insert the user data into the database
    $query = "INSERT into user values (NULL,'$nama','$username','$password','$unique_filename','$level')";
    if (mysqli_query($koneksi, $query)) {
    header("location:user.php?alert=sukses");
    exit;
    } else {
    echo "Terjadi kesalahan saat menyimpan data user.";
    }
    } else {
    echo "Terjadi kesalahan saat mengunggah foto.";
    }
    } else {
    echo "Tipe file foto tidak valid.";
    }
    } else {
    // Insert the user data without a photo
    $query = "INSERT INTO user (id, nama, username, password, foto, level) VALUES (NULL, '$nama', '$username', '$password', '', '$level')";
    if (mysqli_query($koneksi, $query)) {
    header("location:user.php?alert=sukses");
    exit;
    } else {
    echo "Terjadi kesalahan saat menyimpan data user.";
    }
    }
    }
?>