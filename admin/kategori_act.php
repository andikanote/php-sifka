<?php
include '../koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori = $_POST['kategori'];

    // Upload the photo
    $foto = $_FILES['foto'];
    $foto_name = $foto['name'];
    $foto_tmp = $foto['tmp_name'];
    $foto_size = $foto['size'];
    $foto_type = $foto['type'];
    $foto_error = $foto['error'];

    // Check if the photo is valid
    if ($foto_error == 0) {
        // Check if the photo is an image
        if (in_array($foto_type, array('image/jpeg', 'image/png', 'image/gif', 'image/jpg'))) {
            // Upload the photo to the directory
            $upload_dir = '../assets/pictures/kategori/';
            $foto_path = $upload_dir . $foto_name;
            move_uploaded_file($foto_tmp, $foto_path);

            // Insert the photo into the database
            $query = "INSERT INTO kategori (kategori, kategori_foto) VALUES ('$kategori', '$foto_name')";
            mysqli_query($koneksi, $query);

            header("location:kategori.php?alert=sukses");
        } else {
            echo "Error: Only JPEG, PNG, and GIF images are allowed.";
        }
    } else {
        echo "Error: Failed to upload photo.";
    }
}
?>