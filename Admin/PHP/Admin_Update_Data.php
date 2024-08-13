<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['username'])) {
    header("Location: Admin_Login.php");
    exit();
}

$username = $_SESSION['username'];

// Dapatkan ID pengguna berdasarkan username
$sql = "SELECT id FROM user WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ambil ID dari hasil query
    $row = $result->fetch_assoc();
    $id = $row['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_lengkap = $_POST['fullname'];
        $email = $_POST['email'];
        $jenis_kelamin = $_POST['gender'];
        $no_hp = $_POST['no-hp'];

        // Update data pengguna berdasarkan ID
        $sql_update = "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', jenis_kelamin='$jenis_kelamin', no_hp='$no_hp' WHERE id=$id";

        if ($conn->query($sql_update) === TRUE) {
            header("Location: Admin_Profile.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "User not found";
}

$conn->close();
?>