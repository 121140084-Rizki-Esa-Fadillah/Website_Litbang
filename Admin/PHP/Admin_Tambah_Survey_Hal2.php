<?php
include "Koneksi_survei_litbang.php";

// Function to validate inputs
function validateInput($data) {
    return filter_var($data, FILTER_VALIDATE_INT) !== false ? intval($data) : 0;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $gender_sangat_puas_laki = validateInput($_POST['gender_sangat_puas_laki']);
    $gender_puas_laki = validateInput($_POST['gender_puas_laki']);
    $gender_kurang_puas_laki = validateInput($_POST['gender_kurang_puas_laki']);
    $gender_sangat_kurang_puas_laki = validateInput($_POST['gender_sangat_kurang_puas_laki']);

    $gender_sangat_puas_perempuan = validateInput($_POST['gender_sangat_puas_perempuan']);
    $gender_puas_perempuan = validateInput($_POST['gender_puas_perempuan']);
    $gender_kurang_puas_perempuan = validateInput($_POST['gender_kurang_puas_perempuan']);
    $gender_sangat_kurang_puas_perempuan = validateInput($_POST['gender_sangat_kurang_puas_perempuan']);

    $total_responden_laki_laki = $gender_sangat_puas_laki + $gender_puas_laki + $gender_kurang_puas_laki + $gender_sangat_kurang_puas_laki;
    $total_responden_perempuan = $gender_sangat_puas_perempuan + $gender_puas_perempuan + $gender_kurang_puas_perempuan + $gender_sangat_kurang_puas_perempuan;
    $total_responden_gender = $total_responden_laki_laki + $total_responden_perempuan;

    
    $usia_sangat_puas_18_35 = validateInput($_POST['usia_sangat_puas_18_35']);
    $usia_puas_18_35 = validateInput($_POST['usia_puas_18_35']);
    $usia_kurang_puas_18_35 = validateInput($_POST['usia_kurang_puas_18_35']);
    $usia_sangat_kurang_puas_18_35 = validateInput($_POST['usia_sangat_kurang_puas_18_35']);

    $usia_sangat_puas_36_plus = validateInput($_POST['usia_sangat_puas_36_plus']);
    $usia_puas_36_plus = validateInput($_POST['usia_puas_36_plus']);
    $usia_kurang_puas_36_plus = validateInput($_POST['usia_kurang_puas_36_plus']);
    $usia_sangat_kurang_puas_36_plus = validateInput($_POST['usia_sangat_kurang_puas_36_plus']);

    $total_responden_18_35 = $usia_sangat_puas_18_35 + $usia_puas_18_35 + $usia_kurang_puas_18_35 + $usia_sangat_kurang_puas_18_35;
    $total_responden_36_up = $usia_sangat_puas_36_plus + $usia_puas_36_plus + $usia_kurang_puas_36_plus + $usia_sangat_kurang_puas_36_plus;
    $total_responden_usia = $total_responden_18_35 + $total_responden_36_up;

    
    $lulusan_sangat_puas_sd = validateInput($_POST['lulusan_sangat_puas_sd']);
    $lulusan_puas_sd = validateInput($_POST['lulusan_puas_sd']);
    $lulusan_kurang_puas_sd = validateInput($_POST['lulusan_kurang_puas_sd']);
    $lulusan_sangat_kurang_puas_sd = validateInput($_POST['lulusan_sangat_kurang_puas_sd']);

    $lulusan_sangat_puas_smp = validateInput($_POST['lulusan_sangat_puas_smp']);
    $lulusan_puas_smp = validateInput($_POST['lulusan_puas_smp']);
    $lulusan_kurang_puas_smp = validateInput($_POST['lulusan_kurang_puas_smp']);
    $lulusan_sangat_kurang_puas_smp = validateInput($_POST['lulusan_sangat_kurang_puas_smp']);

    $lulusan_sangat_puas_sma = validateInput($_POST['lulusan_sangat_puas_sma']);
    $lulusan_puas_sma = validateInput($_POST['lulusan_puas_sma']);
    $lulusan_kurang_puas_sma = validateInput($_POST['lulusan_kurang_puas_sma']);
    $lulusan_sangat_kurang_puas_sma = validateInput($_POST['lulusan_sangat_kurang_puas_sma']);

    $lulusan_sangat_puas_diploma = validateInput($_POST['lulusan_sangat_puas_diploma']);
    $lulusan_puas_diploma = validateInput($_POST['lulusan_puas_diploma']);
    $lulusan_kurang_puas_diploma = validateInput($_POST['lulusan_kurang_puas_diploma']);
    $lulusan_sangat_kurang_puas_diploma = validateInput($_POST['lulusan_sangat_kurang_puas_diploma']);

    $lulusan_sangat_puas_sarjana = validateInput($_POST['lulusan_sangat_puas_sarjana']);
    $lulusan_puas_sarjana = validateInput($_POST['lulusan_puas_sarjana']);
    $lulusan_kurang_puas_sarjana = validateInput($_POST['lulusan_kurang_puas_sarjana']);
    $lulusan_sangat_kurang_puas_sarjana = validateInput($_POST['lulusan_sangat_kurang_puas_sarjana']);

    $total_responden_sd = $lulusan_sangat_puas_sd + $lulusan_puas_sd + $lulusan_kurang_puas_sd + $lulusan_sangat_kurang_puas_sd;
    $total_responden_smp = $lulusan_sangat_puas_smp + $lulusan_puas_smp + $lulusan_kurang_puas_smp + $lulusan_sangat_kurang_puas_smp;
    $total_responden_sma = $lulusan_sangat_puas_sma + $lulusan_puas_sma + $lulusan_kurang_puas_sma + $lulusan_sangat_kurang_puas_sma;
    $total_responden_diploma = $lulusan_sangat_puas_diploma + $lulusan_puas_diploma + $lulusan_kurang_puas_diploma + $lulusan_sangat_kurang_puas_diploma;
    $total_responden_sarjana = $lulusan_sangat_puas_sarjana + $lulusan_puas_sarjana + $lulusan_kurang_puas_sarjana + $lulusan_sangat_kurang_puas_sarjana;
    $total_responden_lulusan = $total_responden_sd + $total_responden_smp + $total_responden_sma + $total_responden_diploma + $total_responden_sarjana;

    
    $profesi_sangat_puas_pns = validateInput($_POST['profesi_sangat_puas_pns']);
    $profesi_puas_pns = validateInput($_POST['profesi_puas_pns']);
    $profesi_kurang_puas_pns = validateInput($_POST['profesi_kurang_puas_pns']);
    $profesi_sangat_kurang_puas_pns = validateInput($_POST['profesi_sangat_kurang_puas_pns']);

    $profesi_sangat_puas_swasta_wiraswasta = validateInput($_POST['profesi_sangat_puas_swasta']);
    $profesi_puas_swasta_wiraswasta = validateInput($_POST['profesi_puas_swasta']);
    $profesi_kurang_puas_swasta_wiraswasta = validateInput($_POST['profesi_kurang_puas_swasta']);
    $profesi_sangat_kurang_puas_swasta_wiraswasta = validateInput($_POST['profesi_sangat_kurang_puas_swasta']);

    $profesi_sangat_puas_pelajar_mahasiswa = validateInput($_POST['profesi_sangat_puas_pelajar']);
    $profesi_puas_pelajar_mahasiswa = validateInput($_POST['profesi_puas_pelajar']);
    $profesi_kurang_puas_pelajar_mahasiswa = validateInput($_POST['profesi_kurang_puas_pelajar']);
    $profesi_sangat_kurang_puas_pelajar_mahasiswa = validateInput($_POST['profesi_sangat_kurang_puas_pelajar']);

    $profesi_sangat_puas_pengangguran = validateInput($_POST['profesi_sangat_puas_pengangguran']);
    $profesi_puas_pengangguran = validateInput($_POST['profesi_puas_pengangguran']);
    $profesi_kurang_puas_pengangguran = validateInput($_POST['profesi_kurang_puas_pengangguran']);
    $profesi_sangat_kurang_puas_pengangguran = validateInput($_POST['profesi_sangat_kurang_puas_pengangguran']);

    $total_responden_pns = $profesi_sangat_puas_pns + $profesi_puas_pns + $profesi_kurang_puas_pns + $profesi_sangat_kurang_puas_pns;
    $total_responden_swasta_wiraswasta = $profesi_sangat_puas_swasta_wiraswasta + $profesi_puas_swasta_wiraswasta + $profesi_kurang_puas_swasta_wiraswasta + $profesi_sangat_kurang_puas_swasta_wiraswasta;
    $total_responden_pelajar_mahasiswa = $profesi_sangat_puas_pelajar_mahasiswa + $profesi_puas_pelajar_mahasiswa + $profesi_kurang_puas_pelajar_mahasiswa + $profesi_sangat_kurang_puas_pelajar_mahasiswa;
    $total_responden_pengangguran = $profesi_sangat_puas_pengangguran + $profesi_puas_pengangguran + $profesi_kurang_puas_pengangguran + $profesi_sangat_kurang_puas_pengangguran;
    $total_responden_profesi = $total_responden_pns + $total_responden_swasta_wiraswasta + $total_responden_pelajar_mahasiswa + $total_responden_pengangguran;

    

   // Prepare SQL statement for 'gender'
      $stmt_gender = $conn->prepare("
            INSERT INTO gender (laki_laki_sangat_puas, laki_laki_puas, laki_laki_kurang_puas, laki_laki_sangat_kurang_puas,
                                    perempuan_sangat_puas, perempuan_puas, perempuan_kurang_puas, perempuan_sangat_kurang_puas,
                                    total_responden_laki_laki, total_responden_perempuan, total_responden_gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      // Bind parameters for 'gender'
      $stmt_gender->bind_param("iiiiiiiiiii", 
      $gender_sangat_puas_laki, $gender_puas_laki, $gender_kurang_puas_laki, $gender_sangat_kurang_puas_laki,
      $gender_sangat_puas_perempuan, $gender_puas_perempuan, $gender_kurang_puas_perempuan, $gender_sangat_kurang_puas_perempuan,
      $total_responden_laki_laki, $total_responden_perempuan, $total_responden_gender
      );

      // Prepare SQL statement for 'usia'
      $stmt_usia = $conn->prepare("
            INSERT INTO usia (18_35_sangat_puas, 18_35_puas, 18_35_kurang_puas, 18_35_sangat_kurang_puas,
                              36_up_sangat_puas, 36_up_puas, 36_up_kurang_puas, 36_up_sangat_kurang_puas,
                              total_responden_18_35, total_responden_36_up, total_responden_usia)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      // Bind parameters for 'usia'
      $stmt_usia->bind_param("iiiiiiiiiii", 
      $usia_sangat_puas_18_35, $usia_puas_18_35, $usia_kurang_puas_18_35, $usia_sangat_kurang_puas_18_35,
      $usia_sangat_puas_36_plus, $usia_puas_36_plus, $usia_kurang_puas_36_plus, $usia_sangat_kurang_puas_36_plus,
      $total_responden_18_35, $total_responden_36_up, $total_responden_usia
      );

      // Prepare SQL statement for 'lulusan'
      $stmt_lulusan = $conn->prepare("
            INSERT INTO lulusan (
            sd_sangat_puas, sd_puas, sd_kurang_puas, sd_sangat_kurang_puas,	
            smp_sangat_puas, smp_puas, smp_kurang_puas, smp_sangat_kurang_puas, 
            sma_sangat_puas, sma_puas, sma_kurang_puas, sma_sangat_kurang_puas, 
            diploma_sangat_puas, diploma_puas, diploma_kurang_puas, diploma_sangat_kurang_puas, 
            sarjana_sangat_puas, sarjana_puas, sarjana_kurang_puas, sarjana_sangat_kurang_puas, 
            total_responden_sd, total_responden_smp, total_responden_sma, total_responden_diploma, total_responden_sarjana, total_responden_lulusan	
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      // Bind parameters
      $stmt_lulusan->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiii", 
      $lulusan_sangat_puas_sd, $lulusan_puas_sd, $lulusan_kurang_puas_sd, $lulusan_sangat_kurang_puas_sd,
      $lulusan_sangat_puas_smp, $lulusan_puas_smp, $lulusan_kurang_puas_smp, $lulusan_sangat_kurang_puas_smp,
      $lulusan_sangat_puas_sma, $lulusan_puas_sma, $lulusan_kurang_puas_sma, $lulusan_sangat_kurang_puas_sma,
      $lulusan_sangat_puas_diploma, $lulusan_puas_diploma, $lulusan_kurang_puas_diploma, $lulusan_sangat_kurang_puas_diploma,
      $lulusan_sangat_puas_sarjana, $lulusan_puas_sarjana, $lulusan_kurang_puas_sarjana, $lulusan_sangat_kurang_puas_sarjana,
      $total_responden_sd, $total_responden_smp, $total_responden_sma, $total_responden_diploma, $total_responden_sarjana, $total_responden_lulusan
      );

      // Prepare SQL statement for 'profesi'
      $stmt_profesi = $conn->prepare("
            INSERT INTO profesi (pns_sangat_puas, pns_puas, pns_kurang_puas, pns_sangat_kurang_puas,
                                    swasta_wiraswasta_sangat_puas, swasta_wiraswasta_puas, swasta_wiraswasta_kurang_puas, swasta_wiraswasta_sangat_kurang_puas,
                                    pelajar_mahasiswa_sangat_puas, pelajar_mahasiswa_puas, pelajar_mahasiswa_kurang_puas, pelajar_mahasiswa_sangat_kurang_puas,
                                    pengangguran_sangat_puas, pengangguran_puas, pengangguran_kurang_puas, pengangguran_sangat_kurang_puas,
                                    total_responden_pns, total_responden_swasta_wiraswasta, total_responden_pelajar_mahasiswa, total_responden_pengangguran, total_responden_profesi)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      // Bind parameters for 'profesi'
      $stmt_profesi->bind_param("iiiiiiiiiiiiiiiiiiiii", 
      $profesi_sangat_puas_pns, $profesi_puas_pns, $profesi_kurang_puas_pns, $profesi_sangat_kurang_puas_pns,
      $profesi_sangat_puas_swasta_wiraswasta, $profesi_puas_swasta_wiraswasta, $profesi_kurang_puas_swasta_wiraswasta, $profesi_sangat_kurang_puas_swasta_wiraswasta,
      $profesi_sangat_puas_pelajar_mahasiswa, $profesi_puas_pelajar_mahasiswa, $profesi_kurang_puas_pelajar_mahasiswa, $profesi_sangat_kurang_puas_pelajar_mahasiswa,
      $profesi_sangat_puas_pengangguran, $profesi_puas_pengangguran, $profesi_kurang_puas_pengangguran, $profesi_sangat_kurang_puas_pengangguran,
      $total_responden_pns, $total_responden_swasta_wiraswasta, $total_responden_pelajar_mahasiswa, $total_responden_pengangguran, $total_responden_profesi
      );



      // Execute statements and check for errors
      if ($stmt_gender->execute() && $stmt_usia->execute() && $stmt_lulusan->execute() && $stmt_profesi->execute()) {
            header('Location: Admin_Tambah_Survey_Hal3.php');
            exit();
      } else {
            echo "Error: " . $stmt_gender->error . " " . $stmt_usia->error . " " . $stmt_lulusan->error . " " . $stmt_profesi->error;
      }

      // Close the statements and the connection
      $stmt_gender->close();
      $stmt_usia->close();
      $stmt_lulusan->close();
      $stmt_profesi->close();
      $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tambah Survey - Halaman 2</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Tambah_Survey_Hal2.css">
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="Tambah_Survey">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Tambah Survey</h2>
            </section>
            <form method="post" action="Admin_Tambah_Survey_Hal2.php">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <div class="keterangan">
                        <h3>Masukkan Data Survey Anda ke Dalam Kolom yang Tersedia di Tabel di Bawah Ini!</h3><br>
                        <p>Mohon untuk mengisi data survei dengan lengkap dan akurat pada kolom-kolom yang telah
                              disediakan di
                              tabel
                              di bawah ini. Data yang Anda berikan sangat berharga bagi kami untuk meningkatkan kualitas
                              layanan dan
                              memahami kebutuhan serta kepuasan Anda dengan lebih baik.</p>
                  </div>

                  <div class="table">
                        <h3>Gender</h3>
                        <table>
                              <thead>
                                    <tr>
                                          <th>Kategori</th>
                                          <th>Sangat Puas</th>
                                          <th>Puas</th>
                                          <th>Kurang Puas</th>
                                          <th>Sangat Kurang Puas</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                          <td>Laki-laki</td>
                                          <td><input type="number" name="gender_sangat_puas_laki" required></td>
                                          <td><input type="number" name="gender_puas_laki" required></td>
                                          <td><input type="number" name="gender_kurang_puas_laki" required></td>
                                          <td><input type="number" name="gender_sangat_kurang_puas_laki" required></td>
                                    </tr>
                                    <tr>
                                          <td>Perempuan</td>
                                          <td><input type="number" name="gender_sangat_puas_perempuan" required></td>
                                          <td><input type="number" name="gender_puas_perempuan" required></td>
                                          <td><input type="number" name="gender_kurang_puas_perempuan" required></td>
                                          <td><input type="number" name="gender_sangat_kurang_puas_perempuan" required>
                                          </td>
                                    </tr>
                              </tbody>
                        </table>
                        <!-- Tabel Usia -->
                        <h3>Usia</h3>
                        <table>
                              <thead>
                                    <tr>
                                          <th>Kategori</th>
                                          <th>Sangat Puas</th>
                                          <th>Puas</th>
                                          <th>Kurang Puas</th>
                                          <th>Sangat Kurang Puas</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                          <td>18-35 Tahun</td>
                                          <td><input type="number" name="usia_sangat_puas_18_35" required></td>
                                          <td><input type="number" name="usia_puas_18_35" required></td>
                                          <td><input type="number" name="usia_kurang_puas_18_35" required></td>
                                          <td><input type="number" name="usia_sangat_kurang_puas_18_35" required></td>
                                    </tr>
                                    <tr>
                                          <td>36 Tahun ke atas</td>
                                          <td><input type="number" name="usia_sangat_puas_36_plus" required></td>
                                          <td><input type="number" name="usia_puas_36_plus" required></td>
                                          <td><input type="number" name="usia_kurang_puas_36_plus" required></td>
                                          <td><input type="number" name="usia_sangat_kurang_puas_36_plus" required></td>
                                    </tr>
                              </tbody>
                        </table>
                        <!-- Tabel Lulusan -->
                        <h3>Lulusan</h3>
                        <table>
                              <thead>
                                    <tr>
                                          <th>Kategori</th>
                                          <th>Sangat Puas</th>
                                          <th>Puas</th>
                                          <th>Kurang Puas</th>
                                          <th>Sangat Kurang Puas</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                          <td>SD</td>
                                          <td><input type="number" name="lulusan_sangat_puas_sd" required></td>
                                          <td><input type="number" name="lulusan_puas_sd" required></td>
                                          <td><input type="number" name="lulusan_kurang_puas_sd" required></td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_sd" required></td>
                                    </tr>
                                    <tr>
                                          <td>SMP</td>
                                          <td><input type="number" name="lulusan_sangat_puas_smp" required></td>
                                          <td><input type="number" name="lulusan_puas_smp" required></td>
                                          <td><input type="number" name="lulusan_kurang_puas_smp" required></td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_smp" required></td>
                                    </tr>
                                    <tr>
                                          <td>SMA</td>
                                          <td><input type="number" name="lulusan_sangat_puas_sma" required></td>
                                          <td><input type="number" name="lulusan_puas_sma" required></td>
                                          <td><input type="number" name="lulusan_kurang_puas_sma" required></td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_sma" required></td>
                                    </tr>
                                    <tr>
                                          <td>Diploma</td>
                                          <td><input type="number" name="lulusan_sangat_puas_diploma" required></td>
                                          <td><input type="number" name="lulusan_puas_diploma" required></td>
                                          <td><input type="number" name="lulusan_kurang_puas_diploma" required></td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_diploma" required>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>S1/S2/S3</td>
                                          <td><input type="number" name="lulusan_sangat_puas_sarjana" required></td>
                                          <td><input type="number" name="lulusan_puas_sarjana" required></td>
                                          <td><input type="number" name="lulusan_kurang_puas_sarjana" required></td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_sarjana" required>
                                          </td>
                                    </tr>
                              </tbody>
                        </table>
                        <!-- Tabel Profesi -->
                        <h3>Profesi</h3>
                        <table>
                              <thead>
                                    <tr>
                                          <th>Kategori</th>
                                          <th>Sangat Puas</th>
                                          <th>Puas</th>
                                          <th>Kurang Puas</th>
                                          <th>Sangat Kurang Puas</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                          <td>PNS</td>
                                          <td><input type="number" name="profesi_sangat_puas_pns" required></td>
                                          <td><input type="number" name="profesi_puas_pns" required></td>
                                          <td><input type="number" name="profesi_kurang_puas_pns" required></td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_pns" required></td>
                                    </tr>
                                    <tr>
                                          <td>Swasta/Wiraswasta</td>
                                          <td><input type="number" name="profesi_sangat_puas_swasta" required></td>
                                          <td><input type="number" name="profesi_puas_swasta" required></td>
                                          <td><input type="number" name="profesi_kurang_puas_swasta" required></td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_swasta" required>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Pelajar/Mahasiswa</td>
                                          <td><input type="number" name="profesi_sangat_puas_pelajar" required></td>
                                          <td><input type="number" name="profesi_puas_pelajar" required></td>
                                          <td><input type="number" name="profesi_kurang_puas_pelajar" required></td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_pelajar" required>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Pengangguran</td>
                                          <td><input type="number" name="profesi_sangat_puas_pengangguran" required>
                                          </td>
                                          <td><input type="number" name="profesi_puas_pengangguran" required></td>
                                          <td><input type="number" name="profesi_kurang_puas_pengangguran" required>
                                          </td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_pengangguran"
                                                      required>
                                          </td>
                                    </tr>
                              </tbody>
                        </table>
                  </div>
                  <div class="save">
                        <a href="Admin_Tambah_Survey_Hal1.php">
                              <i class="fa-solid fa-arrow-left"></i>
                              <strong>Kembali</strong>
                        </a>
                        <button type="submit" class="tombol-save">
                              <strong>Lanjut</strong>
                              <i class="fa-solid fa-arrow-right"></i>
                        </button>
                  </div>
            </form>
      </main>
      <script src="..\Js\Main.js"></script>
</body>

</html>