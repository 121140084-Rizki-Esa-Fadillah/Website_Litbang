<?php
include "Koneksi_survei_litbang.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul-survey'];
    $keterangan = $_POST['keterangan'];
    $id_wilayah = $_POST['id_wilayah'];
    $image = $_FILES['upload-gambar']['name']; 
    $tmp = $_FILES['upload-gambar']['tmp_name']; 

    // Set default image if no image is uploaded
    $defaultImage = 'image_default.jpg';  // Ensure this image exists in your directory

    if (!empty($image)) {
        // Move uploaded file to a desired location
        $uploadDir = '../../image/';
        if (move_uploaded_file($tmp, $uploadDir . $image)) {
            $imageToSave = $image;
        } else {
            // Display alert on failure
            echo "<script>alert('Gagal mengunggah gambar. Silakan coba lagi.'); window.location.href='Admin_Tambah_Survey_Hal1.php';</script>";
            exit();
        }
    } else {
        // Use default image if no image is provided
        $imageToSave = $defaultImage;
    }

    // Insert data into database including the image filename
    $query = "INSERT INTO survey (title, keterangan, id_wilayah, image) VALUES ('$judul', '$keterangan', '$id_wilayah', '$imageToSave')";

    if (mysqli_query($conn, $query)) {
        // Redirect to the next page
        header('Location: Admin_Tambah_Survey_Hal2.php');
        exit();
    } else {
        // Display alert on failure
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($conn) . "'); window.location.href='Admin_Tambah_Survey_Hal1.php';</script>";
        exit();
    }

    mysqli_close($conn);
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <label for="judul-survey">Judul Survey:</label>
                        <input type="text" id="judul-survey" name="judul-survey" placeholder="..." required>

                        <label for="keterangan">Keterangan:</label>
                        <textarea id="keterangan" name="keterangan" placeholder="..." required></textarea>

                        <label for="sort">Pilih Wilayah :</label>
                        <select id="id_wilayah" name="id_wilayah" required>
                              <option value="1">Lampung Barat</option>
                              <option value="2">Tanggamus</option>
                              <option value="3">Lampung Selatan</option>
                              <option value="4">Lampung Timur</option>
                              <option value="5">Lampung Tengah</option>
                              <option value="6">Lampung Utara</option>
                              <option value="7">Way Kanan</option>
                              <option value="8">Tulang Bawang</option>
                              <option value="9">Pesawaran</option>
                              <option value="10">Pringsewu</option>
                              <option value="11">Mesuji</option>
                              <option value="12">Tulang Bawang Barat</option>
                              <option value="13">Pesisir Barat</option>
                              <option value="14">Bandar Lampung</option>
                              <option value="15">Kota Metro</option>
                        </select>

                        <label for="upload-gambar">Upload Gambar (Optional):</label>
                        <div class="upload-section">
                              <div class="upload-box">
                                    <img id="image-preview" src="../../image/upload_foto.png" alt="Preview">
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
      <script src="..\Js\Main.js"></script>
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