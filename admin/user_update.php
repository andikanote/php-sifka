<?php 
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$id  = $_POST['id'];
	$nama  = $_POST['nama'];
	$username = $_POST['username'];
	$pwd = $_POST['password'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];

	$allowed_extensions = array('gif', 'png', 'jpg', 'jpeg');

	// Check if a file is uploaded
	if (!empty($_FILES['foto']['name'])) {
		$file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);	

		// Check if the uploaded file has a valid extension
		if (in_array($file_extension, $allowed_extensions)) {
			$unique_filename = uniqid() . '_' . $_FILES['foto']['name'];
			$upload_path = '../assets/pictures/' . $unique_filename;	

			// Move the uploaded file to the destination folder
			if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path))  {
				// Insert the user data into the database
				$query = "update user set user_nama='$nama', user_username='$username', user_password='$password', user_foto='$unique_filename', user_level='$level' where user_id='$id'";
				if (mysqli_query($koneksi, $query)) {
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
		$query = "update user set user_nama='$nama', user_username='$username', user_password='$password', user_level='$level' where user_id='$id'";
		if (mysqli_query($koneksi, $query)) {
			header("location:user.php?alert=edit");
			exit;
		} else {
			echo "Terjadi kesalahan saat menyimpan data user.";
		}
	}
}
?>