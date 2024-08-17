<?php
session_start();

include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id'])) {
    header("Location: Admin_Login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
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
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Registered</th>
                                    <th>Last Login</th>
                                    <th>Roles</th>
                                    <th>Activity</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php 
                              $no = 1;
                              foreach ($users as $user):
                              ?>
                              <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['nama_lengkap']); ?></td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['jenis_kelamin']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['no_hp']); ?></td>
                                    <td><?php echo htmlspecialchars($user['registered']); ?></td>
                                    <td><?php echo htmlspecialchars($user['last_login']); ?></td>
                                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    <td>
                                          <div class="action-buttons">
                                                <a href="Admin_Edit_User.php?id=<?php echo $user['id']; ?>" class="tombol-edit">
                                                      <i class="fa fa-edit"></i>Edit
                                                </a>
                                                <a href="Admin_Delete_User.php?id=<?php echo $user['id']; ?>">
                                                      <button class="tombol-hapus-user">
                                                            <i class="fa fa-trash"></i>Delete
                                                      </button>

                                                </a>
                                          </div>
                                    </td>
                              </tr>
                              <?php endforeach; ?>
                        </tbody>
                  </table>
            </div>
      </main>
      <script src="..\Js\Main.js"></script>
</body>

</html>