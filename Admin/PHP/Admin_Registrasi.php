<?php
session_start();

include('koneksi_user_litbang.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simpan data login dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "INSERT INTO user (username, password, role, registered)
        VALUES (?, ?, ?, NOW())"
    );

    $role = "User";
    // Bind parameter
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        // Registrasi berhasil
        header("Location: Admin_Login.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi User</title>
    <link rel="stylesheet" href="..\CSS\Admin_Registrasi.css">
</head>

<body>
    <div class="image_register">
        <img src="..\..\image\image_login.png">
    </div>
    <div class="registrasi">
        <h2> REGISTRASI </h2>
        <p>Silakan melakukan registrasi untuk mengakses webiste Litbang Radar Lampung</p>
        <form id="registration-form" action="" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
            <button type="submit">REGISTER</button>
        </form>
        <p>Sudah memiliki akun? <a href="Admin_Login.php">Login</a></p>
    </div>
    <script src="../Js/Admin_Registrasi.js"></script>
</body>

</html>