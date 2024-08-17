<?php
include 'Koneksi_survei_litbang.php';

// Prepare and execute query to fetch the latest survey
$sqlSurvey = "SELECT * FROM survey ORDER BY id DESC LIMIT 1";
$stmtSurvey = $conn->prepare($sqlSurvey);
$stmtSurvey->execute();
$surveyResult = $stmtSurvey->get_result();

if ($surveyResult->num_rows > 0) {
    $surveyData = $surveyResult->fetch_assoc();
    $surveyTitle = $surveyData['title'];
    $surveyIdWilayah = $surveyData['id_wilayah'];
    
    // Prepare and execute query to fetch wilayah name
    $sqlWilayah = "SELECT nama_wilayah FROM wilayah WHERE id = ?";
    $stmtWilayah = $conn->prepare($sqlWilayah);
    $stmtWilayah->bind_param("i", $surveyIdWilayah);
    $stmtWilayah->execute();
    $wilayahResult = $stmtWilayah->get_result();
    
    if ($wilayahResult->num_rows > 0) {
        $wilayahData = $wilayahResult->fetch_assoc();
        $wilayahName = $wilayahData['nama_wilayah'];
    }
} else {
    $surveyTitle = "No Survey Found";
    $wilayahName = "Unknown";
}

// Function to fetch latest data from a table
function fetchLatestData($conn, $tableName) {
    $sql = "SELECT * FROM $tableName ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

$genderData = fetchLatestData($conn, 'gender');
$usiaData = fetchLatestData($conn, 'usia');
$lulusanData = fetchLatestData($conn, 'lulusan');
$profesiData = fetchLatestData($conn, 'profesi');

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tambah Survey</title>
      <link rel="stylesheet" href="../CSS/Admin_Main.css">
      <link rel="stylesheet" href="../CSS/Admin_Tambah_Survey_Hal3.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <script src="https://kit.fontawesome.com/ae643ea90b.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


</head>

<body>
      <div id="header"></div>
      <div id="aside"></div>
      <main id="content">
            <section id="Tambah_Survey">
                  <i class="fa-solid fa-bars"></i>
                  <h2>Tambah Survey</h2>
            </section>
            <div class="tambah_survei">
                  <h2><span class="Tambah-Survei"><?php echo htmlspecialchars($surveyTitle); ?></span></h2>
            </div>
            <div class="tab-container-wrapper">
                  <div class="tab-container">
                        <button id="table-button" class="tab active">Tabel Data</button>
                        <button id="chart-button" class="tab ">Grafik</button>
                  </div>
                  <div class="sort-box">
                        <h4>Wilayah : <span><?php echo htmlspecialchars($wilayahName); ?></span></h4>
                  </div>
            </div>
            <div id="table" class="table" style="display: block;">
                  <h3>Gender</h3>
                  <table>
                        <thead>
                              <tr>
                                    <th>Kategori</th>
                                    <th>Sangat Puas</th>
                                    <th>Puas</th>
                                    <th>Kurang Puas</th>
                                    <th>Sangat Kurang Puas</th>
                                    <th>Total</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php
                              if ($genderData) {
                                    echo "
                                    <tr>
                                          <td>Laki - Laki</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['total_responden_laki_laki']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Perempuan</td>
                                          <td>" . htmlspecialchars($genderData['perempuan_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['perempuan_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['perempuan_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['perempuan_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['total_responden_perempuan']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_sangat_puas'] + $genderData['perempuan_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_puas'] + $genderData['perempuan_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_kurang_puas'] + $genderData['perempuan_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['laki_laki_sangat_kurang_puas'] + $genderData['perempuan_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($genderData['total_responden_gender']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>" . number_format((($genderData['laki_laki_sangat_puas'] + $genderData['perempuan_sangat_puas']) / $genderData['total_responden_gender']) * 100, 2) . "%</td>
                                          <td>" . number_format((($genderData['laki_laki_puas'] + $genderData['perempuan_puas']) / $genderData['total_responden_gender']) * 100, 2) . "%</td>
                                          <td>" . number_format((($genderData['laki_laki_kurang_puas'] + $genderData['perempuan_kurang_puas']) / $genderData['total_responden_gender']) * 100, 2) . "%</td>
                                          <td>" . number_format((($genderData['laki_laki_sangat_kurang_puas'] + $genderData['perempuan_sangat_kurang_puas']) / $genderData['total_responden_gender']) * 100, 2) . "%</td>
                                          <td>100%</td>
                                    </tr>";
                              }
                              ?>
                        </tbody>
                  </table>
                  <h3>Usia</h3>
                  <table>
                        <thead>
                              <tr>
                                    <th>Kategori</th>
                                    <th>Sangat Puas</th>
                                    <th>Puas</th>
                                    <th>Kurang Puas</th>
                                    <th>Sangat Kurang Puas</th>
                                    <th>Total</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php
                              if ($usiaData) {
                                    echo "
                                    <tr>
                                          <td>Usia 18 - 35 Tahun</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['total_responden_18_35']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Usia 36 Tahun ke Atas</td>
                                          <td>" . htmlspecialchars($usiaData['36_up_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['36_up_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['36_up_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['36_up_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['total_responden_36_up']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_sangat_puas'] + $usiaData['36_up_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_puas'] + $usiaData['36_up_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_kurang_puas'] + $usiaData['36_up_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['18_35_sangat_kurang_puas'] + $usiaData['36_up_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($usiaData['total_responden_usia']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>" . number_format((($usiaData['18_35_sangat_puas'] + $usiaData['36_up_sangat_puas']) / $usiaData['total_responden_usia']) * 100, 2) . "%</td>
                                          <td>" . number_format((($usiaData['18_35_puas'] + $usiaData['36_up_puas']) / $usiaData['total_responden_usia']) * 100, 2) . "%</td>
                                          <td>" . number_format((($usiaData['18_35_kurang_puas'] + $usiaData['36_up_kurang_puas']) / $usiaData['total_responden_usia']) * 100, 2) . "%</td>
                                          <td>" . number_format((($usiaData['18_35_sangat_kurang_puas'] + $usiaData['36_up_sangat_kurang_puas']) / $usiaData['total_responden_usia']) * 100, 2) . "%</td>
                                          <td>100%</td>
                                    </tr>";
                              }
                              ?>
                        </tbody>
                  </table>
                  <h3>Lulusan</h3>
                  <table>
                        <thead>
                              <tr>
                                    <th>Kategori</th>
                                    <th>Sangat Puas</th>
                                    <th>Puas</th>
                                    <th>Kurang Puas</th>
                                    <th>Sangat Kurang Puas</th>
                                    <th>Total</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php
                              if ($lulusanData) {
                                    echo "
                                    <tr>
                                          <td>Lulusan SD</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['total_responden_sd']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan SMP</td>
                                          <td>" . htmlspecialchars($lulusanData['smp_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['smp_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['smp_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['smp_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['total_responden_smp']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan SMA</td>
                                          <td>" . htmlspecialchars($lulusanData['sma_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sma_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sma_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sma_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['total_responden_sma']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan Diploma</td>
                                          <td>" . htmlspecialchars($lulusanData['diploma_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['diploma_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['diploma_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['diploma_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['total_responden_diploma']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan S1/S2/S3</td>
                                          <td>" . htmlspecialchars($lulusanData['sarjana_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sarjana_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sarjana_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['total_responden_sarjana']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_sangat_puas'] + $lulusanData['smp_sangat_puas'] + $lulusanData['sma_sangat_puas'] + $lulusanData['diploma_sangat_puas'] + $lulusanData['sarjana_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_puas'] + $lulusanData['smp_puas'] + $lulusanData['sma_puas'] + $lulusanData['diploma_puas'] + $lulusanData['sarjana_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_kurang_puas'] + $lulusanData['smp_kurang_puas'] + $lulusanData['sma_kurang_puas'] + $lulusanData['diploma_kurang_puas'] + $lulusanData['sarjana_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['sd_sangat_kurang_puas'] + $lulusanData['smp_sangat_kurang_puas'] + $lulusanData['sma_sangat_kurang_puas'] + $lulusanData['diploma_sangat_kurang_puas'] + $lulusanData['sarjana_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($lulusanData['total_responden_lulusan']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>" . number_format((($lulusanData['sd_sangat_puas'] + $lulusanData['smp_sangat_puas'] + $lulusanData['sma_sangat_puas'] + $lulusanData['diploma_sangat_puas'] + $lulusanData['sarjana_sangat_puas']) / $lulusanData['total_responden_lulusan']) * 100, 2) . "%</td>
                                          <td>" . number_format((($lulusanData['sd_puas'] + $lulusanData['smp_puas'] + $lulusanData['sma_puas'] + $lulusanData['diploma_puas'] + $lulusanData['sarjana_puas']) / $lulusanData['total_responden_lulusan']) * 100, 2) . "%</td>
                                          <td>" . number_format((($lulusanData['sd_kurang_puas'] + $lulusanData['smp_kurang_puas'] + $lulusanData['sma_kurang_puas'] + $lulusanData['diploma_kurang_puas'] + $lulusanData['sarjana_kurang_puas']) / $lulusanData['total_responden_lulusan']) * 100, 2) . "%</td>
                                          <td>" . number_format((($lulusanData['sd_sangat_kurang_puas'] + $lulusanData['smp_sangat_kurang_puas'] + $lulusanData['sma_sangat_kurang_puas'] + $lulusanData['diploma_sangat_kurang_puas'] + $lulusanData['sarjana_sangat_kurang_puas'])  / $lulusanData['total_responden_lulusan']) * 100, 2) . "%</td>
                                          <td>100%</td>
                                    </tr>";
                              }
                              ?>
                        </tbody>
                  </table>
                  <h3>Profesi</h3>
                  <table>
                        <thead>
                              <tr>
                                    <th>Kategori</th>
                                    <th>Sangat Puas</th>
                                    <th>Puas</th>
                                    <th>Kurang Puas</th>
                                    <th>Sangat Kurang Puas</th>
                                    <th>Total</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php
                              if ($profesiData) {
                                    echo "
                                    <tr>
                                          <td>PNS</td>
                                          <td>" . htmlspecialchars($profesiData['pns_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pns_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pns_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pns_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['total_responden_pns']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Swasta/Wiraswasta</td>
                                          <td>" . htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['swasta_wiraswasta_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['total_responden_swasta_wiraswasta']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Pelajar/Mahasiswa</td>
                                          <td>" . htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pelajar_mahasiswa_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['total_responden_pelajar_mahasiswa']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Pengangguran</td>
                                          <td>" . htmlspecialchars($profesiData['pengangguran_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pengangguran_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pengangguran_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['total_responden_pengangguran']) . "</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>" . htmlspecialchars($profesiData['pns_sangat_puas'] + $profesiData['swasta_wiraswasta_sangat_puas'] + $profesiData['pelajar_mahasiswa_sangat_puas'] + $profesiData['pengangguran_sangat_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pns_puas'] + $profesiData['swasta_wiraswasta_puas'] + $profesiData['pelajar_mahasiswa_puas'] + $profesiData['pengangguran_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pns_kurang_puas'] + $profesiData['swasta_wiraswasta_kurang_puas'] + $profesiData['pelajar_mahasiswa_kurang_puas'] + $profesiData['pengangguran_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['pns_sangat_kurang_puas'] + $profesiData['swasta_wiraswasta_sangat_kurang_puas'] + $profesiData['pelajar_mahasiswa_sangat_kurang_puas'] + $profesiData['pengangguran_sangat_kurang_puas']) . "</td>
                                          <td>" . htmlspecialchars($profesiData['total_responden_profesi']) . "</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>" . number_format((($profesiData['pns_sangat_puas'] + $profesiData['swasta_wiraswasta_sangat_puas'] + $profesiData['pelajar_mahasiswa_sangat_puas'] + $profesiData['pengangguran_sangat_puas']) / $profesiData['total_responden_profesi']) * 100, 2) . "%</td>
                                          <td>" . number_format((($profesiData['pns_puas'] + $profesiData['swasta_wiraswasta_puas'] + $profesiData['pelajar_mahasiswa_puas'] + $profesiData['pengangguran_puas']) / $profesiData['total_responden_profesi']) * 100, 2) . "%</td>
                                          <td>" . number_format((($profesiData['pns_kurang_puas'] + $profesiData['swasta_wiraswasta_kurang_puas'] + $profesiData['pelajar_mahasiswa_kurang_puas'] + $profesiData['pengangguran_kurang_puas']) / $profesiData['total_responden_profesi']) * 100, 2) . "%</td>
                                          <td>" . number_format((($profesiData['pns_sangat_kurang_puas'] + $profesiData['swasta_wiraswasta_sangat_kurang_puas'] + $profesiData['pelajar_mahasiswa_sangat_kurang_puas'] + $profesiData['pengangguran_sangat_kurang_puas'])  / $profesiData['total_responden_profesi']) * 100, 2) . "%</td>
                                          <td>100%</td>
                                    </tr>";
                              }
                              ?>
                        </tbody>
                  </table>
            </div>
            <div id="chart" class="grafik" style="display: none;">
                  <h3>Gender</h3>
                  <div class="Gender">
                        <canvas id="laki_laki"></canvas>
                        <canvas id="perempuan"></canvas>
                  </div>
                  <h3>Usia</h3>
                  <div class="Usia">
                        <canvas id="usia_18_35"></canvas>
                        <canvas id="usia_36_up"></canvas>
                  </div>
                  <h3>Lulusan</h3>
                  <div class="Lulusan">
                        <canvas id="sd"></canvas>
                        <canvas id="smp"></canvas>
                        <canvas id="sma"></canvas>
                        <canvas id="diploma"></canvas>
                        <canvas id="sarjana"></canvas>
                  </div>
                  <h3>Profesi</h3>
                  <div class="Profesi">
                        <canvas id="pns"></canvas>
                        <canvas id="swasta_wiraswasta"></canvas>
                        <canvas id="pelajar_mahasiswa"></canvas>
                        <canvas id="pengangguran"></canvas>
                  </div>
            </div>

            <div class="actions">
                  <a href="Admin_Tambah_Survey_Hal2.php" class="tombol-cancel"><i
                              class="fa-solid fa-arrow-left"></i><strong>Kembali</strong></a>
                  <a href="Admin_Hasil_Survey.php" class="tombol-publish"><i class="fa-solid fa-upload"></i>Publish</a>
            </div>
      </main>
      <script src="..\Js\Main.js"></script>
      <script src="..\Js\Detail_Survey.js"></script>
      <script>
      function createPieChart(ctx, titleText, data) {
            new Chart(ctx, {
                  type: 'pie',
                  data: {
                        labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                        datasets: [{
                              label: 'Jumlah Responden',
                              data: data,
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
                        layout: {
                              padding: {
                                    left: 10,
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
                                          bottom: 25
                                    }
                              },
                              legend: {
                                    position: 'left',
                                    labels: {
                                          font: {
                                                size: 10
                                          },
                                          boxWidth: 12,
                                          padding: 25
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

      // Chart untuk Gender - Laki-laki
      const dataLakiLaki = [
            <?php echo htmlspecialchars($genderData['laki_laki_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($genderData['laki_laki_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($genderData['laki_laki_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($genderData['laki_laki_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('laki_laki'), 'Kategori Laki-laki', dataLakiLaki);

      // Chart untuk Gender - Perempuan
      const dataPerempuan = [
            <?php echo htmlspecialchars($genderData['perempuan_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($genderData['perempuan_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($genderData['perempuan_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($genderData['perempuan_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('perempuan'), 'Kategori Perempuan', dataPerempuan);

      // Chart untuk Usia - 18-35 Tahun
      const dataUsia18_35 = [
            <?php echo htmlspecialchars($usiaData['18_35_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($usiaData['18_35_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($usiaData['18_35_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($usiaData['18_35_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('usia_18_35'), 'Usia 18-35 Tahun', dataUsia18_35);


      const dataUsia36Up = [
            <?php echo htmlspecialchars($usiaData['36_up_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($usiaData['36_up_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($usiaData['36_up_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($usiaData['36_up_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('usia_36_up'), 'Usia 36 Tahun ke atas', dataUsia36Up);


      const dataLulusanSD = [
            <?php echo htmlspecialchars($lulusanData['sd_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sd_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sd_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sd_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('sd'), 'Lulusan SD', dataLulusanSD);


      const dataprofesi = [
            <?php echo htmlspecialchars($lulusanData['smp_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['smp_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['smp_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['smp_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('smp'), 'Lulusan SD', dataprofesi);


      const dataLulusanSMA = [
            <?php echo htmlspecialchars($lulusanData['sma_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sma_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sma_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sma_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('sma'), 'Lulusan SD', dataLulusanSMA);


      const dataLulusanDiploma = [
            <?php echo htmlspecialchars($lulusanData['diploma_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['diploma_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['diploma_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['diploma_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('diploma'), 'Lulusan SD', dataLulusanDiploma);

      const dataLulusanSarjana = [
            <?php echo htmlspecialchars($lulusanData['sarjana_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sarjana_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sarjana_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanData['sarjana_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('sarjana'), 'Lulusan SD', dataLulusanSarjana);

      const dataProfesiPNS = [
            <?php echo htmlspecialchars($profesiData['pns_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pns_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pns_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pns_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('pns'), 'profesi SD', dataProfesiPNS);


      const dataProfesiSwasta_wiraswasta = [
            <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['swasta_wiraswasta_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('swasta_wiraswasta'), 'profesi SD', dataProfesiSwasta_wiraswasta);


      const dataProfesiPelajar_Mahasiswa = [
            <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pelajar_mahasiswa_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('pelajar_mahasiswa'), 'profesi SD', dataProfesiPelajar_Mahasiswa);

      const dataprofesiPengangguran = [
            <?php echo htmlspecialchars($profesiData['pengangguran_sangat_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pengangguran_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pengangguran_kurang_puas'] ?? 0); ?>,
            <?php echo htmlspecialchars($profesiData['pengangguran_sangat_kurang_puas'] ?? 0); ?>
      ];
      createPieChart(document.getElementById('pengangguran'), 'profesi SD', dataprofesiPengangguran);
      </script>
</body>

</html>