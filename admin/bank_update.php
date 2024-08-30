<?php 
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
$pemilik  = mysqli_real_escape_string($koneksi, $_POST['pemilik']);
$nomor  = mysqli_real_escape_string($koneksi, $_POST['nomor']);
$saldo  = mysqli_real_escape_string($koneksi, $_POST['saldo']);

date_default_timezone_set('Asia/Jakarta'); // Set timezone to GMT+7
$currentDateTime = date("Y-m-d H:i:s"); // Format date and time as YYYY-MM-DD HH:MM:SS

// Prepare the SQL statement
$stmt = $koneksi->prepare("UPDATE bank SET bank_nama = ?, bank_pemilik = ?, bank_nomor = ?, bank_saldo = ?, update_at = ? WHERE bank_id = ?");
$stmt->bind_param("ssssss", $nama, $pemilik, $nomor, $saldo, $currentDateTime, $id);

// Execute the statement
if ($stmt->execute()) {
    header("location:bank.php");
} else {
    die("Error: " . $stmt->error);
}

// Close the statement
$stmt->close();
?>