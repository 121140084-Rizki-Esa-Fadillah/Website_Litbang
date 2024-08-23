<?php
include "Koneksi_survei_litbang.php";
session_start(); 

// Ambil nilai pencarian dan pengurutan dari parameter GET
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Query untuk menghitung total survei sesuai kriteria pencarian dan pengurutan
$count_sql = "SELECT COUNT(*) as total_surveys
              FROM survey
              JOIN wilayah ON survey.id_wilayah = wilayah.id
              WHERE survey.title LIKE ?";

// Parameter untuk query counting
$count_params = [];
$count_types = "s";
$count_params[] = "%" . $search . "%";

if ($sort) {
    $count_sql .= " AND wilayah.nama_wilayah = ?";
    $count_types .= "s";
    $count_params[] = $sort;
}

$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param($count_types, ...$count_params);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_surveys = $count_result->fetch_assoc()['total_surveys'];

// Query untuk mengambil survei
$sql = "SELECT survey.id, survey.title, survey.keterangan, survey.image, survey.waktu_buat, wilayah.nama_wilayah
        FROM survey
        JOIN wilayah ON survey.id_wilayah = wilayah.id
        WHERE survey.title LIKE ?";

$params = [];
$types = "s";
$params[] = "%" . $search . "%";

if ($sort) {
    $sql .= " AND wilayah.nama_wilayah = ?";
    $types .= "s";
    $params[] = $sort;
}

