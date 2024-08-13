<?php
session_start();
include('Koneksi_user_litbang.php');

// Cek apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    header("Location: Admin_Dashboard.php"); // Redirect ke halaman dashboard jika sudah login
    exit();
}

// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simpan data login dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan query untuk mendapatkan informasi pengguna berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi kata sandi
        if ($password == $user['password']) {
            // Set data pengguna dalam session
            $_SESSION['username'] = $user['username'];

            // Redirect ke halaman dashboard setelah login berhasil
            header("Location: Admin_Dashboard.php");
            exit();
        } else {
            header("Location: Admin_Login.php?error=invalid_credentials");
            exit();
        }
    } else {
        header("Location: Admin_Login.php?error=invalid_credentials");
        exit();
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Halaman Login Admin</title>
      <link rel="stylesheet" href="../CSS/Admin_Login.css">
</head>

<body>
      <div class="login">
            <h2>LOGIN</h2>
            <p>Silahkan masukkan username dan password anda untuk login</p>
            <form action="Admin_Login.php" method="post">
                  <input type="text" id="username" name="username" placeholder="Username" required>
                  <input type="password" id="password" name="password" placeholder="Password" required>
                  <button type="submit">LOGIN</button>
            </form>
      </div>
      <div class="image_login">
            <img src="../../image/image_login.png" alt="Login Image">
      </div>
      <script src="..\Js\Admin_Login.js"></script>
</body>

</html>