<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: Admin_Login.php");
    exit();
}

$id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT password FROM user WHERE id_user = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password_lama = $_POST['password-lama'];
        $password_baru = $_POST['password-baru'];
        $confirm_password_baru = $_POST['confirm-password-baru'];

        if ($password_baru === $confirm_password_baru) {
            if ($password_lama == $row['password']) {
                // Update password
                $stmt_update = $conn->prepare("UPDATE user SET password = ? WHERE id_user = ?");
                $stmt_update->bind_param('si', $password_baru, $id);
                if ($stmt_update->execute()) {
                    $_SESSION['notification'] = 'Password berhasil diperbaharui!';
                    header("Location: Admin_Profile.php");
                    exit();
                } else {
                    $_SESSION['notification'] = 'Gagal memperbaharui password.';
                }
                $stmt_update->close();
            } else {
                $_SESSION['notification'] = 'Password lama salah.';
            }
        } else {
            $_SESSION['notification'] = 'Password baru tidak cocok.';
        }
    }
} else {
    $_SESSION['notification'] = 'Pengguna tidak ditemukan.';
}

$stmt->close();
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
                        serta angka.
                        Jangan gunakan kata sandi yang mudah ditebak atau terkait dengan informasi pribadi Anda.</p>
            </div>
            <form action="Admin_Edit_Password.php" method="post" id="edit-password-form">
                  <div class="edit-password-admin">
                        <div class="form-group">
                              <label for="password-lama">Password Lama</label>
                              <div class=" password-field">
                                    <input type="password" id="password-lama" name="password-lama"
                                          placeholder="Password Lama" required>
                                    <i class="fa-solid fa-eye" id="toggle-password-lama"
                                          onclick="togglePassword('password-lama', 'toggle-password-lama')"></i>
                              </div>
                        </div>
                        <div class="form-group">
                              <label for="password-baru">Password Baru</label>
                              <div class="password-field">
                                    <input type="password" id="password-baru" name="password-baru"
                                          placeholder="Password Baru" required>
                                    <i class="fa-solid fa-eye" id="toggle-password-baru"
                                          onclick="togglePassword('password-baru', 'toggle-password-baru')"></i>
                              </div>
                        </div>
                        <div class="form-group">
                              <label for="confirm-password-baru">Confirm Password Baru</label>
                              <div class="password-field">
                                    <input type="password" id="confirm-password-baru" name="confirm-password-baru"
                                          placeholder="Confirm Password Baru" required>
                                    <i class="fa-solid fa-eye" id="toggle-confirm-password"
                                          onclick="togglePassword('confirm-password-baru', 'toggle-confirm-password')"></i>
                              </div>
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
      <script src="../Js/Main.js"></script>
      <script src="../Js/Admin_Edit_Password.js"></script>
</body>

</html>