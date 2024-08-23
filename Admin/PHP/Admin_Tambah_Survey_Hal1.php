<?php
include "Koneksi_survei_litbang.php";
session_start();  // Memastikan session dimulai jika belum dimulai

// Ambil data dari session jika tersedia
$judulSurvey = isset($_SESSION['judul-survey']) ? htmlspecialchars($_SESSION['judul-survey'], ENT_QUOTES, 'UTF-8') : '';
$keterangan = isset($_SESSION['keterangan']) ? htmlspecialchars($_SESSION['keterangan'], ENT_QUOTES, 'UTF-8') : '';
$idWilayah = isset($_SESSION['id_wilayah']) ? htmlspecialchars($_SESSION['id_wilayah'], ENT_QUOTES, 'UTF-8') : '';
$imagePreview = isset($_SESSION['image']) ? '../../image/' . $_SESSION['image'] : '../../image/upload_foto.png';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (empty($_POST['judul-survey']) || empty($_POST['keterangan']) || empty($_POST['id_wilayah'])) {
        echo "<script>alert('Semua field harus diisi.'); window.location.href='Admin_Tambah_Survey_Hal1.php';</script>";
        exit();
    }
    $_SESSION['judul-survey'] = htmlspecialchars(trim($_POST['judul-survey']));
    $_SESSION['keterangan'] = htmlspecialchars(trim($_POST['keterangan']));
    $_SESSION['id_wilayah'] = htmlspecialchars(trim($_POST['id_wilayah']));

    // Validasi dan proses upload gambar
    $image = $_FILES['upload-gambar']['name'];
    $tmp = $_FILES['upload-gambar']['tmp_name'];
    $imageSize = $_FILES['upload-gambar']['size'];
    $imageType = $_FILES['upload-gambar']['type'];
    $defaultImage = 'image_default.jpg';

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!empty($image)) {
        if (in_array($imageType, $allowedTypes) && $imageSize <= $maxSize) {
            $uploadDir = '../../image/';
            
            // Pastikan direktori upload ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $uploadFile = $uploadDir . basename($image);

            // Validasi upload gambar
            if (move_uploaded_file($tmp, $uploadFile)) {
                $_SESSION['image'] = $image;
            } else {
                echo "<script>alert('Gagal mengunggah gambar. Silakan coba lagi.'); window.location.href='Admin_Tambah_Survey_Hal1.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Jenis file tidak didukung atau ukuran file terlalu besar.'); window.location.href='Admin_Tambah_Survey_Hal1.php';</script>";
            exit();
        }
    } else {
        $_SESSION['image'] = $defaultImage;
    }

    // Redirect ke halaman berikutnya
    header('Location: Admin_Tambah_Survey_Hal2.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tambah Survey</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Tambah_Survey_Hal1.css">
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
                  <h2>Tambah Survei</h2>
            </section>
            <div class="form-section">
                  <h2>Tambah Data Survey</h2>
                  <form action="../php/Admin_Tambah_Survey_Hal1.php" method="post" enctype="multipart/form-data">
                        <!-- Pastikan variabel id sudah diset dengan benar -->
                        <input type="hidden" name="id"
                              value="<?php echo htmlspecialchars($id ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                        <label for="judul-survey">Judul Survey:</label>
                        <input type="text" id="judul-survey" name="judul-survey" placeholder="...."
                              value="<?php echo $judulSurvey; ?>" required>

                        <label for="keterangan">Keterangan:</label>
                        <textarea id="keterangan" name="keterangan" placeholder="...."
                              required><?php echo $keterangan; ?></textarea>

                        <label for="id_wilayah">Pilih Wilayah :</label>
                        <select id="id_wilayah" name="id_wilayah" required>
                              <option value="" disabled <?php echo $idWilayah == '' ? 'selected' : ''; ?>>--Pilih
                                    wilayah--</option>
                              <option value="1" <?php echo $idWilayah == '1' ? 'selected' : ''; ?>>Lampung Barat
                              </option>
                              <option value="2" <?php echo $idWilayah == '2' ? 'selected' : ''; ?>>Tanggamus</option>
                              <option value="3" <?php echo $idWilayah == '3' ? 'selected' : ''; ?>>Lampung Selatan
                              </option>
                              <option value="4" <?php echo $idWilayah == '4' ? 'selected' : ''; ?>>Lampung Timur
                              </option>
                              <option value="5" <?php echo $idWilayah == '5' ? 'selected' : ''; ?>>Lampung Tengah
                              </option>
                              <option value="6" <?php echo $idWilayah == '6' ? 'selected' : ''; ?>>Lampung Utara
                              </option>
                              <option value="7" <?php echo $idWilayah == '7' ? 'selected' : ''; ?>>Way Kanan</option>
                              <option value="8" <?php echo $idWilayah == '8' ? 'selected' : ''; ?>>Tulang Bawang
                              </option>
                              <option value="9" <?php echo $idWilayah == '9' ? 'selected' : ''; ?>>Pesawaran</option>
                              <option value="10" <?php echo $idWilayah == '10' ? 'selected' : ''; ?>>Pringsewu</option>
                              <option value="11" <?php echo $idWilayah == '11' ? 'selected' : ''; ?>>Mesuji</option>
                              <option value="12" <?php echo $idWilayah == '12' ? 'selected' : ''; ?>>Tulang Bawang Barat
                              </option>
                              <option value="13" <?php echo $idWilayah == '13' ? 'selected' : ''; ?>>Pesisir Barat
                              </option>
                              <option value="14" <?php echo $idWilayah == '14' ? 'selected' : ''; ?>>Bandar Lampung
                              </option>
                              <option value="15" <?php echo $idWilayah == '15' ? 'selected' : ''; ?>>Kota Metro</option>
                        </select>

                        <label for="upload-gambar">Upload Gambar (Optional):</label>
                        <div class="upload-section">
                              <div class="upload-box">
                                    <img id="image-preview" src="<?php echo $imagePreview; ?>" alt="Preview">
                                    <input type="file" id="upload-gambar" name="upload-gambar"
                                          accept="image/jpeg, image/png">
                              </div>
                        </div>

                        <div class="button-container">
                              <button type="submit" class="tombol-save" name="submit">
                                    <strong>Lanjut</strong>
                                    <i class="fa-solid fa-arrow-right"></i>
                              </button>
                        </div>
                  </form>
            </div>
      </main>
      <script src="../Js/Main.js"></script>
      <script>
      document.getElementById('upload-gambar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            if (file) {
                  reader.onload = function(e) {
                        document.getElementById('image-preview').src = e.target.result;
                  };
                  reader.readAsDataURL(file);
            }
      });
      </script>
</body>

</html>