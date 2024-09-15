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
    $max_file_size = 1 * 1024 * 1024; // 1MB

    // Get current date and time in GMT+7
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date("Y-m-d H:i:s"); 
    $formattedDate = date("dmY"); 
    $randomNumber = rand(10000000, 99999999); // Generate a random number
    $prefixTrx = "trx";

    // Check if a file is uploaded
    if (!empty($foto['name'])) {
        $file_extension = pathinfo($foto['name'], PATHINFO_EXTENSION);

        // Check if the uploaded file has a valid extension
        if (in_array($file_extension, $allowed_extensions)) {
            // Check if the file size exceeds 1MB
            if ($foto['size'] > $max_file_size) {
                // Resize the image
                $source_image = null;

                if ($file_extension == 'jpg' || $file_extension == 'jpeg') {
                    $source_image = imagecreatefromjpeg($foto['tmp_name']);
                } elseif ($file_extension == 'png') {
                    $source_image = imagecreatefrompng($foto['tmp_name']);
                } elseif ($file_extension == 'gif') {
                    $source_image = imagecreatefromgif($foto['tmp_name']);
                }

                if ($source_image) {
                    // Get original dimensions
                    list($width, $height) = getimagesize($foto['tmp_name']);
                    $new_width = $width;
                    $new_height = $height;

                    // Calculate new dimensions
                    while ($new_width * $new_height * 4 > $max_file_size) {
                        $new_width *= 0.9;
                        $new_height *= 0.9;
                    }

                    // Create a new true color image
                    $resized_image = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($resized_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    // Save the resized image
                    $unique_filename = $prefixTrx . '-' . $formattedDate . '-' . $randomNumber . '.jpg';
                    $upload_path = '../assets/pictures/transaksi/' . $unique_filename;

                    if (imagejpeg($resized_image, $upload_path, 90)) { // Save image as JPEG with quality 90
                        imagedestroy($source_image);
                        imagedestroy($resized_image);
                    } else {
                        echo "Terjadi kesalahan saat menyimpan foto.";
                        exit;
                    }
                } else {
                    echo "Format gambar tidak didukung.";
                    exit;
                }
            } else {
                // Move the uploaded file to the destination folder
                $unique_filename = $prefixTrx . '-' . $formattedDate . '-' . $randomNumber . '.jpg';
                $upload_path = '../assets/pictures/transaksi/' . $unique_filename;

                if (!move_uploaded_file($foto['tmp_name'], $upload_path)) {
                    echo "Terjadi kesalahan saat mengunggah foto.";
                    exit;
                }
            }

            // Prepare the SQL query with bound parameters
            $stmt = $koneksi->prepare("INSERT INTO transaksi (transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, transaksi_keterangan, transaksi_bank, transaksi_foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssdsss", $tanggal, $jenis, $kategori, $nominal, $keterangan, $bank, $unique_filename);

            if ($stmt->execute()) {
                // Update bank saldo
                $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
                $r = mysqli_fetch_assoc($rekening);

                if ($jenis === "Pemasukan") {
                    $saldo_sekarang = $r['bank_saldo'];
                    $total = $saldo_sekarang + $nominal;
                    mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
                } elseif ($jenis === "Pengeluaran") {
                    $saldo_sekarang = $r['bank_saldo'];
                    $total = $saldo_sekarang - $nominal;
                    mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
                }
                header("location:../index.php?alert=sukses");
                exit;
            } else {
                echo "Terjadi kesalahan saat menyimpan data transaksi.";
            }
        } else {
            echo "Tipe file foto tidak valid.";
        }
    } else {
        // Prepare the SQL query with bound parameters (without photo)
        $stmt = $koneksi->prepare("INSERT INTO transaksi (transaksi_tanggal, transaksi_jenis, transaksi_kategori, transaksi_nominal, transaksi_keterangan, transaksi_bank, transaksi_foto) VALUES (?, ?, ?, ?, ?, ?, '')");
        $stmt->bind_param("sssdss", $tanggal, $jenis, $kategori, $nominal, $keterangan, $bank);

        if ($stmt->execute()) {
            // Update bank saldo
            $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
            $r = mysqli_fetch_assoc($rekening);

            if ($jenis === "Pemasukan") {
                $saldo_sekarang = $r['bank_saldo'];
                $total = $saldo_sekarang + $nominal;
                mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
            } elseif ($jenis === "Pengeluaran") {
                $saldo_sekarang = $r['bank_saldo'];
                $total = $saldo_sekarang - $nominal;
                mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
            }

            header("location:../index.php?alert=sukses");
            exit;
        } else {
            echo "Terjadi kesalahan saat menyimpan data transaksi.";
        }
    }
}
?>