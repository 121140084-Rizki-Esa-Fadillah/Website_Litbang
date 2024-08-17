<?php
include "Koneksi_survei_litbang.php";

// Ambil ID survey dari URL atau parameter yang diterima
$survey_id = $_GET['id'] ?? 1; // Default ID survey jika tidak ada parameter

// Fungsi untuk mengeksekusi query dengan error handling
function executeQuery($conn, $query, $params) {
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param(...$params);
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    return $stmt->get_result();
}

// Ambil data survey
$surveyQuery = "SELECT * FROM survey WHERE id = ?";
$surveyResult = executeQuery($conn, $surveyQuery, ["i", $survey_id]);
$surveyData = $surveyResult->fetch_assoc();

// Format tanggal pembuatan
$surveyData['formatted_date'] = date('d F Y', strtotime($surveyData['waktu_buat']));


// Ambil nama wilayah
$wilayahQuery = "SELECT nama_wilayah FROM wilayah WHERE id = ?";
$wilayahResult = executeQuery($conn, $wilayahQuery, ["i", $surveyData['id_wilayah']]);
$wilayahData = $wilayahResult->fetch_assoc();

// Ambil total responden dari tabel gender
$genderQuery = "SELECT * FROM gender WHERE id = ?";
$genderResult = executeQuery($conn, $genderQuery, ["i", $surveyData['id']]);
$genderData = $genderResult->fetch_assoc();

// Ambil data lulusan
$lulusanQuery = "SELECT * FROM lulusan WHERE id = ?";
$lulusanResult = executeQuery($conn, $lulusanQuery, ["i", $surveyData['id']]);
$lulusanData = $lulusanResult->fetch_assoc();

// Ambil data profesi
$profesiQuery = "SELECT * FROM profesi WHERE id = ?";
$profesiResult = executeQuery($conn, $profesiQuery, ["i", $surveyData['id']]);
$profesiData = $profesiResult->fetch_assoc();

// Ambil data usia
$usiaQuery = "SELECT * FROM usia WHERE id = ?";
$usiaResult = executeQuery($conn, $usiaQuery, ["i", $surveyData['id']]);
$usiaData = $usiaResult->fetch_assoc();

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Detail Hasil Survey</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Detail_Hasil_Survey.css">
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js">
      </script>


