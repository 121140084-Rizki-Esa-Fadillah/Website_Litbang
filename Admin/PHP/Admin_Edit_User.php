<?php
session_start();

include('Koneksi_user_litbang.php');

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pengguna dari database berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM user WHERE id_user= ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $nama_lengkap = $_POST['fullname'];
            $jenis_kelamin = $_POST['gender'];
            $email = $_POST['email'];
            $no_hp = $_POST['no-hp'];
            $password = $_POST['password'];
            $role = $_POST['roles'];
        
            // Update data pengguna berdasarkan ID
            $stmt = $conn->prepare("UPDATE user SET username = ?, nama_lengkap = ?, jenis_kelamin = ?, email = ?, no_hp = ?, password = ?, role = ? WHERE id_user = ?");
            $stmt->bind_param('sssssssi', $username, $nama_lengkap, $jenis_kelamin, $email, $no_hp, $password, $role, $id);
        
            if ($stmt->execute()) {
                // Redirect ke halaman manajemen user setelah update berhasil
                $_SESSION['notification'] = "Berhasil memperbaharui data pengguna.";
                header("Location: Admin_Manajemen_User.php");
                exit();
            } else {
                  $_SESSION['notification'] = "Gagal memperbaharui data pengguna..";
                  header("Location: Admin_Manajemen_User.php");
                exit();
            }
        }
    } else {
        // Jika tidak ada data pengguna ditemukan, redirect ke halaman manajemen pengguna
        header("Location: Admin_Manajemen_User.php");
        exit();
    }

    // Tutup statement
    $stmt->close();
} else {
    // Redirect jika ID tidak ditemukan
    header("Location: Admin_Manajemen_User.php");
    exit();
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
      <link rel="stylesheet" href="../CSS/Admin_Edit_User.css">
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
                  <h2>Edit Data User</h2>
            </section>
            <div class="header-edit-user">
                  <h2>Edit Data User</h2>
            </div>
            <form method="post">
                  <div class="data-profile-user">
                        <div>
                              <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Masukkan Nama"
                                          required value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>">
                              </div>
                              <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Username" required
                                          value="<?php echo htmlspecialchars($user['username']); ?>">
                              </div>
                              <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select id="gender" name="gender">
                                          <option value="Laki-Laki"
                                                <?php if ($user['jenis_kelamin'] == 'Laki-Laki') echo 'selected'; ?>>
                                                Laki - Laki
                                          </option>
                                          <option value="Perempuan"
                                                <?php if ($user['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>
                                                Perempuan
                                          </option>
                                    </select>
                              </div>
                              <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="user123@gmail.com" required
                                          value="<?php echo htmlspecialchars($user['email']); ?>">
                              </div>
                              <div class="form-group">
                                    <label for="no-hp">No. Hp</label>
                                    <input type="number" id="no-hp" name="no-hp" placeholder="0812xxxxxxxx" required
                                          value="<?php echo htmlspecialchars($user['no_hp']); ?>">
                              </div>
                              <div class="form-group password-field">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="********" required
                                          value="<?php echo htmlspecialchars($user['password']); ?>">
                                    <i class="fa-solid fa-eye" id="toggle-password" onclick="togglePassword()"></i>
                              </div>
                              <div class="form-group">
                                    <div class="roles">
                                          <label for="roles">Roles</label>
                                          <input type="radio" id="admin" name="roles" value="Admin"
                                                <?php echo ($user['role'] === 'Admin') ? 'checked' : ''; ?>>
                                          <label for="admin">Admin</label>
                                          <input type="radio" id="user" name="roles" value="User"
                                                <?php echo ($user['role'] === 'User') ? 'checked' : ''; ?>>
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
      <script>
      function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password');
            if (passwordField.type === 'password') {
                  passwordField.type = 'text';
                  toggleIcon.classList.remove('fa-eye');
                  toggleIcon.classList.add('fa-eye-slash');
            } else {
                  passwordField.type = 'password';
                  toggleIcon.classList.remove('fa-eye-slash');
                  toggleIcon.classList.add('fa-eye');
            }
      }
      </script>
</body>

</html>