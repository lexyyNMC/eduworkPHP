<?php
$host     = "localhost";
$username = "root";
$password = "";          // Kosongkan jika menggunakan XAMPP/Laragon default
$database = "ecommerce";   // Sesuaikan dengan nama database yang kamu buat

// Membuat koneksi menggunakan ekstensi MySQLi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>