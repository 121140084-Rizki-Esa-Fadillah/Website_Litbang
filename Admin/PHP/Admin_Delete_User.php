<?php
session_start();

include('Koneksi_user_litbang.php');

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Redirect ke halaman manajemen user setelah berhasil dihapus
        header("Location: Admin_Manajemen_User.php");
        exit();
    } else {
        echo "Gagal menghapus user. Silakan coba lagi.";
    }

    $stmt->close();
} else {
    // Redirect jika ID tidak ditemukan
    header("Location: Admin_Manajemen_User.php");
    exit();
}

$conn->close();
?>