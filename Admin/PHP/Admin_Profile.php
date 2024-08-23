<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: Admin_Login.php");
    exit();
}

$id = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Jika tidak ada data pengguna ditemukan, redirect ke halaman login
    header("Location: Admin_Login.php");
    exit();
}

// Tutup statement dan koneksi
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
      <link rel="stylesheet" href="../CSS/Admin_Profile.css">
      <link rel="stylesheet" href="../CSS/notification.css">
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
                  <h2>Profil Admin</h2>
            </section>
            <?php include('notification.php'); ?>
            <div class="profile-admin">
                  <div class="foto-profile">
                        <?php if (!empty($user['image_profile_path'])): ?>
                        <div style="width: 7rem; height: 7rem; border-radius: 50%;">
                              <img src="<?php echo htmlspecialchars($user['image_profile_path']); ?>" alt="Foto Profil"
                                    id="open-modal-btn"
                                    style="cursor: pointer; width: 7rem; height: 7rem; border-radius: 50%;">
                        </div>
                        <?php else: ?>
                        <i class="fa-solid fa-circle-user"></i>
                        <?php endif; ?>
                  </div>
                  <div class="username-status-admin">
                        <h2><?php echo !empty($user['username']) ? htmlspecialchars($user['username']) : '-'; ?></h2>
                        <div class="indikator-admin">
                              <span
                                    class="status-admin"><?php echo !empty($user['role']) ? htmlspecialchars($user['role']) : '-'; ?></span>
                        </div>
                  </div>
            </div>
            <div class="data-profile-admin">
                  <div>
                        <div class="nama-admin data">
                              <strong class="sub-judul">Nama Lengkap</strong>
                              <p class="value">
                                    <?php echo !empty($user['nama_lengkap']) ? htmlspecialchars($user['nama_lengkap']) : '-'; ?>
                              </p>
                        </div>
                        <div class="jenis-kelamin-admin data">
                              <strong class="sub-judul">Jenis Kelamin</strong>
                              <p class="value">
                                    <?php echo !empty($user['jenis_kelamin']) ? htmlspecialchars($user['jenis_kelamin']) : '-'; ?>
                              </p>
                        </div>
                        <div class="password-admin data">
                              <strong class="sub-judul">Password</strong>
                              <div class="value-password">
                                    <p id="password-value">*********</p>
                                    <span class="material-symbols-outlined toggle-password"
                                          id="toggle-password">visibility_off</span>
                                    <a href="Admin_Edit_Password.php" id="edit-password">Edit</a>
                              </div>
                        </div>
                  </div>
                  <div>
                        <div class="email-admin data">
                              <strong class="sub-judul">Email</strong>
                              <p class="value">
                                    <?php echo !empty($user['email']) ? htmlspecialchars($user['email']) : '-'; ?>
                              </p>
                        </div>
                        <div class="no-telp-admin data">
                              <strong class="sub-judul">No. Hp</strong>
                              <p class="value">
                                    <?php echo !empty($user['no_hp']) ? htmlspecialchars($user['no_hp']) : '-'; ?>
                              </p>
                        </div>
                  </div>
            </div>
            <div class="edit">
                  <a href="../PHP/Admin_Edit_Profile.php">
                        <span class="material-symbols-outlined">
                              edit_square
                        </span>
                        <strong>Edit</strong>
                  </a>
            </div>
      </main>
      <script>
      document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordElement = document.getElementById('password-value');
            const togglePassword = document.getElementById('toggle-password');
            const isPasswordHidden = passwordElement.textContent === '*********';

            if (isPasswordHidden) {
                  // Jika password tersembunyi, tampilkan
                  passwordElement.textContent = '<?php echo htmlspecialchars($user['password']); ?>';
                  togglePassword.textContent = 'visibility'; // Ubah ikon menjadi mata terbuka
            } else {
                  // Jika password terlihat, sembunyikan
                  passwordElement.textContent = '*********';
                  togglePassword.textContent = 'visibility_off'; // Ubah ikon menjadi mata tertutup
            }

      });
      </script>
      <script src="..\Js\Main.js"></script>
      <script src="..\Js\notification.js"></script>
</body>

</html>