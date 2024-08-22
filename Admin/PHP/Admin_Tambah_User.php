<?php
session_start();

include('Koneksi_user_litbang.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $no_hp = $_POST['no-hp'];
    $password = $_POST['password'];
    $roles = $_POST['roles'];

    // Siapkan statement untuk insert data
    $stmt = $conn->prepare(
        "INSERT INTO user (nama_lengkap, username, jenis_kelamin, email, no_hp, password, role, registered)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())"
    );

    // Bind parameter
    $stmt->bind_param("sssssss", $fullname, $username, $gender, $email, $no_hp, $password, $roles);

    // Eksekusi statement
    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman manajemen user
        $_SESSION['notification'] = "Data pengguna berhasil ditambahkan.";
        header("Location: Admin_Manajemen_User.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        echo "<script>alert('Gagal menambahkan user baru. Silakan coba lagi.');</script>";
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
      <title>Halaman Dashboard Admin</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Tambah_User.css">
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
                  <h2>Tambah User</h2>
            </section>
            <div class="header-add-user">
                  <h2>Tambah User</h2>
            </div>
            <form method="post" id="tambah-user-form">
                  <div class="data-profile-user">
                        <div>
                              <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Masukkan Nama"
                                          required>
                              </div>
                              <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Masukkan Username"
                                          required>
                              </div>
                              <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select id="gender" name="gender">
                                          <option value="Laki-Laki">Laki - Laki</option>
                                          <option value="Perempuan">Perempuan</option>
                                    </select>
                              </div>
                              <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
                              </div>
                              <div class="form-group">
                                    <label for="no-hp">No. Hp</label>
                                    <input type="number" id="no-hp" name="no-hp" placeholder="Masukkan No HP" required>
                              </div>
                              <div class="form-group password-field">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Masukkan Password"
                                          required>
                                    <i class="fa-solid fa-eye" id="toggle-password" onclick="togglePassword()"></i>
                              </div>
                              <div class="form-group password-field">
                                    <label for="confirm.password">Confirm Password</label>
                                    <input type="password" id="confirm-password" name="confirm-password"
                                          placeholder="Confirm Password" required>
                                    <i class="fa-solid fa-eye" id="toggle-password"
                                          onclick="toggleConfirmPassword()"></i>
                              </div>
                              <div class="form-group">

                                    <div class="roles">
                                          <label for="roles">Roles</label>
                                          <input type="radio" id="admin" name="roles" placeholder="admin" value="Admin">
                                          <label for="admin">Admin</label>
                                          <input type="radio" id="user" name="roles" placeholder="user" value="User">
                                          <label for="user">User</label>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="tombol">
                        <a href="Admin_Manajemen_User.php" class="tombol-cancel">
                              <i class="fa-solid fa-x"></i>
                              <strong>Batal</strong>
                        </a>
                        <button class="tombol-save" type="submit">
                              <i class="fa-regular fa-floppy-disk"></i>
                              <strong>Simpan</strong>
                        </button>
                  </div>
            </form>
      </main>
      <script src="..\Js\Main.js"></script>
      <script src="..\Js\Admin_Tambah_User.js"></script>
</body>

</html>