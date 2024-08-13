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
            <form>
                  <div class="data-profile-user">
                        <div>
                              <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Masukkan Nama">
                              </div>
                              <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Username">
                              </div>
                              <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select id="gender" name="gender">
                                          <option value="male">Laki - Laki</option>
                                          <option value="female">Perempuan</option>
                                    </select>
                              </div>
                              <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="user123@gmail.com">
                              </div>
                              <div class="form-group">
                                    <label for="no-hp">No. Hp</label>
                                    <input type="number" id="no-hp" name="no-hp" placeholder="0812xxxxxxxx">
                              </div>
                              <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="********">
                              </div>
                              <div class="form-group">
                                    <label for="confirm.password">Confirm Password</label>
                                    <input type="password" id="password" name="password" placeholder="********">
                              </div>
                              <div class="form-group">

                                    <div class="roles">
                                          <label for="roles">Roles</label>
                                          <input type="radio" id="admin" name="roles" placeholder="admin">
                                          <label for="admin">Admin</label>
                                          <input type="radio" id="user" name="roles" placeholder="user">
                                          <label for="user">User</label>
                                    </div>
                              </div>
                        </div>
                  </div>
            </form>
            <div class="tombol">
                  <a href="Admin_Manajemen_User.php" class="tombol-cancel">
                        <i class="fa-solid fa-x"></i>
                        <strong>Batal</strong>
                  </a>
                  <button class="tombol-save">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <strong>Simpan</strong>
                  </button>
            </div>
      </main>
      <script src="..\Js\Main.js"></script>
</body>

</html>