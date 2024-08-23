<?php
include '../koneksi.php';
session_start();
$id = $_SESSION['id'];

// Validasi input
if (empty($_POST['password'])) {
    header("location:gantipassword.php?alert=gagal");
    exit;
}

// Hashing password menggunakan SHA256
$password = hash('sha256', $_POST['password']);

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