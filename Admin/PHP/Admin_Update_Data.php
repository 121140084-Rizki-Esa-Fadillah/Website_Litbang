<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: Admin_Login.php");
    exit();
}

$id = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['fullname'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['gender'];
    $no_hp = $_POST['no-hp'];

    // Update data pengguna berdasarkan ID
    $sql_update = "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', jenis_kelamin='$jenis_kelamin', no_hp='$no_hp' WHERE id_user=$id";
    
    if ($conn->query($sql_update) === TRUE) {
        // Set notification message in session
        $_SESSION['notification'] = "Data berhasil diperbarui.";
        header("Location: Admin_Profile.php");
        exit();
    } else {
        $_SESSION['notification'] = "Gagal memperbarui data: " . $conn->error;
        header("Location: Admin_Profile.php");
        exit();
    }
}

$conn->close();
?>