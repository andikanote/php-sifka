<?php
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $nominal = mysqli_real_escape_string($koneksi, $_POST['nominal']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $bank = mysqli_real_escape_string($koneksi, $_POST['bank']);
    $foto = $_FILES['foto'];

    $allowed_extensions = array('gif', 'png', 'jpg', 'jpeg');

    // Check if a file is uploaded
    if (!empty($foto['name'])) {
        $file_extension = pathinfo($foto['name'], PATHINFO_EXTENSION);

        // Check if the uploaded file has a valid extension
        if (in_array($file_extension, $allowed_extensions)) {
            $unique_filename = uniqid() . '_' . $foto['name'];
            $upload_path = '../assets/pictures/transaksi/' . $unique_filename;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($foto['tmp_name'], $upload_path)) {
                // Update the user data in the database
                $query = "UPDATE transaksi SET transaksi_tanggal = ?, transaksi_kategori = ?, transaksi_keterangan = ?, transaksi_nominal = ?, transaksi_jenis = ?, transaksi_bank = ?, transaksi_foto = ? WHERE transaksi_id = ?";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, "sssdssss", $tanggal, $kategori, $keterangan, $nominal, $jenis, $bank, $unique_filename, $id);
                if (mysqli_stmt_execute($stmt)) {
                    header("location:transaksi.php?alert=sukses");
                    exit;
                } else {
                    echo "Terjadi kesalahan saat mengupdate data transaksi.";
                }
            } else {
                echo "Terjadi kesalahan saat mengunggah foto.";
            }
        } else {
            echo "Tipe file foto tidak valid.";
        }
    } else {
        // Update the user data without a photo
        $query = "UPDATE transaksi SET transaksi_kategori = ?, transaksi_keterangan = ?, transaksi_nominal = ?, transaksi_jenis = ?, transaksi_bank = ? WHERE transaksi_id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssdsss", $kategori, $keterangan, $nominal, $jenis, $bank, $id);
        if (mysqli_stmt_execute($stmt)) {
            header("location:transaksi.php?alert=sukses");
            exit;
        } else {
            echo "Terjadi kesalahan saat mengupdate data transaksi.";
        }
    }
}
?>