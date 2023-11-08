<?php
// Koneksi ke database
$db = new mysqli('localhost', 'root', '', 'poliklinik');

// Periksa koneksi
if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}

// Tangkap data dari formulir
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


// Query untuk menyimpan data pengguna ke dalam tabel admin
$query = "INSERT INTO admin (username, password, nama) VALUES ('$username', '$password', '$nama')";

if ($db->query($query) === TRUE) {
    // Redirect ke halaman login.html
    header("Location: index.php");
    exit();
} else {
    echo "Pendaftaran gagal: " . $db->error;
}

// Tutup koneksi database
$db->close();
