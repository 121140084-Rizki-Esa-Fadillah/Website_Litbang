<?php
session_start();
include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: Admin_Hasil.php");
    exit();
}

$id = $_SESSION['id_user'];
$sql = "SELECT * FROM user WHERE id_user='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Jika tidak ada data pengguna ditemukan, redirect ke halaman login
    header("Location: Admin_Login.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Aside</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <header>
            <div class="logo_radar">
                  <img src="../../image/Logo_RADAR_Lampung.png" alt="Logo RADAR Lampung">
            </div>
            <div class="akun">
                  <i class="fa-solid fa-user"></i>
                  <span><?php echo !empty($user['username']) ? htmlspecialchars($user['username']) : '-'; ?></span>
                  <div class="dropdown">
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="dropdown-menu">
                              <a href="../PHP/Admin_Profile.php">Profil Admin</a>
                              <span onclick="confirmLogout(event)" style="cursor: pointer;">Logout</span>
                        </div>
                  </div>
            </div>
      </header>
      <aside>
            <div class="profile">
                  <?php if (!empty($user['image_profile_path'])): ?>
                  <div style="width: 5rem; height: 5rem; border-radius: 50%;">
                        <img src="<?php echo htmlspecialchars($user['image_profile_path']); ?>" alt="Foto Profil"
                              id="open-modal-btn"
                              style="cursor: pointer; width: 5rem; height: 5rem; border-radius: 50%;">
                  </div>
                  <?php else: ?>
                  <i class="fa-solid fa-circle-user"></i>
                  <?php endif; ?>
                  <div class="username-status">
                        <h3><?php echo !empty($user['username']) ? htmlspecialchars($user['username']) : '-'; ?></h3>
                        <div class="indikator">
                              <i class="fa-solid fa-circle"></i>
                              <span class="status">Online</span>
                        </div>
                  </div>
            </div>
            <nav>
                  <ul>
                        <li id="dashboard-menu">
                              <i class="fa-solid fa-house"></i>
                              <a href="../PHP/Admin_Dashboard.php">Dashboard</a>
                        </li>
                        <li id="survey-menu" class="survey-toggle">
                              <i class="fa-solid fa-chart-pie"></i>
                              <strong>Survey</strong>
                              <span class="material-symbols-outlined arrow">
                                    chevron_right
                              </span>
                        </li>
                        <div class="dropdown-survey">
                              <div class="survey-menu">
                                    <li id="tambah-survey">
                                          <div class="Tambah_Survey_Hal1">
                                                <span class="material-symbols-outlined">
                                                      list_alt_add
                                                </span>
                                                <a href="../PHP/Admin_Tambah_Survey_Hal1.php">Tambah Survey</a>
                                          </div>
                                    </li>
                                    <li id="hasil-survey">
                                          <div class="Hasil_Survey">
                                                <span class="material-symbols-outlined">
                                                      description
                                                </span>
                                                <a href="../PHP/Admin_Hasil_Survey.php">Hasil Survey</a>
                                          </div>
                                    </li>
                              </div>
                        </div>
                        <li id="user-menu" <?php if($user['role'] !== 'Admin') echo 'style="display: none;"'; ?>>
                              <i class="fa-solid fa-users-gear"></i>
                              <a href="../PHP/Admin_Manajemen_User.php">Manajemen User</a>
                        </li>
                  </ul>
            </nav>
      </aside>
      <!-- Notification -->
      <div id="notification" class="notification"></div>
</body>

</html>