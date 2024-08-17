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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

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
                        <button id="table-button" class="tab active">Tabel Data</button>
                        <button id="chart-button" class="tab">Grafik</button>
                  </div>
            </div>
            <div class="info-umum">
                  <h5>Wilayah: <?php echo htmlspecialchars($wilayahData['nama_wilayah']); ?></h5>
                  <h5>Total Responden: <?php echo htmlspecialchars($genderData['total_responden_gender']); ?></h5>
            </div>
            <div id="table" class="table" style="display: block;">
                  <table class="survey-table">
                        <thead>
                              <tr>
                                    <th rowspan="2">Kategori</th>
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
                                    <td><?php echo htmlspecialchars($genderData['laki_laki_sangat_puas'] +$genderData['laki_laki_puas'] +$genderData['laki_laki_kurang_puas'] +$genderData['laki_laki_sangat_kurang_puas']); ?>
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
                                    <td><?php echo htmlspecialchars($genderData['perempuan_sangat_puas'] +$genderData['perempuan_puas'] +$genderData['perempuan_kurang_puas'] +$genderData['perempuan_sangat_kurang_puas']); ?>
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
                                    <td>Usia 18-35 Tahun </td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($usiaData['18_35_sangat_puas'] +$usiaData['18_35_puas'] +$usiaData['18_35_kurang_puas'] +$usiaData['18_35_sangat_kurang_puas']); ?>
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
                                    <td>Usia 36 Tahun Ke atas</td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($usiaData['36_up_sangat_puas'] +$usiaData['36_up_puas'] +$usiaData['36_up_kurang_puas'] +$usiaData['36_up_sangat_kurang_puas']); ?>
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
                                    <td><?php echo htmlspecialchars($lulusanData['sd_sangat_puas'] +$lulusanData['sd_puas'] +$lulusanData['sd_kurang_puas'] +$lulusanData['sd_sangat_kurang_puas']); ?>
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
                                    <td><?php echo htmlspecialchars($lulusanData['smp_sangat_puas'] +$lulusanData['smp_puas'] +$lulusanData['smp_kurang_puas'] +$lulusanData['smp_sangat_kurang_puas']); ?>
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
                                    <td><?php echo htmlspecialchars($lulusanData['sma_sangat_puas'] +$lulusanData['sma_puas'] +$lulusanData['sma_kurang_puas'] +$lulusanData['sma_sangat_kurang_puas']); ?>
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
                                    <td><?php echo htmlspecialchars($lulusanData['diploma_sangat_puas'] +$lulusanData['diploma_puas'] +$lulusanData['diploma_kurang_puas'] +$lulusanData['diploma_sangat_kurang_puas']); ?>
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
                                    <td>Lulusan S1/2/S3S</td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas']); ?></td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas'] +$lulusanData['sarjana_puas'] +$lulusanData['sarjana_kurang_puas'] +$lulusanData['sarjana_sangat_kurang_puas']); ?>
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
                                                <?php echo htmlspecialchars($profesiData['pengangguran_puas']); ?></li>
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
                  <button id="downloadBtn" class="tombol-unduh">Download</button>
            </div>
      </main>
      <script>
      // Chart untuk Gender - Laki-laki
      const chart_laki_laki = document.getElementById('laki_laki');
      new Chart(chart_laki_laki, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($genderData['laki_laki_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($genderData['laki_laki_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($genderData['laki_laki_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($genderData['laki_laki_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              text: 'Kategori Laki-laki',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 5
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Gender - Perempuan
      const chart_perempuan = document.getElementById('perempuan');
      new Chart(chart_perempuan, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($genderData['perempuan_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($genderData['perempuan_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($genderData['perempuan_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($genderData['perempuan_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Perempuan',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Usia - 18-35 
      const chart_18_35 = document.getElementById('18_35');
      new Chart(chart_18_35, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($usiaData['18_35_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($usiaData['18_35_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($usiaData['18_35_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 18 hingga 35 Tahun',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Usia - 36 Tahun keatas 
      const chart_36_up = document.getElementById('36_up');
      new Chart(chart_36_up, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($usiaData['36_up_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($usiaData['36_up_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($usiaData['36_up_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Lulusan - SD
      const chart_sd = document.getElementById('sd');
      new Chart(chart_sd, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($lulusanData['sd_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sd_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sd_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sd_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Lulusan - SMP
      const chart_smp = document.getElementById('smp');
      new Chart(chart_smp, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($lulusanData['smp_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['smp_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['smp_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['smp_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Lulusan - SMA
      const chart_sma = document.getElementById('sma');
      new Chart(chart_sma, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($lulusanData['sma_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sma_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sma_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sma_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Lulusan - Diploma
      const chart_diploma = document.getElementById('diploma');
      new Chart(chart_diploma, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($lulusanData['diploma_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['diploma_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['diploma_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['diploma_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Lulusan - Sarjana
      const chart_sarjana = document.getElementById('sarjana');
      new Chart(chart_sarjana, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sarjana_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Profesi - PNS
      const chart_pns = document.getElementById('pns');
      new Chart(chart_pns, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($profesiData['pns_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pns_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pns_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pns_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Profesi - Swasta & Wiraswasta
      const chart_swasta_wiraswasta = document.getElementById('swasta_wiraswasta');
      new Chart(chart_swasta_wiraswasta, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Profesi - Pelajar & Mahasiswa
      const chart_pelajar_mahasiswa = document.getElementById('pelajar_mahasiswa');
      new Chart(chart_pelajar_mahasiswa, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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

      // Chart untuk Profesi - Pengangguran
      const chart_pengangguran = document.getElementById('pengangguran');
      new Chart(chart_pengangguran, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo htmlspecialchars($profesiData['pengangguran_sangat_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pengangguran_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pengangguran_kurang_puas'] ?? 0); ?>,
                              <?php echo htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas'] ?? 0); ?>
                        ],
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
                              top: 5,
                              right: 40
                        }
                  },
                  plugins: {
                        title: {
                              display: true,
                              text: 'Kategori Usia 36 Tahun Ke atas',
                              font: {
                                    size: 16
                              },
                              padding: {
                                    bottom: 10
                              }
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
                                    let total = ctx.dataset.data.reduce((acc, val) => acc + val, 0);
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
      </script>
      <script src="../Js/Main.js"></script>
      <script src="../Js/Download.js"></script>
      <script src="../Js/Detail_Survey.js"></script>
</body>

</html>