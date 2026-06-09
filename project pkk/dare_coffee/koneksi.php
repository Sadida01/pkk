<?php
$host = "localhost";       // Host server MySQL
$user = "root";            // Username database
$pass = "";                // Password database (kosong kalau pakai XAMPP)
$db   = "dare_coffee";     // Nama database

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die(json_encode([
        "success" => false,
        "message" => "Koneksi gagal: " . mysqli_connect_error()
    ]));
} else {
    // Jika ingin respon JSON ke Android
    // hapus komentar di bawah:
    
    // echo json_encode([
    //     "success" => true,
    //     "message" => "Koneksi berhasil"
    // ]);
}
?>
