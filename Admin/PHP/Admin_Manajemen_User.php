<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Manajemen User</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Manajemen_User.css">
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="manajemen-user">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Manajemen User</h2>
            </section>
            <div class="tambah-user-button">
                  <a href="Admin_Tambah_User.php" class="tombol-tambah-user">
                        <i class="fa fa-plus"></i> Tambah User
                  </a>
            </div>
            <div class="search-sort-container">
                  <div class="search-box">
                        <input type="text" placeholder="Search...">
                        <button>
                              <i class="fa fa-search"></i>
                        </button>
                  </div>
                  <div class="sort-box">
                        <label for="sort">Sorting :</label>
                        <select id="sort">
                              <option value="name-asc">Name Ascending</option>
                              <option value="name-desc">Name Descending</option>
                              <option value="date-asc">Date Ascending</option>
                              <option value="date-desc">Date Descending</option>
                        </select>
                  </div>
            </div>
            <div class="table-container">
                  <table>
                        <thead>
                              <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Registered</th>
                                    <th>Last Visit</th>
                                    <th>Roles</th>
                                    <th>Activity</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    <td>123</td>
                                    <td>Ucup Sentosa</td>
                                    <td>User123</td>
                                    <td>Laki-laki</td>
                                    <td>User@gmail.com</td>
                                    <td>08********</td>
                                    <td>2024-11-12</td>
                                    <td>2025-03-01</td>
                                    <td>Admin</td>
                                    <td>
                                          <div class="action-buttons">
                                                <a href="Admin_Edit_User.php" class="tombol-edit">
                                                      <i class="fa fa-edit"></i>Edit
                                                </a>
                                                <button class="tombol-hapus-user">
                                                      <i class="fa fa-trash"></i>Delete
                                                </button>
                                          </div>
                                    </td>
                              </tr>
                              <!-- Additional rows can be added here -->
                        </tbody>
                  </table>
            </div>
      </main>
      <script src="..\Js\Main.js"></script>
</body>

</html>