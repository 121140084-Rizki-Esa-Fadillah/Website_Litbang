<?php
include "Koneksi_survei_litbang.php";

// Ambil nilai pencarian, pengurutan, dan penghapusan dari parameter GET/POST
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$delete_id = isset($_POST['delete_id']) ? (int)$_POST['delete_id'] : 0;

// Hapus survei jika ada ID penghapusan
if ($delete_id > 0) {
    // Mulai transaksi
    $conn->begin_transaction();
    try {
        // Hapus dari tabel survey
        $delete_survey_sql = "DELETE FROM survey WHERE id = ?";
        $stmt = $conn->prepare($delete_survey_sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();
        
        // Hapus data terkait dari tabel gender
        $delete_gender_sql = "DELETE FROM gender WHERE id = ?";
        $stmt = $conn->prepare($delete_gender_sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();

        // Hapus data terkait dari tabel lulusan
        $delete_lulusan_sql = "DELETE FROM lulusan WHERE id = ?";
        $stmt = $conn->prepare($delete_lulusan_sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();

        // Hapus data terkait dari tabel profesi
        $delete_profesi_sql = "DELETE FROM profesi WHERE id = ?";
        $stmt = $conn->prepare($delete_profesi_sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();

        // Hapus data terkait dari tabel usia
        $delete_usia_sql = "DELETE FROM usia WHERE id = ?";
        $stmt = $conn->prepare($delete_usia_sql);
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();

        // Commit transaksi
        $conn->commit();
        
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh halaman
        exit();
    } catch (Exception $e) {
        // Rollback jika ada kesalahan
        $conn->rollback();
        echo "Failed: " . $e->getMessage();
    }
}

// Query untuk mengambil data dari tabel survey dan wilayah
$sql = "SELECT survey.id, survey.title, survey.keterangan, survey.image, survey.waktu_buat, wilayah.nama_wilayah
        FROM survey
        JOIN wilayah ON survey.id_wilayah = wilayah.id
        WHERE survey.title LIKE ?";

// Tambahkan sorting jika ada
if ($sort) {
    $sql .= " AND wilayah.nama_wilayah = ?";
}
$sql .= " ORDER BY survey.title ASC"; // Atur pengurutan default

$stmt = $conn->prepare($sql);

// Binding parameter pencarian
$search_param = "%" . $search . "%";
if ($sort) {
    $stmt->bind_param("ss", $search_param, $sort);
} else {
    $stmt->bind_param("s", $search_param);
}

$stmt->execute();
$result = $stmt->get_result();

$surveys = [];
if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        // Format tanggal pembuatan jika diperlukan
        $row['formatted_date'] = date('d F Y', strtotime($row['waktu_buat']));
        $surveys[] = $row;
    }
} else {
    $surveys = [];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Hasil Survey</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Hasil_Survey.css">
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="hasil-survey">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Hasil Survey</h2>
            </section>
            <div class="judul-container">
                  <div class="search">
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
                  </div>
                  <div class="sort-box">
                        <label for="sort">Sorting :</label>
                        <div class="select-container">
                              <form method="GET" action="">
                                    <select id="sort" name="sort" onchange="this.form.submit()">
                                          <option value="">-- Pilih Wilayah --</option>
                                          <option value="Lampung Barat"
                                                <?php if ($sort == 'Lampung Barat') echo 'selected'; ?>>Lampung Barat
                                          </option>
                                          <option value="Tanggamus" <?php if ($sort == 'Tanggamus') echo 'selected'; ?>>
                                                Tanggamus</option>
                                          <option value="Lampung Selatan"
                                                <?php if ($sort == 'Lampung Selatan') echo 'selected'; ?>>Lampung
                                                Selatan
                                          </option>
                                          <option value="Lampung Timur"
                                                <?php if ($sort == 'Lampung Timur') echo 'selected'; ?>>Lampung Timur
                                          </option>
                                          <option value="Lampung Tengah"
                                                <?php if ($sort == 'Lampung Tengah') echo 'selected'; ?>>Lampung Tengah
                                          </option>
                                          <option value="Lampung Utara"
                                                <?php if ($sort == 'Lampung Utara') echo 'selected'; ?>>Lampung Utara
                                          </option>
                                          <option value="Way Kanan" <?php if ($sort == 'Way Kanan') echo 'selected'; ?>>
                                                Way Kanan</option>
                                          <option value="Tulang Bawang"
                                                <?php if ($sort == 'Tulang Bawang') echo 'selected'; ?>>Tulang Bawang
                                          </option>
                                          <option value="Pesawaran" <?php if ($sort == 'Pesawaran') echo 'selected'; ?>>
                                                Pesawaran</option>
                                          <option value="Pringsewu" <?php if ($sort == 'Pringsewu') echo 'selected'; ?>>
                                                Pringsewu</option>
                                          <option value="Mesuji" <?php if ($sort == 'Mesuji') echo 'selected'; ?>>Mesuji
                                          </option>
                                          <option value="Tulang Bawang Barat"
                                                <?php if ($sort == 'Tulang Bawang Barat') echo 'selected'; ?>>Tulang
                                                Bawang Barat</option>
                                          <option value="Pesisir Barat"
                                                <?php if ($sort == 'Pesisir Barat') echo 'selected'; ?>>Pesisir Barat
                                          </option>
                                          <option value="Bandar Lampung"
                                                <?php if ($sort == 'Bandar Lampung') echo 'selected'; ?>>Bandar Lampung
                                          </option>
                                          <option value="Metro" <?php if ($sort == 'Metro') echo 'selected'; ?>>Kota
                                                Metro</option>
                                    </select>
                                    <span class="material-symbols-outlined arrow-select">keyboard_arrow_up</span>
                              </form>
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
                        // Mengatur path gambar sesuai dengan struktur direktori Anda
                        $imagePath = '../../image/' . $survey['image']; // Misalnya, path relatif ke folder 'image'
                    
                        // Memastikan gambar ada dan dapat diakses
                        if (file_exists($imagePath)) {
                            // Output gambar dengan format yang benar
                            echo '<div class="img"><img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($survey['title']) . '"></div>';
                        } else {
                            echo '<div class="img">Image not found</div>';
                        }
                    } else {
                        echo '<div class="img">No Image</div>';
                    }
                    
                    echo '<div class="ket">';
                    echo '<p>' . htmlspecialchars($survey['keterangan']) . '</p>';
                    echo '<p class="wilayah">Wilayah Pelaksanaan Survei :</p>';
                    echo '<p>' . htmlspecialchars($survey['nama_wilayah']) . '</p>';
                    echo '<div class="ket-action">';
                    echo '<div class="tanggal">';
                    echo '<span class="material-symbols-outlined">schedule</span>';
                    echo '<p>Radar Litbang, ' . htmlspecialchars($survey['formatted_date']) . '</p>';
                    echo '</div>';
                    echo '<div class="action-buttons">';
                    echo '<a href="Admin_Edit_Keterangan_Survey.php?id=' . $survey['id'] . '" class="tombol-edit">';
                    echo '<i class="fa fa-edit"></i>Edit';
                    echo '</a>';
                    echo '<button class="tombol-hapus-survey" onclick="confirmDelete(' . $survey['id'] . ')">';
                    echo '<i class="fa fa-trash"></i>Delete';
                    echo '</button>';
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
      <script src="..\Js\Main.js"></script>
      <script>
      function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this survey?')) {
                  // Create a form dynamically and submit it to handle deletion
                  const form = document.createElement('form');
                  form.method = 'POST';
                  form.action = '<?php echo $_SERVER['PHP_SELF']; ?>'; // Action to the same file
                  const input = document.createElement('input');
                  input.type = 'hidden';
                  input.name = 'delete_id';
                  input.value = id;
                  form.appendChild(input);
                  document.body.appendChild(form);
                  form.submit();
            }
      }
      </script>
</body>

</html>