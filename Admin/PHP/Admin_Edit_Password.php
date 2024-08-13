<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['username'])) {
    header("Location: Admin_Login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT id, password FROM user WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ambil ID dari hasil query
    $row = $result->fetch_assoc();
    $id = $row['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password_lama = $_POST['password-lama'];
        $password_baru = $_POST['password-baru'];
        $confirm_password_baru = $_POST['confirm-password-baru'];

        if ($password_baru == $confirm_password_baru) {
            if ($password_lama == $row['password']) {
                // Update data pengguna berdasarkan ID
                $sql_update = "UPDATE user SET password='$password_baru' WHERE id=$id";
        
                if ($conn->query($sql_update) === TRUE) {
                    header("Location: Admin_Profile.php");
                    echo "<script>alert('Berhasil memperbaharui password');</script>";
                    exit();
                } else {
                    echo "<script>alert('Gagal memperbaharui password');</script>";
                }
            } else {
                header("Location: Admin_Edit_Password.php&error=invalid_password_old");
                exit();
            }
        } else {
            header("Location: Admin_Edit_Password.php&error=invalid_password_new");
            exit();
        }

    }
} else {
    echo "<script>alert('user tidak ditemukan');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Halaman Dashboard Admin</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Edit_Password.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="Profile">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Edit Password Admin</h2>
            </section>
            <div class="ket-edit-password">
                  <p>Silakan isi formulir di bawah ini untuk mengubah kata sandi akun Anda.
                        Pastikan kata sandi baru Anda kuat dan aman.
                        Kata sandi yang kuat biasanya terdiri dari minimal 8 karakter, mencakup huruf besar dan kecil,
                        angka,
                        serta simbol.
                        Jangan gunakan kata sandi yang mudah ditebak atau terkait dengan informasi pribadi Anda.</p>
            </div>
            <form action="Admin_Edit_Password.php" method="post">
                  <div class="edit-password-admin">
                        <div class="form-group">
                              <label for="password-lama">Password Lama</label>
                              <input type="password" id="password-lama" name="password-lama" placeholder="Password Lama"
                                    required>
                        </div>
                        <div class="form-group">
                              <label for="password-baru">Password Baru</label>
                              <input type="password" id="password-baru" name="password-baru" placeholder="Password Baru"
                                    required>
                        </div>
                        <div class="form-group">
                              <label for="confirm-password-baru">Confirm Password Baru</label>
                              <input type="password" id="confirm-password-baru" name="confirm-password-baru"
                                    placeholder="Confirm Password Baru" required>
                        </div>
                  </div>
                  <div class="tombol">
                        <a href="Admin_Profile.php">
                              <i class="fa-solid fa-x"></i>
                              <strong>Kembali</strong>
                        </a>
                        <button type="submit" id="tombol-simpan" class="tombol-simpan">
                              <i class="fa-regular fa-floppy-disk"></i>
                              <strong>Simpan</strong>
                        </button>
                  </div>
            </form>
      </main>
      <script src="..\Js\Main.js"></script>
</body>

</html>