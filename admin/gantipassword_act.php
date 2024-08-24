<?php
include '../koneksi.php';
session_start();
$id = $_SESSION['id'];

// Validasi input
if (empty($_POST['password']) || strlen($_POST['password']) < 6 || strlen($_POST['password']) > 16) {
    header("location:gantipassword.php?alert=gagal");
    exit;
}

// Hashing password menggunakan MD5
$password = md5($_POST['password']);

try {
    // Jalankan query
    $query = "UPDATE user SET user_password='$password' WHERE user_id='$id'";
    if (!mysqli_query($koneksi, $query)) {
        throw new Exception(mysqli_error($koneksi));
    }

    // Redirect ke halaman sukses
    header("location:gantipassword.php?alert=sukses");
} catch (Exception $e) {
    // Tangani kesalahan
    echo "Error: " . $e->getMessage();
}