// Jika tidak ada pencarian dan pengurutan, ambil hanya survei terbaru
if (empty($search) && empty($sort)) {
    $sql .= " ORDER BY survey.waktu_buat DESC LIMIT 1";
} else {
    $sql .= " ORDER BY survey.waktu_buat DESC"; // Tampilkan semua hasil yang sesuai
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$surveys = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['formatted_date'] = date('d F Y', strtotime($row['waktu_buat']));
        $surveys[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dashboard Admin</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Dashboard.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <!-- Konten Dashboard -->
            <section id="dashboard">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Dashboard</h2>
            </section>
            <div class="dashboard_admin">
                  <div class="judul_dashboard">
                        <h2>Selamat Datang,</h2>
                        <h3>Admin Litbang Radar Lampung</h3>
                        <ul>
                              <li>
                                    Anda dapat mengelola survei dan melihat analisis data di sini.
                                    Pastikan untuk memperbarui informasi secara berkala.
                              </li>
                              <li>
                                    Teruslah memantau hasil survei dan analisis untuk memastikan kualitas data yang
                                    maksimal.
                              </li>
                        </ul>
                  </div>

                  <div class="total-survey">
                        <div class="total-survey-box">
                              <i class="fa-solid fa-file-lines"></i>
                              <div class="total">
                                    <span><?php echo htmlspecialchars($total_surveys); ?></span>
                                    <!-- Total survei dari query count -->
                                    <h3>Total Survey</h3>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="cari-container">
                  <h3>Cari Hasil Survey</h3><br>
                  <div class="search-sort-container">
                        <div class="search-box">
                              <form method="GET" action="">
                                    <div class="search-container">
                                          <input type="text" name="search" placeholder="Search..."
                                                value="<?php echo htmlspecialchars($search); ?>">
                                          <button type="submit">
                                                <i class="fa fa-search"></i>
                                          </button>
                                    </div>
                              </form>
                        </div>
                        <div class="sort-box">
                              <label for="sort">Sorting :</label>
                              <div class="select-container">
                                    <form method="GET" action="">
                                          <select id="sort" name="sort" onchange="this.form.submit()">
                                                <option value="">-- Pilih Wilayah --</option>
                                                <option value="Lampung Barat"
                                                      <?php if ($sort == 'Lampung Barat') echo 'selected'; ?>>
                                                      Lampung Barat</option>
                                                <option value="Tanggamus"
                                                      <?php if ($sort == 'Tanggamus') echo 'selected'; ?>>Tanggamus
                                                </option>
                                                <option value="Lampung Selatan"
                                                      <?php if ($sort == 'Lampung Selatan') echo 'selected'; ?>>
                                                      Lampung Selatan</option>
                                                <option value="Lampung Timur"
                                                      <?php if ($sort == 'Lampung Timur') echo 'selected'; ?>>
                                                      Lampung Timur</option>
                                                <option value="Lampung Tengah"
                                                      <?php if ($sort == 'Lampung Tengah') echo 'selected'; ?>>
                                                      Lampung Tengah</option>
                                                <option value="Lampung Utara"
                                                      <?php if ($sort == 'Lampung Utara') echo 'selected'; ?>>
                                                      Lampung Utara</option>
                                                <option value="Way Kanan"
                                                      <?php if ($sort == 'Way Kanan') echo 'selected'; ?>>Way
                                                      Kanan</option>
                                                <option value="Tulang Bawang"
                                                      <?php if ($sort == 'Tulang Bawang') echo 'selected'; ?>>
                                                      Tulang Bawang</option>
                                                <option value="Pesawaran"
                                                      <?php if ($sort == 'Pesawaran') echo 'selected'; ?>>Pesawaran
                                                </option>
                                                <option value="Pringsewu"
                                                      <?php if ($sort == 'Pringsewu') echo 'selected'; ?>>
                                                      Pringsewu</option>
                                                <option value="Mesuji" <?php if ($sort == 'Mesuji') echo 'selected'; ?>>
                                                      Mesuji
                                                </option>
                                                <option value="Tulang Bawang Barat"
                                                      <?php if ($sort == 'Tulang Bawang Barat') echo 'selected'; ?>>
                                                      Tulang Bawang Barat</option>
                                                <option value="Pesisir Barat"
                                                      <?php if ($sort == 'Pesisir Barat') echo 'selected'; ?>>
                                                      Pesisir Barat</option>
                                                <option value="Bandar Lampung"
                                                      <?php if ($sort == 'Bandar Lampung') echo 'selected'; ?>>
                                                      Bandar Lampung</option>
                                                <option value="Metro" <?php if ($sort == 'Metro') echo 'selected'; ?>>
                                                      Kota Metro
                                                </option>
                                          </select>
                                          <span class="material-symbols-outlined arrow-select">
                                                keyboard_arrow_up
                                          </span>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="hasil">
                  <?php
            if (!empty($surveys)) {
                foreach ($surveys as $survey) {
                    echo '<div class="survey-item">';
                    echo '<a href="Admin_Detail_Hasil_Survey.php?id=' . $survey['id'] . '" class="survey-title">';
                    echo '<h3>' . htmlspecialchars($survey['title']) . '</h3>';
                    echo '</a>';
                    echo '<div class="hasil-container">';
                    if (!empty($survey['image'])) {
                        $imagePath = '../../image/' . $survey['image'];
                        if (file_exists($imagePath)) {
                            echo '<div class="img"><img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($survey['title']) . '"></div>';
                        } else {
                            echo '<div class="img">Image not found</div>';
                        }
                    } else {
                        echo '<div class="img">No Image</div>';
                    }

                    echo '<div class="ket">';
                    $description = htmlspecialchars($survey['keterangan']);
                    $maxLength = 200;

                    // Memotong keterangan jika melebihi batas panjang
                    $truncatedDescription = (strlen($description) > $maxLength) ? substr($description, 0, $maxLength) . '...' : $description;

                    echo '<p>' . $truncatedDescription . '</p>';
                    echo '<p class="wilayah">Wilayah Pelaksanaan Survei :</p>';
                    echo '<p>' . htmlspecialchars($survey['nama_wilayah']) . '</p>';
                    echo '<div class="ket-action">';
                    echo '<div class="tanggal">';
                    echo '<span class="material-symbols-outlined">schedule</span>';
                    echo '<p>Radar Litbang, ' . htmlspecialchars($survey['formatted_date']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No surveys found.</p>';
            }
            ?>
            </div>
      </main>
      <script src="../Js/Main.js"></script>
      <script>
      // Initialize links
      document.querySelectorAll("nav ul li a").forEach(link => {
            link.addEventListener("click", function() {
                  setActiveLink(this);
            });
      });

      // Function to set the active link in the sidebar
      function setActiveLink(link) {
            document.querySelectorAll("nav ul li").forEach(li => {
                  li.classList.remove("active");
            });
            if (link) {
                  link.parentElement.classList.add("active");
            }
      }
      </script>
</body>

</html>