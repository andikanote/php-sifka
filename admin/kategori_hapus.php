<?php
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from kategori where kategori_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['kategori_foto'];
unlink("../assets/pictures/kategori/$foto");
mysqli_query($koneksi, "delete from kategori where kategori_id='$id'");
header("location:kategori.php?alert=hapus");
    