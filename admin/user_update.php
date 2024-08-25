<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id  = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pwd = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password = md5($pwd);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    $allowed_extensions = array('gif', 'png', 'jpg', 'jpeg');

    // Check if a file is uploaded
    if (!empty($_FILES['foto']['name'])) {
        $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        // Check if the uploaded file has a valid extension
        if (in_array($file_extension, $allowed_extensions)) {
            $unique_filename = uniqid() . '_' . $_FILES['foto']['name'];
            $upload_path = '../assets/pictures/' . $unique_filename;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                // Insert the user data into the database
                $query = "UPDATE user SET user_nama=?, user_username=?, user_password=?, user_foto=?, user_level=? WHERE user_id=?";
                $stmt = mysqli_prepare($koneksi, $query);
                mysqli_stmt_bind_param($stmt, 'sssssi', $nama, $username, $password, $unique_filename, $level, $id);
                if (mysqli_stmt_execute($stmt)) {
                    header("location:user.php?alert=edit");
                    exit;
                } else {
                    echo "Terjadi kesalahan saat menyimpan data user.";
                }
            } else {
                echo "Terjadi kesalahan saat mengunggah foto.";
            }
        } else {
            echo "Tipe file foto tidak valid.";
        }
    } else {
        // Insert the user data without a photo
        $query = "UPDATE user SET user_nama=?, user_username=?, user_password=?, user_level=? WHERE user_id=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $username, $password, $level, $id);
        if (mysqli_stmt_execute($stmt)) {
            header("location:user.php?alert=edit");
            exit;
        } else {
            echo "Terjadi kesalahan saat menyimpan data user.";
        }
    }
}