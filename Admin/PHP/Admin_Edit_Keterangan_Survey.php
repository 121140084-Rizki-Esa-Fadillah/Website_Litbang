<?php
include "Koneksi_survei_litbang.php";

session_start(); // Start the session to use session variables

$error_message = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul = $_POST['judul-survey'];
    $keterangan = $_POST['keterangan'];
    $id_wilayah = $_POST['id_wilayah'];
    $image = $_FILES['upload-gambar']['name']; 
    $tmp = $_FILES['upload-gambar']['tmp_name']; 

    if ($image) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($image, PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error_message = "Format file tidak diperbolehkan.";
        } elseif ($_FILES['upload-gambar']['size'] > 2 * 1024 * 1024) {
            $error_message = "Ukuran file terlalu besar.";
        } else {
            $uploadDir = '../../image/';
            if (move_uploaded_file($tmp, $uploadDir . $image)) {
                $stmt = $conn->prepare("UPDATE survey SET title = ?, keterangan = ?, id_wilayah = ?, image = ? WHERE id = ?");
                $stmt->bind_param("ssisi", $judul, $keterangan, $id_wilayah, $image, $id);
            } else {
                $error_message = "Gagal meng-upload gambar.";
            }
        }
    } else {
        $stmt = $conn->prepare("UPDATE survey SET title = ?, keterangan = ?, id_wilayah = ? WHERE id = ?");
        $stmt->bind_param("ssis", $judul, $keterangan, $id_wilayah, $id);
    }

    if (empty($error_message) && $stmt->execute()) {
        $success = true;
    } else {
        $error_message = $stmt->error;
    }

    $stmt->close();
    mysqli_close($conn);

    if ($success) {
        // Set notification message in session
        $_SESSION['notification'] = "Data berhasil diperbarui.";
        header("Location: Admin_Hasil_Survey.php");
        exit();
    } else {
        echo '<script>
            alert("Gagal memperbarui data: ' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '");
            window.history.back();
        </script>';
        exit();
    }
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT title, keterangan, id_wilayah, image FROM survey WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $survey = $result->fetch_assoc();
    $stmt->close();
} else {
    echo '<script>
        alert("ID tidak valid.");
        window.location.href = "Admin_Hasil_Survey.php";
    </script>';
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Edit Survey</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Edit_Keterangan_Survey.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="analisis-survey">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Edit Survei</h2>
            </section>
            <div class="form-section">
                  <h2>Edit Data Survey</h2>
                  <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                        <label for="judul-survey">Judul Survey:</label>
                        <input type="text" id="judul-survey" name="judul-survey"
                              value="<?php echo htmlspecialchars($survey['title']); ?>" placeholder="..." required>

                        <label for="keterangan">Keterangan:</label>
                        <textarea id="keterangan" name="keterangan" placeholder="..."
                              required><?php echo htmlspecialchars($survey['keterangan']); ?></textarea>

                        <label for="sort">Pilih Wilayah :</label>
                        <select id="id_wilayah" name="id_wilayah" required>
                              <option value="1" <?php echo $survey['id_wilayah'] == 1 ? 'selected' : ''; ?>>Lampung
                                    Barat</option>
                              <option value="2" <?php echo $survey['id_wilayah'] == 2 ? 'selected' : ''; ?>>Tanggamus
                              </option>
                              <option value="3" <?php echo $survey['id_wilayah'] == 3 ? 'selected' : ''; ?>>Lampung
                                    Selatan</option>
                              <option value="4" <?php echo $survey['id_wilayah'] == 4 ? 'selected' : ''; ?>>Lampung
                                    Timur</option>
                              <option value="5" <?php echo $survey['id_wilayah'] == 5 ? 'selected' : ''; ?>>Lampung
                                    Tengah</option>
                              <option value="6" <?php echo $survey['id_wilayah'] == 6 ? 'selected' : ''; ?>>Lampung
                                    Utara</option>
                              <option value="7" <?php echo $survey['id_wilayah'] == 7 ? 'selected' : ''; ?>>Way Kanan
                              </option>
                              <option value="8" <?php echo $survey['id_wilayah'] == 8 ? 'selected' : ''; ?>>Tulang
                                    Bawang</option>
                              <option value="9" <?php echo $survey['id_wilayah'] == 9 ? 'selected' : ''; ?>>Pesawaran
                              </option>
                              <option value="10" <?php echo $survey['id_wilayah'] == 10 ? 'selected' : ''; ?>>Pringsewu
                              </option>
                              <option value="11" <?php echo $survey['id_wilayah'] == 11 ? 'selected' : ''; ?>>Mesuji
                              </option>
                              <option value="12" <?php echo $survey['id_wilayah'] == 12 ? 'selected' : ''; ?>>Tulang
                                    Bawang Barat</option>
                              <option value="13" <?php echo $survey['id_wilayah'] == 13 ? 'selected' : ''; ?>>Pesisir
                                    Barat</option>
                              <option value="14" <?php echo $survey['id_wilayah'] == 14 ? 'selected' : ''; ?>>Bandar
                                    Lampung</option>
                              <option value="15" <?php echo $survey['id_wilayah'] == 15 ? 'selected' : ''; ?>>Kota Metro
                              </option>
                        </select>

                        <label for="upload-gambar">Upload Gambar (Optional):</label>
                        <div class="upload-section">
                              <div class="upload-box">
                                    <img src="<?php echo '../../image/' . htmlspecialchars($survey['image']); ?>" alt=""
                                          id="upload-image">
                                    <input type="file" id="upload-gambar" name="upload-gambar"
                                          accept="image/jpeg, image/png">
                              </div>
                        </div>

                        <div class="tombol">
                              <a href="Admin_Hasil_Survey.php" class="tombol-cancel">
                                    <i class="fa-solid fa-x"></i>
                                    <strong>Kembali</strong>
                              </a>
                              <button class="tombol-save">
                                    <i class="fa-regular fa-floppy-disk"></i>
                                    <strong>Simpan</strong>
                              </button>
                        </div>
                  </form>
            </div>
      </main>

      <!-- JavaScript untuk mengganti gambar saat gambar baru diunggah -->
      <script>
      document.getElementById('upload-gambar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                        document.getElementById('upload-image').src = e.target.result;
                  }
                  reader.readAsDataURL(file);
            }
      });
      </script>
      <script src="..\Js\Main.js"></script>
</body>

</html>