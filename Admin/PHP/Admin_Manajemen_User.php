<?php
session_start();
include('Koneksi_user_litbang.php');

if (!isset($_SESSION['id_user'])) {
    header("Location: Admin_Login.php");
    exit();
}

$id = $_SESSION['id_user'];
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name-asc'; // Default sort by name ascending
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Limit items per page
$offset = ($page - 1) * $limit; // Calculate the offset

// Sorting logic
switch ($sort) {
    case 'name-asc':
        $order_by = "ORDER BY nama_lengkap ASC";
        break;
    case 'name-desc':
        $order_by = "ORDER BY nama_lengkap DESC";
        break;
    case 'date-asc':
        $order_by = "ORDER BY registered ASC";
        break;
    case 'date-desc':
        $order_by = "ORDER BY registered DESC";
        break;
    default:
        $order_by = "ORDER BY id ASC"; // Default sort
}

// SQL query with search, sorting, and pagination
if ($search != '') {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM user WHERE nama_lengkap LIKE ? $order_by LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search . "%";
    $stmt->bind_param('sii', $search_param, $limit, $offset);
} else {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM user $order_by LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $limit, $offset);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $users = [];
}

// Calculate total pages
$result_total = $conn->query("SELECT FOUND_ROWS() as total");
$total_rows = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

$stmt->close();
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
      <link rel="stylesheet" href="../CSS/notification.css">
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
                  <form method="GET" action="">
                        <div class="search-box">
                              <input type="text" name="search" placeholder="Search..."
                                    value="<?php echo htmlspecialchars($search); ?>">
                              <button type="submit">
                                    <i class="fa fa-search"></i>
                              </button>
                        </div>
                  </form>

                  <div class="sort-box">
                        <label for="sort">Sorting :</label>
                        <form method="GET" action="">
                              <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                              <select id="sort" name="sort" onchange="this.form.submit()">
                                    <option value="name-asc" <?php if ($sort == 'name-asc') echo 'selected'; ?>>Nama A -
                                          Z
                                    </option>
                                    <option value="name-desc" <?php if ($sort == 'name-desc') echo 'selected'; ?>>Nama
                                          Z - A</option>
                                    <option value="date-asc" <?php if ($sort == 'date-asc') echo 'selected'; ?>>Tanggal
                                          Terlama</option>
                                    <option value="date-desc" <?php if ($sort == 'date-desc') echo 'selected'; ?>>
                                          Tanggal Terbaru</option>
                              </select>
                        </form>
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
                    $no = $offset + 1; // Adjust numbering according to the current page
                    foreach ($users as $user):
                    ?>
                              <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($user['id_user']); ?></td>
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
                                                <a href="Admin_Edit_User.php?id=<?php echo $user['id_user']; ?>"
                                                      class="tombol-edit">
                                                      <i class="fa fa-edit"></i>Edit
                                                </a>
                                                <a href="Admin_Delete_User.php?id=<?php echo $user['id_user']; ?>"
                                                      class="tombol-hapus-user"
                                                      onclick="return confirmDelete(<?php echo $user['id_user']; ?>)">
                                                      <i class="fa fa-trash"></i>Delete
                                                </a>
                                          </div>
                                    </td>
                              </tr>
                              <?php endforeach; ?>
                        </tbody>
                  </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                  <?php if ($page > 1): ?>
                  <a
                        href="?search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&page=<?php echo $page - 1; ?>">&laquo;
                        Previous</a>
                  <?php endif; ?>

                  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <a href="?search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&page=<?php echo $i; ?>"
                        class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                  </a>
                  <?php endfor; ?>

                  <?php if ($page < $total_pages): ?>
                  <a
                        href="?search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&page=<?php echo $page + 1; ?>">Next
                        &raquo;</a>
                  <?php endif; ?>
            </div>
            <?php include('notification.php'); ?>
      </main>
      <script src="..\Js\Main.js"></script>
      <script src="..\Js\notification.js"></script>
      <script>
      function confirmDelete(userId) {
            // Show confirmation dialog
            return confirm("Apakah Anda Yakin Ingin Menghapus Data Ini?");
      }
      </script>
</body>

</html>