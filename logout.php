<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hapus sesi dari server
session_destroy();

// Redirect ke halaman login (ganti sesuai dengan halaman login Anda)
header("Location: index.php");
exit();
