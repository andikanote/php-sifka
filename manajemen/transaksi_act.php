<?php
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $nominal = mysqli_real_escape_string($koneksi, $_POST['nominal']);
    $nominal = floatval($nominal); // Convert the nominal value to a float
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
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
                // Prepare the SQL query with bound parameters
                $stmt = $koneksi->prepare("INSERT INTO transaksi (transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, transaksi_keterangan, transaksi_bank, transaksi_foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssdsss", $tanggal, $jenis, $kategori, $nominal, $keterangan, $bank, $unique_filename);

                if ($stmt->execute()) {
                    header("location:transaksi.php?alert=sukses");
                    exit;
                } else {
                    echo "Terjadi kesalahan saat menyimpan data transaksi.";
                }
            } else {
                echo "Terjadi kesalahan saat mengunggah foto.";
            }
        } else {
            echo "Tipe file foto tidak valid.";
        }
    } else {
        // Prepare the SQL query with bound parameters (without photo)
        $stmt = $koneksi->prepare("INSERT INTO transaksi (transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, transaksi_keterangan, transaksi_bank, transaksi_foto) VALUES (?, ?, ?, ?, ?, ?, '')");
        $stmt->bind_param("sssdss", $tanggal, $jenis, $kategori, $nominal, $keterangan, $bank);

        if ($stmt->execute()) {
            header("location:transaksi.php?alert=sukses");
            exit;
        } else {
            echo "Terjadi kesalahan saat menyimpan data transaksi.";
        }
    }
}
?>