<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: Admin_Login.php");
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
      <title>Halaman Dashboard Admin</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="..\CSS\Admin_Edit_Profil.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="edit-profil">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Edit Profil Admin</h2>
            </section>
            <div class="profile-admin">
                  <div class="foto-profile">
                        <?php if (!empty($user['image_profile_path'])): ?>
                        <div style="width: 7rem; height: 7rem; border-radius: 50%;">
                              <img src="<?php echo htmlspecialchars($user['image_profile_path']); ?>" alt="Foto Profil"
                                    id="open-modal-btn"
                                    style="cursor: pointer; width: 7rem; height: 7rem; border-radius: 50%;">
                        </div>
                        <?php else: ?>
                        <i class="fa-solid fa-circle-user" id="open-modal-btn"
                              style="cursor: pointer; font-size: 7rem;"></i>
                        <?php endif; ?>
                        <!-- The Modal -->
                        <div id="profile-modal" class="modal">
                              <!-- Modal content -->
                              <div class="modal-content">
                                    <span class="close" id="close-modal-btn">&times;</span>
                                    <h2>Upload Profile Image</h2>
                                    <form id="upload-form" action="Admin_Upload_Profile_Image.php" method="post"
                                          accept="jpg,jpeg,png" enctype="multipart/form-data">
                                          <input type="file" id="file-input" name="profile-image" accept="image/*">
                                          <button type="submit">Upload</button>
                                    </form>
                              </div>
                        </div>
                  </div>
                  <div class="username-status-admin">
                        <h2><?php echo !empty($user['username']) ? htmlspecialchars($user['username']) : '-'; ?>
                        </h2>
                        <div class="indikator-admin">
                              <span
                                    class="status-admin"><?php echo !empty($user['role']) ? htmlspecialchars($user['role']) : '-'; ?></span>
                        </div>
                  </div>
            </div>
            <form action="../PHP/Admin_Update_Data.php" method="post">
                  <div class="data-profile-admin">
                        <div>
                              <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Nama Lengkap" required
                                          value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>">
                              </div>
                              <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender">
                                          <option value="Laki-Laki"
                                                <?php if ($user['jenis_kelamin'] == 'Laki-Laki') echo 'selected'; ?>>
                                                Laki-Laki
                                          </option>
                                          <option value="Perempuan"
                                                <?php if ($user['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>
                                                Perempuan
                                          </option>
                                    </select>
                              </div>
                        </div>
                        <div>
                              <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email" required
                                          value="<?php echo htmlspecialchars($user['email']); ?>">
                              </div>
                              <div class="form-group">
                                    <label for="no-hp">No. Hp</label>
                                    <input type="number" id="no-hp" name="no-hp" placeholder="No. Telepon" required
                                          value="<?php echo htmlspecialchars($user['no_hp']); ?>" min="0">
                              </div>
                        </div>
                  </div>
                  <div class="tombol">
                        <a href="Admin_Profile.php">
                              <i class="fa-solid fa-x"></i>
                              <strong>Kembali</strong>
                        </a>
                        <button type="submit" class="tombol-simpan">
                              <i class="fa-regular fa-floppy-disk"></i>
                              <strong>Simpan</strong>
                        </button>
                  </div>
            </form>
      </main>
      <script src="..\Js\Main.js"></script>
      <script>
      // Get the modal
      var modal = document.getElementById('profile-modal');

      // Get the button that opens the modal
      var openModalBtn = document.getElementById('open-modal-btn');

      // Get the <span> element that closes the modal
      var closeModalBtn = document.getElementById('close-modal-btn');

      // When the user clicks on the button, open the modal
      openModalBtn.onclick = function() {
            modal.style.display = 'block';
      }

      // When the user clicks on <span> (x), close the modal
      closeModalBtn.onclick = function() {
            modal.style.display = 'none';
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
            if (event.target == modal) {
                  modal.style.display = 'none';
            }
      }
      </script>
</body>

</html>