<?php
include 'Koneksi_survei_litbang.php';

// Fetch the latest survey
$sql = "SELECT * FROM survey ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$surveyTitle = $row['title'];
$surveyIdWilayah = $row['id_wilayah'];

// Fetch wilayah name
$sqlWilayah = "SELECT nama_wilayah FROM wilayah WHERE id = $surveyIdWilayah";            
$resultWilayah = $conn->query($sqlWilayah);
      if ($resultWilayah->num_rows > 0) {
          $rowWilayah = $resultWilayah->fetch_assoc();
            $wilayahName = $rowWilayah['nama_wilayah'];
      }
} else {
      $surveyTitle = "No Survey Found";
      $wilayahName = "Unknown";
}

// Fetch the latest data for gender
$sqlGender = "SELECT * FROM gender ORDER BY id DESC LIMIT 1";
$resultGender = $conn->query($sqlGender);
    
// Fetch the latest data for usia
$sqlUsia = "SELECT * FROM usia ORDER BY id DESC LIMIT 1";
$resultUsia = $conn->query($sqlUsia);
    
// Fetch the latest data for lulusan
$sqlLulusan = "SELECT * FROM lulusan ORDER BY id DESC LIMIT 1";
$resultLulusan = $conn->query($sqlLulusan);
    
// Fetch the latest data for profesi
$sqlProfesi = "SELECT * FROM profesi ORDER BY id DESC LIMIT 1";
$resultProfesi = $conn->query($sqlProfesi);
    
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
                        if ($resultGender->num_rows > 0) {
                            $rowGender = $resultGender->fetch_assoc();
                            echo "<tr>
                                    <td>Laki-laki</td>
                                        <td>{$rowGender['laki_laki_sangat_puas']}</td>
                                        <td>{$rowGender['laki_laki_puas']}</td>
                                        <td>{$rowGender['laki_laki_kurang_puas']}</td>
                                        <td>{$rowGender['laki_laki_sangat_kurang_puas']}</td>
                                        <td>{$rowGender['total_responden_laki_laki']}</td>
                                    </tr>
                                    <tr>
                                        <td>Perempuan</td>
                                        <td>{$rowGender['perempuan_sangat_puas']}</td>
                                        <td>{$rowGender['perempuan_puas']}</td>
                                        <td>{$rowGender['perempuan_kurang_puas']}</td>
                                        <td>{$rowGender['perempuan_sangat_kurang_puas']}</td>
                                        <td>{$rowGender['total_responden_perempuan']}</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>{$rowGender['total_sangat_puas_gender']}</td>
                                          <td>{$rowGender['total_puas_gender']}</td>
                                          <td>{$rowGender['total_kurang_puas_gender']}</td>
                                          <td>{$rowGender['total_sangat_kurang_puas_gender']}</td>
                                          <td>{$rowGender['total_responden_gender']}</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>{$rowGender['persentase_sangat_puas_gender']}%</td>
                                          <td>{$rowGender['persentase_puas_gender']}%</td>
                                          <td>{$rowGender['persentase_kurang_puas_gender']}%</td>
                                          <td>{$rowGender['persentase_sangat_kurang_puas_gender']}%</td>
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
                        if ($resultUsia->num_rows > 0) {
                            $rowUsia = $resultUsia->fetch_assoc();
                            echo "<tr>
                                        <td>18-35 Tahun</td>
                                        <td>{$rowUsia['18_35_sangat_puas']}</td>
                                        <td>{$rowUsia['18_35_puas']}</td>
                                        <td>{$rowUsia['18_35_kurang_puas']}</td>
                                        <td>{$rowUsia['18_35_sangat_kurang_puas']}</td>
                                        <td>{$rowUsia['total_responden_18_35']}</td>
                                    </tr>
                                    <tr>
                                        <td>36 Tahun ke atas</td>
                                        <td>{$rowUsia['36_up_sangat_puas']}</td>
                                        <td>{$rowUsia['36_up_puas']}</td>
                                        <td>{$rowUsia['36_up_kurang_puas']}</td>
                                        <td>{$rowUsia['36_up_sangat_kurang_puas']}</td>
                                        <td>{$rowUsia['total_responden_36_up']}</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>{$rowUsia['total_sangat_puas_usia']}</td>
                                          <td>{$rowUsia['total_puas_usia']}</td>
                                          <td>{$rowUsia['total_kurang_puas_usia']}</td>
                                          <td>{$rowUsia['total_sangat_kurang_puas_usia']}</td>
                                          <td>{$rowUsia['total_responden_usia']}</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>{$rowUsia['persentase_sangat_puas_usia']}%</td>
                                          <td>{$rowUsia['persentase_puas_usia']}%</td>
                                          <td>{$rowUsia['persentase_kurang_puas_usia']}%</td>
                                          <td>{$rowUsia['persentase_sangat_kurang_puas_usia']}%</td>
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
                        if ($resultLulusan->num_rows > 0) {
                            $rowLulusan = $resultLulusan->fetch_assoc();
                            echo "<tr>
                                        <td>SD</td>
                                        <td>{$rowLulusan['sd_sangat_puas']}</td>
                                        <td>{$rowLulusan['sd_puas']}</td>
                                        <td>{$rowLulusan['sd_kurang_puas']}</td>
                                        <td>{$rowLulusan['sd_sangat_kurang_puas']}</td>
                                        <td>{$rowLulusan['total_responden_sd']}</td>
                                    </tr>
                                    <tr>
                                        <td>SMP</td>
                                        <td>{$rowLulusan['smp_sangat_puas']}</td>
                                        <td>{$rowLulusan['smp_puas']}</td>
                                        <td>{$rowLulusan['smp_kurang_puas']}</td>
                                        <td>{$rowLulusan['smp_sangat_kurang_puas']}</td>
                                        <td>{$rowLulusan['total_responden_smp']}</td>
                                    </tr>
                                    <tr>
                                        <td>SMA</td>
                                        <td>{$rowLulusan['sma_sangat_puas']}</td>
                                        <td>{$rowLulusan['sma_puas']}</td>
                                        <td>{$rowLulusan['sma_kurang_puas']}</td>
                                        <td>{$rowLulusan['sma_sangat_kurang_puas']}</td>
                                        <td>{$rowLulusan['total_responden_sma']}</td>
                                    </tr>
                                    <tr>
                                        <td>Diploma</td>
                                        <td>{$rowLulusan['diploma_sangat_puas']}</td>
                                        <td>{$rowLulusan['diploma_puas']}</td>
                                        <td>{$rowLulusan['diploma_kurang_puas']}</td>
                                        <td>{$rowLulusan['diploma_sangat_kurang_puas']}</td>
                                        <td>{$rowLulusan['total_responden_diploma']}</td>
                                    </tr>
                                    <tr>
                                        <td>S1/S2/S3</td>
                                        <td>{$rowLulusan['sarjana_sangat_puas']}</td>
                                        <td>{$rowLulusan['sarjana_puas']}</td>
                                        <td>{$rowLulusan['sarjana_kurang_puas']}</td>
                                        <td>{$rowLulusan['sarjana_sangat_kurang_puas']}</td>
                                        <td>{$rowLulusan['total_responden_sarjana']}</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>{$rowLulusan['total_sangat_puas_lulusan']}</td>
                                          <td>{$rowLulusan['total_puas_lulusan']}</td>
                                          <td>{$rowLulusan['total_kurang_puas_lulusan']}</td>
                                          <td>{$rowLulusan['total_sangat_kurang_puas_lulusan']}</td>
                                          <td>{$rowLulusan['total_responden_lulusan']}</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>{$rowLulusan['persentase_sangat_puas_lulusan']}%</td>
                                          <td>{$rowLulusan['persentase_puas_lulusan']}%</td>
                                          <td>{$rowLulusan['persentase_kurang_puas_lulusan']}%</td>
                                          <td>{$rowLulusan['persentase_sangat_kurang_puas_lulusan']}%</td>
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
                        if ($resultProfesi->num_rows > 0) {
                            $rowProfesi = $resultProfesi->fetch_assoc();
                            echo "<tr>
                                        <td>PNS</td>
                                        <td>{$rowProfesi['pns_sangat_puas']}</td>
                                        <td>{$rowProfesi['pns_puas']}</td>
                                        <td>{$rowProfesi['pns_kurang_puas']}</td>
                                        <td>{$rowProfesi['pns_sangat_kurang_puas']}</td>
                                        <td>{$rowProfesi['total_responden_pns']}</td>
                                    </tr>
                                    <tr>
                                        <td>Swasta/Wiraswasta</td>
                                        <td>{$rowProfesi['swasta_wiraswasta_sangat_puas']}</td>
                                        <td>{$rowProfesi['swasta_wiraswasta_puas']}</td>
                                        <td>{$rowProfesi['swasta_wiraswasta_kurang_puas']}</td>
                                        <td>{$rowProfesi['swasta_wiraswasta_sangat_kurang_puas']}</td>
                                        <td>{$rowProfesi['total_responden_swasta_wiraswasta']}</td>
                                    </tr>
                                    <tr>
                                        <td>Pelajar/Mahasiswa</td>
                                        <td>{$rowProfesi['pelajar_mahasiswa_sangat_puas']}</td>
                                        <td>{$rowProfesi['pelajar_mahasiswa_puas']}</td>
                                        <td>{$rowProfesi['pelajar_mahasiswa_kurang_puas']}</td>
                                        <td>{$rowProfesi['pelajar_mahasiswa_sangat_kurang_puas']}</td>
                                        <td>{$rowProfesi['total_responden_pelajar_mahasiswa']}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengangguran</td>
                                        <td>{$rowProfesi['pengangguran_sangat_puas']}</td>
                                        <td>{$rowProfesi['pengangguran_puas']}</td>
                                        <td>{$rowProfesi['pengangguran_kurang_puas']}</td>
                                        <td>{$rowProfesi['pengangguran_sangat_kurang_puas']}</td>
                                        <td>{$rowProfesi['total_responden_pengangguran']}</td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td>{$rowProfesi['total_sangat_puas_profesi']}</td>
                                          <td>{$rowProfesi['total_puas_profesi']}</td>
                                          <td>{$rowProfesi['total_kurang_puas_profesi']}</td>
                                          <td>{$rowProfesi['total_sangat_kurang_puas_profesi']}</td>
                                          <td>{$rowProfesi['total_responden_profesi']}</td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td>{$rowProfesi['persentase_sangat_puas_profesi']}%</td>
                                          <td>{$rowProfesi['persentase_puas_profesi']}%</td>
                                          <td>{$rowProfesi['persentase_kurang_puas_profesi']}%</td>
                                          <td>{$rowProfesi['persentase_sangat_kurang_puas_profesi']}%</td>
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
      // Chart untuk Gender - Laki-laki
      const chart_laki_laki = document.getElementById('laki_laki');
      new Chart(chart_laki_laki, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowGender['laki_laki_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowGender['laki_laki_puas'] ?? 0; ?>,
                              <?php echo $rowGender['laki_laki_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowGender['laki_laki_sangat_kurang_puas'] ?? 0; ?>
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
                                    bottom: 10
                              }
                        },
                        legend: {
                              position: 'left',
                              labels: {
                                    font: {
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
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
                              <?php echo $rowGender['perempuan_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowGender['perempuan_puas'] ?? 0; ?>,
                              <?php echo $rowGender['perempuan_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowGender['perempuan_sangat_kurang_puas'] ?? 0; ?>
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
                  layout: {
                        padding: {
                              left: 5,
                              top: 10,
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Usia - 18-35 Tahun
      const chart_usia_18_35 = document.getElementById('usia_18_35');
      new Chart(chart_usia_18_35, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowUsia['18_35_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowUsia['18_35_puas'] ?? 0; ?>,
                              <?php echo $rowUsia['18_35_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowUsia['18_35_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Usia 18-35 Tahun',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Usia - 36 Tahun ke atas
      const chart_usia_36_up = document.getElementById('usia_36_up');
      new Chart(chart_usia_36_up, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowUsia['36_up_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowUsia['36_up_puas'] ?? 0; ?>,
                              <?php echo $rowUsia['36_up_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowUsia['36_up_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Usia 36 Tahun ke atas',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
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
                              <?php echo $rowLulusan['sd_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sd_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sd_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sd_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Lulusan SD',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
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
                              <?php echo $rowLulusan['smp_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['smp_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['smp_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['smp_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Lulusan SMP',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
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
                              <?php echo $rowLulusan['sma_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sma_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sma_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sma_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Lulusan SMA',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Lulusan - Perguruan Tinggi
      const chart_diploma = document.getElementById('diploma');
      new Chart(chart_diploma, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowLulusan['diploma_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['diploma_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['diploma_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['diploma_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Lulusan Diploma',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Profesi - Karyawan
      const chart_Sarjana = document.getElementById('sarjana');
      new Chart(chart_Sarjana, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowLulusan['sarjana_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sarjana_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sarjana_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowLulusan['sarjana_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Lulusan Sarjana',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Profesi - Wirausaha
      const chart_pns = document.getElementById('pns');
      new Chart(chart_pns, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowProfesi['pns_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pns_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pns_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pns_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Profesi Wirausaha',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Profesi - Lainnya
      const chart_swasta_wiraswasta = document.getElementById('swasta_wiraswasta');
      new Chart(chart_swasta_wiraswasta, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowProfesi['swasta_wiraswasta_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['swasta_wiraswasta_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['swasta_wiraswasta_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['swasta_wiraswasta_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Profesi Swasta & Wiraswasta',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Profesi - Lainnya
      const chart_pelajar_mahasiswa = document.getElementById('pelajar_mahasiswa');
      new Chart(chart_pelajar_mahasiswa, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowProfesi['pelajar_mahasiswa_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pelajar_mahasiswa_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pelajar_mahasiswa_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pelajar_mahasiswa_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Profesi Pelajar & Mahasiswa',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });

      // Chart untuk Profesi - Lainnya
      const chart_Pengangguran = document.getElementById('pengangguran');
      new Chart(chart_Pengangguran, {
            type: 'pie',
            data: {
                  labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Sangat Kurang Puas'],
                  datasets: [{
                        label: 'Jumlah Responden',
                        data: [
                              <?php echo $rowProfesi['pengangguran_sangat_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pengangguran_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pengangguran_kurang_puas'] ?? 0; ?>,
                              <?php echo $rowProfesi['pengangguran_sangat_kurang_puas'] ?? 0; ?>
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
                              text: 'Profesi Pengangguran',
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
                                          size: 10 // Adjust font size for legend
                                    },
                                    boxWidth: 12 // Adjust the width of the color box
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
                                    size: 10 // Adjust font size for data labels
                              }
                        }
                  }
            },
            plugins: [ChartDataLabels]
      });
      </script>
</body>

</html>