</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="Tambah_Survey">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Detail Hasil Survey</h2>
            </section>
            <div class="tambah_survei">
                  <h2><?php echo htmlspecialchars($surveyData['title']); ?></h2>
                  <p><?php echo htmlspecialchars($surveyData['keterangan']); ?></p>
                  <div class="tanggal">
                        <span class="material-symbols-outlined">schedule</span>
                        <p>Radar Litbang, <?php echo htmlspecialchars($surveyData['formatted_date']); ?></p>
                  </div>
            </div>
            </div>
            <div class="tab-container-wrapper">
                  <div class="tab-container">
                        <button id="chart-button" class="tab">Grafik</button>
                        <button id="table-button" class="tab active">Tabel Data</button>
                  </div>
            </div>
            <div class="info-umum">
                  <h5>Wilayah: <?php echo htmlspecialchars($wilayahData['nama_wilayah']); ?></h5>
                  <h5>Total Responden: <?php echo htmlspecialchars($genderData['total_responden_gender']); ?></h5>
            </div>
            <div id="table" class="table" style="display: block;">
                  <table class="survey-table" id="survey-table"">
                        <thead>
                              <tr>
                                    <th rowspan=" 2">Kategori</th>
                        <th colspan="5">Tabel Keseluruhan</th>
                        <th colspan="5">Tabel Persentase Keseluruhan</th>
                        </tr>
                        <tr>
                              <th>Sangat Puas</th>
                              <th>Puas</th>
                              <th>Kurang Puas</th>
                              <th>Sangat Kurang Puas</th>
                              <th>Total</th>
                              <th>Sangat Puas</th>
                              <th>Puas</th>
                              <th>Kurang Puas</th>
                              <th>Sangat Kurang Puas</th>
                              <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    <td>Laki - Laki</td>
                                    <td><?php echo htmlspecialchars($genderData['laki_laki_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($genderData['laki_laki_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($genderData['laki_laki_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($genderData['laki_laki_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($genderData['total_responden_laki_laki']); ?>
                                    </td>
                                    <td><?php echo number_format(($genderData['laki_laki_sangat_puas'] / $genderData['total_responden_laki_laki']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['laki_laki_puas'] / $genderData['total_responden_laki_laki']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['laki_laki_kurang_puas'] / $genderData['total_responden_laki_laki']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['laki_laki_sangat_kurang_puas'] / $genderData['total_responden_laki_laki']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['laki_laki_sangat_puas'] +$genderData['laki_laki_puas'] +$genderData['laki_laki_kurang_puas'] +$genderData['laki_laki_sangat_kurang_puas']) /$genderData['total_responden_laki_laki'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Perempuan</td>
                                    <td><?php echo htmlspecialchars($genderData['perempuan_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($genderData['perempuan_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($genderData['perempuan_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($genderData['perempuan_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($genderData['total_responden_perempuan']); ?>
                                    </td>
                                    <td><?php echo number_format(($genderData['perempuan_sangat_puas'] / $genderData['total_responden_perempuan']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['perempuan_puas'] / $genderData['total_responden_perempuan']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['perempuan_kurang_puas'] / $genderData['total_responden_perempuan']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['perempuan_sangat_kurang_puas'] / $genderData['total_responden_perempuan']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($genderData['perempuan_sangat_puas'] +$genderData['perempuan_puas'] +$genderData['perempuan_kurang_puas'] +$genderData['perempuan_sangat_kurang_puas']) /$genderData['total_responden_perempuan'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>18-35 Tahun </td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($usiaData['total_responden_18_35']); ?>
                                    </td>
                                    <td><?php echo number_format(($usiaData['18_35_sangat_puas'] / $usiaData['total_responden_18_35']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['18_35_puas'] / $usiaData['total_responden_18_35']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['18_35_kurang_puas'] / $usiaData['total_responden_18_35']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['18_35_sangat_kurang_puas'] / $usiaData['total_responden_18_35']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['18_35_sangat_puas'] +$usiaData['18_35_puas'] +$usiaData['18_35_kurang_puas'] +$usiaData['18_35_sangat_kurang_puas']) /$usiaData['total_responden_18_35'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>36 Tahun Ke atas</td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($usiaData['total_responden_36_up']); ?>
                                    </td>
                                    <td><?php echo number_format(($usiaData['36_up_sangat_puas'] / $usiaData['total_responden_36_up']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['36_up_puas'] / $usiaData['total_responden_36_up']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['36_up_kurang_puas'] / $usiaData['total_responden_36_up']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['36_up_sangat_kurang_puas'] / $usiaData['total_responden_36_up']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($usiaData['36_up_sangat_puas'] +$usiaData['36_up_puas'] +$usiaData['36_up_kurang_puas'] +$usiaData['36_up_sangat_kurang_puas']) /$usiaData['total_responden_36_up'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Lulusan SD</td>
                                    <td><?php echo htmlspecialchars($lulusanData['sd_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sd_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sd_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sd_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($lulusanData['total_responden_sd']); ?>
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sd_sangat_puas'] / $lulusanData['total_responden_sd']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sd_puas'] / $lulusanData['total_responden_sd']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sd_kurang_puas'] / $lulusanData['total_responden_sd']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sd_sangat_kurang_puas'] / $lulusanData['total_responden_sd']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sd_sangat_puas'] +$lulusanData['sd_puas'] +$lulusanData['sd_kurang_puas'] +$lulusanData['sd_sangat_kurang_puas']) /$lulusanData['total_responden_sd'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Lulusan SMP</td>
                                    <td><?php echo htmlspecialchars($lulusanData['smp_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['smp_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['smp_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['smp_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($lulusanData['total_responden_smp']); ?>
                                    </td>
                                    <td><?php echo number_format(($lulusanData['smp_sangat_puas'] / $lulusanData['total_responden_smp']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['smp_puas'] / $lulusanData['total_responden_smp']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['smp_kurang_puas'] / $lulusanData['total_responden_smp']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['smp_sangat_kurang_puas'] / $lulusanData['total_responden_smp']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['smp_sangat_puas'] +$lulusanData['smp_puas'] +$lulusanData['smp_kurang_puas'] +$lulusanData['smp_sangat_kurang_puas']) /$lulusanData['total_responden_smp'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Lulusan SMA</td>
                                    <td><?php echo htmlspecialchars($lulusanData['sma_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sma_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sma_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sma_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($lulusanData['total_responden_sma']); ?>
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sma_sangat_puas'] / $lulusanData['total_responden_sma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sma_puas'] / $lulusanData['total_responden_sma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sma_kurang_puas'] / $lulusanData['total_responden_sma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sma_sangat_kurang_puas'] / $lulusanData['total_responden_sma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sma_sangat_puas'] +$lulusanData['sma_puas'] +$lulusanData['sma_kurang_puas'] +$lulusanData['sma_sangat_kurang_puas']) /$lulusanData['total_responden_sma'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Lulusan Diploma</td>
                                    <td><?php echo htmlspecialchars($lulusanData['diploma_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['diploma_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['diploma_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['diploma_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($lulusanData['total_responden_diploma']); ?>
                                    </td>
                                    <td><?php echo number_format(($lulusanData['diploma_sangat_puas'] / $lulusanData['total_responden_diploma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['diploma_puas'] / $lulusanData['total_responden_diploma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['diploma_kurang_puas'] / $lulusanData['total_responden_diploma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['diploma_sangat_kurang_puas'] / $lulusanData['total_responden_diploma']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['diploma_sangat_puas'] +$lulusanData['diploma_puas'] +$lulusanData['diploma_kurang_puas'] +$lulusanData['diploma_sangat_kurang_puas']) /$lulusanData['total_responden_diploma'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Lulusan S1/2/S3</td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($lulusanData['total_responden_sarjana']); ?>
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sarjana_sangat_puas'] / $lulusanData['total_responden_sarjana']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sarjana_puas'] / $lulusanData['total_responden_sarjana']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sarjana_kurang_puas'] / $lulusanData['total_responden_sarjana']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sarjana_sangat_kurang_puas'] / $lulusanData['total_responden_sarjana']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($lulusanData['sarjana_sangat_puas'] +$lulusanData['sarjana_puas'] +$lulusanData['sarjana_kurang_puas'] +$lulusanData['sarjana_sangat_kurang_puas']) /$lulusanData['total_responden_sarjana'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>PNS</td>
                                    <td><?php echo htmlspecialchars($profesiData['pns_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pns_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pns_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pns_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['total_responden_pns']); ?>
                                    </td>
                                    <td><?php echo number_format(($profesiData['pns_sangat_puas'] / $profesiData['total_responden_pns']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pns_puas'] / $profesiData['total_responden_pns']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pns_kurang_puas'] / $profesiData['total_responden_pns']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pns_sangat_kurang_puas'] / $profesiData['total_responden_pns']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pns_sangat_puas'] +$profesiData['pns_puas'] +$profesiData['pns_kurang_puas'] +$profesiData['pns_sangat_kurang_puas']) /$profesiData['total_responden_pns'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Swasta & Wiraswasta</td>
                                    <td><?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['swasta_wiraswasta_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['total_responden_swasta_wiraswasta']); ?>
                                    </td>
                                    <td><?php echo number_format(($profesiData['swasta_wiraswasta_sangat_puas'] / $profesiData['total_responden_swasta_wiraswasta']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['swasta_wiraswasta_puas'] / $profesiData['total_responden_swasta_wiraswasta']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['swasta_wiraswasta_kurang_puas'] / $profesiData['total_responden_swasta_wiraswasta']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['swasta_wiraswasta_sangat_kurang_puas'] / $profesiData['total_responden_swasta_wiraswasta']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['swasta_wiraswasta_sangat_puas'] +$profesiData['swasta_wiraswasta_puas'] +$profesiData['swasta_wiraswasta_kurang_puas'] +$profesiData['swasta_wiraswasta_sangat_kurang_puas']) /$profesiData['total_responden_swasta_wiraswasta'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Pelajar & Mahasiswa</td>
                                    <td><?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['total_responden_pelajar_mahasiswa']); ?>
                                    </td>
                                    <td><?php echo number_format(($profesiData['pelajar_mahasiswa_sangat_puas'] / $profesiData['total_responden_pelajar_mahasiswa']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pelajar_mahasiswa_puas'] / $profesiData['total_responden_pelajar_mahasiswa']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pelajar_mahasiswa_kurang_puas'] / $profesiData['total_responden_pelajar_mahasiswa']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pelajar_mahasiswa_sangat_kurang_puas'] / $profesiData['total_responden_pelajar_mahasiswa']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pelajar_mahasiswa_sangat_puas'] +$profesiData['pelajar_mahasiswa_puas'] +$profesiData['pelajar_mahasiswa_kurang_puas'] +$profesiData['pelajar_mahasiswa_sangat_kurang_puas']) /$profesiData['total_responden_pelajar_mahasiswa'] * 100,2); ?>%
                                    </td>
                              </tr>
                              <tr>
                                    <td>Pengangguran</td>
                                    <td><?php echo htmlspecialchars($profesiData['pengangguran_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pengangguran_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pengangguran_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($profesiData['total_responden_pengangguran']); ?>
                                    </td>
                                    <td><?php echo number_format(($profesiData['pengangguran_sangat_puas'] / $profesiData['total_responden_pengangguran']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pengangguran_puas'] / $profesiData['total_responden_pengangguran']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pengangguran_kurang_puas'] / $profesiData['total_responden_pengangguran']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pengangguran_sangat_kurang_puas'] / $profesiData['total_responden_pengangguran']) * 100,2); ?>%
                                    </td>
                                    <td><?php echo number_format(($profesiData['pengangguran_sangat_puas'] +$profesiData['pengangguran_puas'] +$profesiData['pengangguran_kurang_puas'] +$profesiData['pengangguran_sangat_kurang_puas']) /$profesiData['total_responden_pengangguran'] * 100,2); ?>%
                                    </td>
                              </tr>
                        </tbody>
                  </table>
            </div>
            <div id="chart" class="grafik" style="display: none;">
                  <h3>Gender</h3><br>
                  <div class="Gender">
                        <div class="chart-area">
                              <canvas id="laki_laki"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($genderData['laki_laki_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($genderData['laki_laki_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($genderData['laki_laki_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($genderData['laki_laki_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="perempuan"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($genderData['perempuan_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($genderData['perempuan_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($genderData['perempuan_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($genderData['perempuan_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                  </div>
                  <h3>Usia</h3><br>
                  <div class="Usia">
                        <div class="chart-area">
                              <canvas id="18_35"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($usiaData['18_35_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($usiaData['18_35_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($usiaData['18_35_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="36_up"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($usiaData['36_up_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($usiaData['36_up_puas']); ?></li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($usiaData['36_up_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                  </div>
                  <h3>Lulusan</h3><br>
                  <div class="lulusan">
                        <div class="chart-area">
                              <canvas id="sd"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($lulusanData['sd_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($lulusanData['sd_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['sd_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['sd_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="smp"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($lulusanData['smp_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($lulusanData['smp_puas']); ?></li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['smp_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['smp_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="sma"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($lulusanData['sma_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($lulusanData['sma_puas']); ?></li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['sma_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['sma_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="diploma"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($lulusanData['diploma_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($lulusanData['diploma_puas']); ?></li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['diploma_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['diploma_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="sarjana"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($lulusanData['sarjana_puas']); ?></li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                  </div>
                  <h3>Profesi</h3><br>
                  <div class="profesi">
                        <div class="chart-area">
                              <canvas id="pns"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($profesiData['pns_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($profesiData['pns_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['pns_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['pns_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="swasta_wiraswasta"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="pelajar_mahasiswa"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                        <div class="chart-area">
                              <canvas id="pengangguran"></canvas>
                              <div>
                                    <h4>Keterangan</h4><br>
                                    <ul>
                                          <li>Jumlah Responden Sangat Puas :
                                                <?php echo htmlspecialchars($profesiData['pengangguran_sangat_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Puas :
                                                <?php echo htmlspecialchars($profesiData['pengangguran_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['pengangguran_kurang_puas']); ?>
                                          </li>
                                          <li>Jumlah Responden Sangat Kurang Puas :
                                                <?php echo htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas']); ?>
                                          </li>
                                    </ul>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="actions">
                  <div class="ket-unduh">
                        <p>Unduh hasil survei dalam berbagai PDF untuk kemudahan penyimpanan, pembagian, dan analisis
                              data.</p>
                  </div>
                  <button class="tombol-unduh" id="download" onclick="downloadPDF()">Download PDF</button>

            </div>
      </main>
      <script>
      // Fungsi untuk membuat chart pie
      function createPieChart(chartId, titleText, dataValues) {
            const chartElement = document.getElementById(chartId);
            new Chart(chartElement, {
                  type: 'pie',
                  data: {
                        labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                        datasets: [{
                              label: 'Jumlah Responden',
                              data: dataValues,
                              borderWidth: 1,
                              backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)'
                              ],
                              borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)'
                              ],
                        }]
                  },
                  options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: {
                              padding: {
                                    top: 10,
                                    right: 40
                              }
                        },
                        plugins: {
                              title: {
                                    display: true,
                                    text: titleText,
                                    font: {
                                          size: 16
                                    },
                                    padding: {
                                          bottom: 5
                                    },
                                    color: 'black'
                              },
                              legend: {
                                    position: 'left',
                                    labels: {
                                          font: {
                                                size: 10
                                          },
                                          boxWidth: 12,
                                          padding: 50
                                    }
                              },
                              datalabels: {
                                    formatter: (value, ctx) => {
                                          let total = ctx.dataset.data.reduce((acc, val) => acc + val,
                                                0);
                                          let percentage = (value / total * 100).toFixed(2) + '%';
                                          return percentage;
                                    },
                                    color: '#000',
                                    anchor: 'end',
                                    align: 'end',
                                    offset: 1,
                                    font: {
                                          size: 10
                                    }
                              }
                        }
                  },
                  plugins: [ChartDataLabels]
            });
      }

      const genderData = {
            laki_laki: [
                  <?php echo htmlspecialchars($genderData['laki_laki_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($genderData['laki_laki_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($genderData['laki_laki_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($genderData['laki_laki_sangat_kurang_puas'] ?? 0); ?>
            ],
            perempuan: [
                  <?php echo htmlspecialchars($genderData['perempuan_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($genderData['perempuan_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($genderData['perempuan_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($genderData['perempuan_sangat_kurang_puas'] ?? 0); ?>
            ]
      };

      const usiaData = {
            '18_35': [
                  <?php echo htmlspecialchars($usiaData['18_35_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($usiaData['18_35_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($usiaData['18_35_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas'] ?? 0); ?>
            ],
            '36_up': [
                  <?php echo htmlspecialchars($usiaData['36_up_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($usiaData['36_up_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($usiaData['36_up_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas'] ?? 0); ?>
            ]
      };

      const lulusanData = {
            sd: [
                  <?php echo htmlspecialchars($lulusanData['sd_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sd_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sd_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sd_sangat_kurang_puas'] ?? 0); ?>
            ],
            smp: [
                  <?php echo htmlspecialchars($lulusanData['smp_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['smp_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['smp_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['smp_sangat_kurang_puas'] ?? 0); ?>
            ],
            sma: [
                  <?php echo htmlspecialchars($lulusanData['sma_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sma_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sma_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sma_sangat_kurang_puas'] ?? 0); ?>
            ],
            diploma: [
                  <?php echo htmlspecialchars($lulusanData['diploma_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['diploma_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['diploma_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['diploma_sangat_kurang_puas'] ?? 0); ?>
            ],
            sarjana: [
                  <?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sarjana_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas'] ?? 0); ?>
            ]
      };

      const profesiData = {
            pns: [
                  <?php echo htmlspecialchars($profesiData['pns_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pns_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pns_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pns_sangat_kurang_puas'] ?? 0); ?>
            ],
            swasta_wiraswasta: [
                  <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas'] ?? 0); ?>
            ],
            pelajar_mahasiswa: [
                  <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas'] ?? 0); ?>
            ],
            pengangguran: [
                  <?php echo htmlspecialchars($profesiData['pengangguran_sangat_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pengangguran_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pengangguran_kurang_puas'] ?? 0); ?>,
                  <?php echo htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas'] ?? 0); ?>
            ]
      };

      createPieChart('laki_laki', 'Kategori Laki-laki', genderData['laki_laki']);
      createPieChart('perempuan', 'Kategori Perempuan', genderData['perempuan']);
      createPieChart('18_35', 'Kategori Usia 18 hingga 35 Tahun', usiaData['18_35']);
      createPieChart('36_up', 'Kategori Usia 36 Tahun Ke atas', usiaData['36_up']);
      createPieChart('sd', 'Kategori Lulusan SD', lulusanData['sd']);
      createPieChart('smp', 'Kategori Lulusan SMP', lulusanData['smp']);
      createPieChart('sma', 'Kategori Lulusan SMA', lulusanData['sma']);
      createPieChart('diploma', 'Kategori Lulusan Diploma', lulusanData['diploma']);
      createPieChart('sarjana', 'Kategori Lulusan Sarjana', lulusanData['sarjana']);
      createPieChart('pns', 'Kategori Profesi PNS', profesiData['pns']);
      createPieChart('swasta_wiraswasta', 'Kategori Profesi Swasta & Wiraswasta', profesiData['swasta_wiraswasta']);
      createPieChart('pelajar_mahasiswa', 'Kategori Profesi Pelajar & Mahasiswa', profesiData['pelajar_mahasiswa']);
      createPieChart('pengangguran', 'Kategori Profesi Pengangguran', profesiData['pengangguran']);

      async function downloadPDF() {
            const {
                  jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            const margin = 10;
            const pageWidth = doc.internal.pageSize.getWidth();
            const topMargin = 20;
            const titleTopMargin = 5;
            let y = topMargin + titleTopMargin;

            // Add survey title
            doc.setFontSize(16);
            doc.setFont("helvetica", "bold");
            const title = "<?php echo htmlspecialchars($surveyData['title']); ?>";
            const titleWidth = doc.getTextWidth(title);
            const titleX = (pageWidth - titleWidth) / 2;
            doc.text(title, titleX, y);
            y += 12;

            // Add survey description
            doc.setFontSize(11);
            doc.setFont("helvetica", "normal");
            const description = "<?php echo htmlspecialchars($surveyData['keterangan']); ?>";
            const descriptionLines = doc.splitTextToSize(description, pageWidth - 2 * margin);
            doc.text(descriptionLines, margin, y);
            y += descriptionLines.length * 6 + 4;

            // Add date and region details
            doc.setFontSize(10);
            doc.text(`Radar Litbang, <?php echo htmlspecialchars($surveyData['formatted_date']); ?>`, margin, y);
            y += 8;
            doc.text(`Wilayah: <?php echo htmlspecialchars($wilayahData['nama_wilayah']); ?>`, margin, y);
            y += 8;
            doc.text(`Total Responden: <?php echo htmlspecialchars($genderData['total_responden_gender']); ?>`,
                  margin, y);
            y += 12;

            // Define column widths with wider category column
            const colWidths = [25, 16, 16, 16, 16, 16, 16, 16, 16, 16, 17];

            // Add survey table with borders and consistent column widths
            const tableElement = document.querySelector('.survey-table');
            if (tableElement) {
                  doc.autoTable({
                        html: tableElement,
                        startY: y,
                        margin: {
                              left: margin,
                              right: margin
                        },
                        styles: {
                              cellPadding: 2,
                              fontSize: 9,
                              lineWidth: 0.1,
                              lineColor: [220, 220, 220],
                        },
                        headStyles: {
                              fillColor: [226, 211, 235],
                              textColor: [0, 0, 0],
                              lineColor: [0, 0, 0],
                              halign: 'center',
                        },
                        bodyStyles: {
                              lineColor: [0, 0, 0],
                              halign: 'center',
                        },
                        columnStyles: colWidths.reduce((styles, width, index) => {
                              styles[index] = {
                                    cellWidth: width
                              };
                              return styles;;
                        }, {}),
                        tableWidth: pageWidth - 2 * margin,
                  });
            }

            // Move to next page for charts
            doc.addPage();
            let chartY = margin;
            const chartMargin = 10;
            const chartWidth = 100 // Adjusted width for 2 charts per row
            const chartHeight = 70; // Adjusted height for the charts
            const textPadding = 3; // Padding between image and text

            // Add title for the charts section
            doc.setFontSize(16);
            doc.setFont("helvetica", "bold");
            chartY += 10;
            const chartTitle = "Persebaran Data Grafik";
            const chartTitleWidth = doc.getTextWidth(chartTitle);
            const chartTitleX = (pageWidth - chartTitleWidth) / 2;
            doc.text(chartTitle, chartTitleX, chartY);
            chartY += 12; // Adjust space after title

            // Define chart categories including additional ones
            const chartCategories = [{
                        id: 'laki_laki',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($genderData['laki_laki_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($genderData['laki_laki_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($genderData['laki_laki_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($genderData['laki_laki_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'perempuan',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($genderData['perempuan_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($genderData['perempuan_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($genderData['perempuan_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($genderData['perempuan_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: '18_35',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($usiaData['18_35_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($usiaData['18_35_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($usiaData['18_35_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: '36_up',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($usiaData['36_up_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($usiaData['36_up_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($usiaData['36_up_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'sd',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($lulusanData['sd_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($lulusanData['sd_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($lulusanData['sd_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($lulusanData['sd_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'smp',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($lulusanData['smp_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($lulusanData['smp_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($lulusanData['smp_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($lulusanData['smp_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'sma',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($lulusanData['sma_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($lulusanData['sma_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($lulusanData['sma_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($lulusanData['sma_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'diploma',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($lulusanData['diploma_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($lulusanData['diploma_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($lulusanData['diploma_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($lulusanData['diploma_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'sarjana',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($lulusanData['sarjana_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'pns',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($profesiData['pns_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($profesiData['pns_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($profesiData['pns_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($profesiData['pns_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'swasta_wiraswasta',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'pelajar_mahasiswa',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas']); ?> Orang'
                        ]
                  },
                  {
                        id: 'pengangguran',
                        label: 'Keterangan :',
                        keterangan: [
                              '\u2022 Jumlah Responden Sangat Puas: <?php echo htmlspecialchars($profesiData['pengangguran_sangat_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Puas: <?php echo htmlspecialchars($profesiData['pengangguran_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Kurang Puas: <?php echo htmlspecialchars($profesiData['pengangguran_kurang_puas']); ?> Orang',
                              '\u2022 Jumlah Responden Sangat Kurang Puas: <?php echo htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas']); ?> Orang'
                        ]
                  }
            ];

            // Render charts with labels and details
            for (let i = 0; i < chartCategories.length; i++) {
                  const chartCanvas = document.getElementById(chartCategories[i].id);
                  if (chartCanvas) {
                        const imageData = chartCanvas.toDataURL("image/png", 1.0);

                        // Adjust label and keterangan to be on the same side
                        const labelX = margin + chartWidth + textPadding + 5;
                        const labelY = chartY + chartHeight / 3;

                        doc.setFontSize(11);
                        doc.setFont("helvetica", "bold");
                        doc.text(chartCategories[i].label, labelX, labelY);

                        // Add chart image
                        const chartX = margin;
                        doc.addImage(imageData, 'PNG', chartX, chartY, chartWidth, chartHeight);

                        // Draw border around the chart
                        doc.setDrawColor(0); // Set border color to black
                        doc.rect(chartX - 1, chartY - 1, chartWidth + 2, chartHeight +
                              2); // Border around the chart

                        // Adjust keterangan position below the label
                        const keteranganX = labelX;
                        const keteranganY = labelY + 8;

                        doc.setFontSize(10);
                        doc.setFont("helvetica", "normal");

                        const keteranganLines = chartCategories[i].keterangan;
                        let textY = keteranganY;
                        keteranganLines.forEach((line) => {
                              doc.text(line, keteranganX, textY);
                              textY += 6;
                        });

                        chartY += chartHeight + 20;

                        // Check if new page is needed
                        if (chartY + chartHeight > doc.internal.pageSize.height - margin) {
                              doc.addPage();
                              chartY = 15; // Reset margin for new page
                        }
                  }
            }

            // Construct the filename
            const formattedTitle = title.replace(/[^a-zA-Z0-9]/g, '_'); // Replace non-alphanumeric characters
            const wilayahName = "<?php echo htmlspecialchars($wilayahData['nama_wilayah']); ?>".replace(
                  /[^a-zA-Z0-9]/g, '_'); // Replace non-alphanumeric characters
            const filename = `${formattedTitle}_${wilayahName}.pdf`;

            // Save the PDF with the constructed filename
            doc.save(filename);
      }
      </script>
      <script src="../Js/Main.js"></script>
      <script src="../Js/Detail_Survey.js"></script>
</body>

</html>