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

    // Fetch the current transaction data
    $result = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id'");
    $t = mysqli_fetch_assoc($result);
    $bank_lama = $t['transaksi_bank'];

    $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank_lama'");
    $r = mysqli_fetch_assoc($rekening);

    // Adjust the old bank balance
    if ($t['transaksi_jenis'] == "Pemasukan") {
        $kembalikan = $r['bank_saldo'] - $t['transaksi_nominal'];
        mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$kembalikan' WHERE bank_id='$bank_lama'");
    } elseif ($t['transaksi_jenis'] == "Pengeluaran") {
        $kembalikan = $r['bank_saldo'] + $t['transaksi_nominal'];
        mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$kembalikan' WHERE bank_id='$bank_lama'");
    }

    // Process the uploaded file
    $allowed_extensions = array('gif', 'png', 'jpg', 'jpeg');
    if (!empty($foto['name'])) {
        $file_extension = pathinfo($foto['name'], PATHINFO_EXTENSION);

        // Check for valid file extension
        if (in_array($file_extension, $allowed_extensions)) {
            $unique_filename = uniqid() . '_' . $foto['name'];
            $upload_path = '../assets/pictures/transaksi/' . $unique_filename;

            // Move the uploaded file
            if (move_uploaded_file($foto['tmp_name'], $upload_path)) {
                $query = "UPDATE transaksi SET transaksi_tanggal = ?, transaksi_kategori = ?, transaksi_keterangan = ?, transaksi_nominal = ?, transaksi_jenis = ?, transaksi_bank = ?, transaksi_foto = ? WHERE transaksi_id = ?";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, "sssdssss", $tanggal, $kategori, $keterangan, $nominal, $jenis, $bank, $unique_filename, $id);
            } else {
                echo "Terjadi kesalahan saat mengunggah foto.";
                exit;
            }
        } else {
            echo "Tipe file foto tidak valid.";
            exit;
        }
    } else {
        // Update without a photo
        $query = "UPDATE transaksi SET transaksi_tanggal = ?, transaksi_kategori = ?, transaksi_keterangan = ?, transaksi_nominal = ?, transaksi_jenis = ?, transaksi_bank = ? WHERE transaksi_id = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssdsss", $tanggal, $kategori, $keterangan, $nominal, $jenis, $bank, $id);
    }

    // Execute the update and adjust the new bank balance
    if (mysqli_stmt_execute($stmt)) {
        if ($jenis == "Pemasukan") {
            $rekening2 = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
            $rr = mysqli_fetch_assoc($rekening2);
            $saldo_sekarang = $rr['bank_saldo'];
            $total = $saldo_sekarang + $nominal;
            mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
        } elseif ($jenis == "Pengeluaran") {
            $rekening2 = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
            $rr = mysqli_fetch_assoc($rekening2);
            $saldo_sekarang = $rr['bank_saldo'];
            $total = $saldo_sekarang - $nominal;
            mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
        }
        
        header("location:transaksi.php?alert=sukses");
        exit;
    } else {
        echo "Terjadi kesalahan saat mengupdate data transaksi.";
    }
}
?>