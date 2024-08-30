<?php
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
$pemilik  = mysqli_real_escape_string($koneksi, $_POST['pemilik']);
$nomor  = mysqli_real_escape_string($koneksi, $_POST['nomor']);
$saldo  = mysqli_real_escape_string($koneksi, $_POST['saldo']);

// Get current date and time in GMT+7
date_default_timezone_set('Asia/Jakarta'); // Set timezone to GMT+7
$currentDateTime = date("Y-m-d H:i:s"); // Format date and time as YYYY-MM-DD HH:MM:SS

// Prepare an SQL statement
$stmt = $koneksi->prepare("INSERT INTO bank (bank_nama, bank_pemilik, bank_nomor, bank_saldo, currentDateTime) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nama, $pemilik, $nomor, $saldo, $currentDateTime);
if ($stmt->execute()) {
    header("location:bank.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$koneksi->close();
