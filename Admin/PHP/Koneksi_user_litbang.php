<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_litbang";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>