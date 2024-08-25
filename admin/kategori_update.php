<?php 
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id  = $_POST['id'];
    $kategori  = $_POST['kategori'];

    $allowed_extensions = array('gif', 'png', 'jpg', 'jpeg');

    // Check if a file is uploaded
    if (!empty($_FILES['foto']['name'])) {
        $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        // Check if the uploaded file has a valid extension
        if (in_array($file_extension, $allowed_extensions)) {
            $unique_filename = uniqid() . '_' . $_FILES['foto']['name'];
            $upload_path = '../assets/pictures/kategori/' . $unique_filename;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                // Insert the user data into the database
                $query = "update kategori set kategori='$kategori', kategori_foto='$unique_filename' where kategori_id='$id'";
                if (mysqli_query($koneksi, $query)) {
                    header("location:kategori.php?alert=edit");
                    exit;
                } else {
                    echo "Terjadi kesalahan saat menyimpan data kategori.";
                }
            } else {
                echo "Terjadi kesalahan saat mengunggah foto.";
            }
        } else {
            echo "Tipe file foto tidak valid.";
        } 
    } else {
        // Insert the user data without a photo
        $query = "update kategori set kategori='$kategori' where kategori_id='$id'";
        if (mysqli_query($koneksi, $query)) {
            header("location:kategori.php?alert=edit");
            exit;
        } else {
            echo "Terjadi kesalahan saat menyimpan data kategori.";
        }
    }
}
?>