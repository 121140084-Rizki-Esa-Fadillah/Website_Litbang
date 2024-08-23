<?php
session_start(); 
include 'Koneksi_survei_litbang.php';

// Retrieve existing data from session
$judulSurvey = isset($_SESSION['judul-survey']) ? htmlspecialchars($_SESSION['judul-survey']) : 'No Title';
$idWilayah = isset($_SESSION['id_wilayah']) ? intval($_SESSION['id_wilayah']) : 0;

// Retrieve gender-related data from session
$genderSangatPuasLaki = isset($_SESSION['gender_sangat_puas_laki']) ? $_SESSION['gender_sangat_puas_laki'] : 0;
$genderPuasLaki = isset($_SESSION['gender_puas_laki']) ? $_SESSION['gender_puas_laki'] : 0;
$genderKurangPuasLaki = isset($_SESSION['gender_kurang_puas_laki']) ? $_SESSION['gender_kurang_puas_laki'] : 0;
$genderSangatKurangPuasLaki = isset($_SESSION['gender_sangat_kurang_puas_laki']) ? $_SESSION['gender_sangat_kurang_puas_laki'] : 0;

$genderSangatPuasPerempuan = isset($_SESSION['gender_sangat_puas_perempuan']) ? $_SESSION['gender_sangat_puas_perempuan'] : 0;
$genderPuasPerempuan = isset($_SESSION['gender_puas_perempuan']) ? $_SESSION['gender_puas_perempuan'] : 0;
$genderKurangPuasPerempuan = isset($_SESSION['gender_kurang_puas_perempuan']) ? $_SESSION['gender_kurang_puas_perempuan'] : 0;
$genderSangatKurangPuasPerempuan = isset($_SESSION['gender_sangat_kurang_puas_perempuan']) ? $_SESSION['gender_sangat_kurang_puas_perempuan'] : 0;

// Retrieve age-related data from session
$usiaSangatPuas18_35 = isset($_SESSION['usia_sangat_puas_18_35']) ? $_SESSION['usia_sangat_puas_18_35'] : 0;
$usiaPuas18_35 = isset($_SESSION['usia_puas_18_35']) ? $_SESSION['usia_puas_18_35'] : 0;
$usiaKurangPuas18_35 = isset($_SESSION['usia_kurang_puas_18_35']) ? $_SESSION['usia_kurang_puas_18_35'] : 0;
$usiaSangatKurangPuas18_35 = isset($_SESSION['usia_sangat_kurang_puas_18_35']) ? $_SESSION['usia_sangat_kurang_puas_18_35'] : 0;

$usiaSangatPuas36Plus = isset($_SESSION['usia_sangat_puas_36_plus']) ? $_SESSION['usia_sangat_puas_36_plus'] : 0;
$usiaPuas36Plus = isset($_SESSION['usia_puas_36_plus']) ? $_SESSION['usia_puas_36_plus'] : 0;
$usiaKurangPuas36Plus = isset($_SESSION['usia_kurang_puas_36_plus']) ? $_SESSION['usia_kurang_puas_36_plus'] : 0;
$usiaSangatKurangPuas36Plus = isset($_SESSION['usia_sangat_kurang_puas_36_plus']) ? $_SESSION['usia_sangat_kurang_puas_36_plus'] : 0;

// Retrieve education-related data from session
$lulusanSangatPuasSD = isset($_SESSION['lulusan_sangat_puas_sd']) ? $_SESSION['lulusan_sangat_puas_sd'] : 0;
$lulusanPuasSD = isset($_SESSION['lulusan_puas_sd']) ? $_SESSION['lulusan_puas_sd'] : 0;
$lulusanKurangPuasSD = isset($_SESSION['lulusan_kurang_puas_sd']) ? $_SESSION['lulusan_kurang_puas_sd'] : 0;
$lulusanSangatKurangPuasSD = isset($_SESSION['lulusan_sangat_kurang_puas_sd']) ? $_SESSION['lulusan_sangat_kurang_puas_sd'] : 0;

$lulusanSangatPuasSMP = isset($_SESSION['lulusan_sangat_puas_smp']) ? $_SESSION['lulusan_sangat_puas_smp'] : 0;
$lulusanPuasSMP = isset($_SESSION['lulusan_puas_smp']) ? $_SESSION['lulusan_puas_smp'] : 0;
$lulusanKurangPuasSMP = isset($_SESSION['lulusan_kurang_puas_smp']) ? $_SESSION['lulusan_kurang_puas_smp'] : 0;
$lulusanSangatKurangPuasSMP = isset($_SESSION['lulusan_sangat_kurang_puas_smp']) ? $_SESSION['lulusan_sangat_kurang_puas_smp'] : 0;

$lulusanSangatPuasSMA = isset($_SESSION['lulusan_sangat_puas_sma']) ? $_SESSION['lulusan_sangat_puas_sma'] : 0;
$lulusanPuasSMA = isset($_SESSION['lulusan_puas_sma']) ? $_SESSION['lulusan_puas_sma'] : 0;
$lulusanKurangPuasSMA = isset($_SESSION['lulusan_kurang_puas_sma']) ? $_SESSION['lulusan_kurang_puas_sma'] : 0;
$lulusanSangatKurangPuasSMA = isset($_SESSION['lulusan_sangat_kurang_puas_sma']) ? $_SESSION['lulusan_sangat_kurang_puas_sma'] : 0;

$lulusanSangatPuasDiploma = isset($_SESSION['lulusan_sangat_puas_diploma']) ? $_SESSION['lulusan_sangat_puas_diploma'] : 0;
$lulusanPuasDiploma = isset($_SESSION['lulusan_puas_diploma']) ? $_SESSION['lulusan_puas_diploma'] : 0;
$lulusanKurangPuasDiploma = isset($_SESSION['lulusan_kurang_puas_diploma']) ? $_SESSION['lulusan_kurang_puas_diploma'] : 0;
$lulusanSangatKurangPuasDiploma = isset($_SESSION['lulusan_sangat_kurang_puas_diploma']) ? $_SESSION['lulusan_sangat_kurang_puas_diploma'] : 0;

$lulusanSangatPuasSarjana = isset($_SESSION['lulusan_sangat_puas_sarjana']) ? $_SESSION['lulusan_sangat_puas_sarjana'] : 0;
$lulusanPuasSarjana = isset($_SESSION['lulusan_puas_sarjana']) ? $_SESSION['lulusan_puas_sarjana'] : 0;
$lulusanKurangPuasSarjana = isset($_SESSION['lulusan_kurang_puas_sarjana']) ? $_SESSION['lulusan_kurang_puas_sarjana'] : 0;
$lulusanSangatKurangPuasSarjana = isset($_SESSION['lulusan_sangat_kurang_puas_sarjana']) ? $_SESSION['lulusan_sangat_kurang_puas_sarjana'] : 0;

// Retrieve profession-related data from session
$profesiSangatPuasPNS = isset($_SESSION['profesi_sangat_puas_pns']) ? $_SESSION['profesi_sangat_puas_pns'] : 0;
$profesiPuasPNS = isset($_SESSION['profesi_puas_pns']) ? $_SESSION['profesi_puas_pns'] : 0;
$profesiKurangPuasPNS = isset($_SESSION['profesi_kurang_puas_pns']) ? $_SESSION['profesi_kurang_puas_pns'] : 0;
$profesiSangatKurangPuasPNS = isset($_SESSION['profesi_sangat_kurang_puas_pns']) ? $_SESSION['profesi_sangat_kurang_puas_pns'] : 0;

$profesiSangatPuasSwastaWiraswasta = isset($_SESSION['profesi_sangat_puas_swasta_wiraswasta']) ? $_SESSION['profesi_sangat_puas_swasta_wiraswasta'] : 0;
$profesiPuasSwastaWiraswasta = isset($_SESSION['profesi_puas_swasta_wiraswasta']) ? $_SESSION['profesi_puas_swasta_wiraswasta'] : 0;
$profesiKurangPuasSwastaWiraswasta = isset($_SESSION['profesi_kurang_puas_swasta_wiraswasta']) ? $_SESSION['profesi_kurang_puas_swasta_wiraswasta'] : 0;
$profesiSangatKurangPuasSwastaWiraswasta = isset($_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta']) ? $_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta'] : 0;

$profesiSangatPuasPelajarMahasiswa = isset($_SESSION['profesi_sangat_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_sangat_puas_pelajar_mahasiswa'] : 0;
$profesiPuasPelajarMahasiswa = isset($_SESSION['profesi_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_puas_pelajar_mahasiswa'] : 0;
$profesiKurangPuasPelajarMahasiswa = isset($_SESSION['profesi_kurang_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_kurang_puas_pelajar_mahasiswa'] : 0;
$profesiSangatKurangPuasPelajarMahasiswa = isset($_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa'] : 0;

$profesiSangatPuasPengangguran = isset($_SESSION['profesi_sangat_puas_pengangguran']) ? $_SESSION['profesi_sangat_puas_pengangguran'] : 0;
$profesiPuasPengangguran = isset($_SESSION['profesi_puas_pengangguran']) ? $_SESSION['profesi_puas_pengangguran'] : 0;
$profesiKurangPuasPengangguran = isset($_SESSION['profesi_kurang_puas_pengangguran']) ? $_SESSION['profesi_kurang_puas_pengangguran'] : 0;
$profesiSangatKurangPuasPengangguran = isset($_SESSION['profesi_sangat_kurang_puas_pengangguran']) ? $_SESSION['profesi_sangat_kurang_puas_pengangguran'] : 0;

// Retrieve totals from session
$totalRespondenLakiLaki = isset($_SESSION['total_responden_laki_laki']) ? $_SESSION['total_responden_laki_laki'] : 0;
$totalRespondenPerempuan = isset($_SESSION['total_responden_perempuan']) ? $_SESSION['total_responden_perempuan'] : 0;
$totalRespondenGender = isset($_SESSION['total_responden_gender']) ? $_SESSION['total_responden_gender'] : 0;

$totalResponden18_35 = isset($_SESSION['total_responden_18_35']) ? $_SESSION['total_responden_18_35'] : 0;
$totalResponden36Plus = isset($_SESSION['total_responden_36_up']) ? $_SESSION['total_responden_36_up'] : 0;
$totalRespondenUsia = isset($_SESSION['total_responden_usia']) ? $_SESSION['total_responden_usia'] : 0;

$totalRespondenSD = isset($_SESSION['total_responden_sd']) ? $_SESSION['total_responden_sd'] : 0;
$totalRespondenSMP = isset($_SESSION['total_responden_smp']) ? $_SESSION['total_responden_smp'] : 0;
$totalRespondenSMA = isset($_SESSION['total_responden_sma']) ? $_SESSION['total_responden_sma'] : 0;
$totalRespondenDiploma = isset($_SESSION['total_responden_diploma']) ? $_SESSION['total_responden_diploma'] : 0;
$totalRespondenSarjana = isset($_SESSION['total_responden_sarjana']) ? $_SESSION['total_responden_sarjana'] : 0;
$totalRespondenLulusan = isset($_SESSION['total_responden_lulusan']) ? $_SESSION['total_responden_lulusan'] : 0;

$totalRespondenPNS = isset($_SESSION['total_responden_pns']) ? $_SESSION['total_responden_pns'] : 0;
$totalRespondenSwastaWiraswasta = isset($_SESSION['total_responden_swasta_wiraswasta']) ? $_SESSION['total_responden_swasta_wiraswasta'] : 0;
$totalRespondenPelajarMahasiswa = isset($_SESSION['total_responden_pelajar_mahasiswa']) ? $_SESSION['total_responden_pelajar_mahasiswa'] : 0;
$totalRespondenPengangguran = isset($_SESSION['total_responden_pengangguran']) ? $_SESSION['total_responden_pengangguran'] : 0;
$totalRespondenProfesi = isset($_SESSION['total_responden_profesi']) ? $_SESSION['total_responden_profesi'] : 0;

// Ambil nama wilayah jika id_wilayah valid
$wilayahName = 'Unknown';
if ($idWilayah > 0) {
    $sqlWilayah = "SELECT nama_wilayah FROM wilayah WHERE id = ?";
    $stmtWilayah = $conn->prepare($sqlWilayah);
    if ($stmtWilayah === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmtWilayah->bind_param("i", $idWilayah);
    $stmtWilayah->execute();
    $wilayahResult = $stmtWilayah->get_result();
    
    if ($wilayahResult->num_rows > 0) {
        $wilayahData = $wilayahResult->fetch_assoc();
        $wilayahName = htmlspecialchars($wilayahData['nama_wilayah']);
    }
}

// Periksa apakah formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['publish'])) {
      $judul = $_SESSION['judul-survey'];
      $keterangan = $_SESSION['keterangan'];
      $id_wilayah = $_SESSION['id_wilayah'];
      $image = $_SESSION['image'];
  
      // Periksa apakah variabel sesi diatur
      if (empty($judul) || empty($keterangan) || empty($id_wilayah)) {
          echo "<script>alert('Data tidak lengkap!'); window.location.href='Admin_Tambah_Survey_Hal1.php';</script>";
          exit();
      }
  
      // Query SQL untuk memasukkan data survei
      $query = "INSERT INTO survey (title, keterangan, id_wilayah, image) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($query);
  
      if ($stmt === false) {
          die('Prepare failed: ' . htmlspecialchars($conn->error));
      }
  
      $stmt->bind_param("ssis", $judul, $keterangan, $id_wilayah, $image);
  
      if ($stmt->execute()) {
          $id_survey = $conn->insert_id; // Ambil ID survei yang baru dimasukkan
  
          // Ambil data dari POST
          $gender_sangat_puas_laki = $_SESSION['gender_sangat_puas_laki'] ?? 0;
          $gender_puas_laki = $_SESSION['gender_puas_laki'] ?? 0;
          $gender_kurang_puas_laki = $_SESSION['gender_kurang_puas_laki'] ?? 0;
          $gender_sangat_kurang_puas_laki = $_SESSION['gender_sangat_kurang_puas_laki'] ?? 0;
          $gender_sangat_puas_perempuan = $_SESSION['gender_sangat_puas_perempuan'] ?? 0;
          $gender_puas_perempuan = $_SESSION['gender_puas_perempuan'] ?? 0;
          $gender_kurang_puas_perempuan = $_SESSION['gender_kurang_puas_perempuan'] ?? 0;
          $gender_sangat_kurang_puas_perempuan = $_SESSION['gender_sangat_kurang_puas_perempuan'] ?? 0;
          $total_responden_laki_laki = $_SESSION['total_responden_laki_laki'] ?? 0;
          $total_responden_perempuan = $_SESSION['total_responden_perempuan'] ?? 0;
          $total_responden_gender = $_SESSION['total_responden_gender'] ?? 0;
  
          $usia_sangat_puas_18_35 = $_SESSION['usia_sangat_puas_18_35'] ?? 0;
          $usia_puas_18_35 = $_SESSION['usia_puas_18_35'] ?? 0;
          $usia_kurang_puas_18_35 = $_SESSION['usia_kurang_puas_18_35'] ?? 0;
          $usia_sangat_kurang_puas_18_35 = $_SESSION['usia_sangat_kurang_puas_18_35'] ?? 0;
          $usia_sangat_puas_36_plus = $_SESSION['usia_sangat_puas_36_plus'] ?? 0;
          $usia_puas_36_plus = $_SESSION['usia_puas_36_plus'] ?? 0;
          $usia_kurang_puas_36_plus = $_SESSION['usia_kurang_puas_36_plus'] ?? 0;
          $usia_sangat_kurang_puas_36_plus = $_SESSION['usia_sangat_kurang_puas_36_plus'] ?? 0;
          $total_responden_18_35 = $_SESSION['total_responden_18_35'] ?? 0;
          $total_responden_36_up = $_SESSION['total_responden_36_up'] ?? 0;
          $total_responden_usia = $_SESSION['total_responden_usia'] ?? 0;
  
          $lulusan_sangat_puas_sd = $_SESSION['lulusan_sangat_puas_sd'] ?? 0;
          $lulusan_puas_sd = $_SESSION['lulusan_puas_sd'] ?? 0;
          $lulusan_kurang_puas_sd = $_SESSION['lulusan_kurang_puas_sd'] ?? 0;
          $lulusan_sangat_kurang_puas_sd = $_SESSION['lulusan_sangat_kurang_puas_sd'] ?? 0;
          $lulusan_sangat_puas_smp = $_SESSION['lulusan_sangat_puas_smp'] ?? 0;
          $lulusan_puas_smp = $_SESSION['lulusan_puas_smp'] ?? 0;
          $lulusan_kurang_puas_smp = $_SESSION['lulusan_kurang_puas_smp'] ?? 0;
          $lulusan_sangat_kurang_puas_smp = $_SESSION['lulusan_sangat_kurang_puas_smp'] ?? 0;
          $lulusan_sangat_puas_sma = $_SESSION['lulusan_sangat_puas_sma'] ?? 0;
          $lulusan_puas_sma = $_SESSION['lulusan_puas_sma'] ?? 0;
          $lulusan_kurang_puas_sma = $_SESSION['lulusan_kurang_puas_sma'] ?? 0;
          $lulusan_sangat_kurang_puas_sma = $_SESSION['lulusan_sangat_kurang_puas_sma'] ?? 0;
          $lulusan_sangat_puas_diploma = $_SESSION['lulusan_sangat_puas_diploma'] ?? 0;
          $lulusan_puas_diploma = $_SESSION['lulusan_puas_diploma'] ?? 0;
          $lulusan_kurang_puas_diploma = $_SESSION['lulusan_kurang_puas_diploma'] ?? 0;
          $lulusan_sangat_kurang_puas_diploma = $_SESSION['lulusan_sangat_kurang_puas_diploma'] ?? 0;
          $lulusan_sangat_puas_sarjana = $_SESSION['lulusan_sangat_puas_sarjana'] ?? 0;
          $lulusan_puas_sarjana = $_SESSION['lulusan_puas_sarjana'] ?? 0;
          $lulusan_kurang_puas_sarjana = $_SESSION['lulusan_kurang_puas_sarjana'] ?? 0;
          $lulusan_sangat_kurang_puas_sarjana = $_SESSION['lulusan_sangat_kurang_puas_sarjana'] ?? 0;
          $total_responden_sd = $_SESSION['total_responden_sd'] ?? 0;
          $total_responden_smp = $_SESSION['total_responden_smp'] ?? 0;
          $total_responden_sma = $_SESSION['total_responden_sma'] ?? 0;
          $total_responden_diploma = $_SESSION['total_responden_diploma'] ?? 0;
          $total_responden_sarjana = $_SESSION['total_responden_sarjana'] ?? 0;
          $total_responden_lulusan = $_SESSION['total_responden_lulusan'] ?? 0;
  
          $profesi_sangat_puas_pns = $_SESSION['profesi_sangat_puas_pns'] ?? 0;
          $profesi_puas_pns = $_SESSION['profesi_puas_pns'] ?? 0;
          $profesi_kurang_puas_pns = $_SESSION['profesi_kurang_puas_pns'] ?? 0;
          $profesi_sangat_kurang_puas_pns = $_SESSION['profesi_sangat_kurang_puas_pns'] ?? 0;
          $profesi_sangat_puas_swasta_wiraswasta = $_SESSION['profesi_sangat_puas_swasta_wiraswasta'] ?? 0;
          $profesi_puas_swasta_wiraswasta = $_SESSION['profesi_puas_swasta_wiraswasta'] ?? 0;
          $profesi_kurang_puas_swasta_wiraswasta = $_SESSION['profesi_kurang_puas_swasta_wiraswasta'] ?? 0;
          $profesi_sangat_kurang_puas_swasta_wiraswasta = $_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta'] ?? 0;
          $profesi_sangat_puas_pelajar_mahasiswa = $_SESSION['profesi_sangat_puas_pelajar_mahasiswa'] ?? 0;
          $profesi_puas_pelajar_mahasiswa = $_SESSION['profesi_puas_pelajar_mahasiswa'] ?? 0;
          $profesi_kurang_puas_pelajar_mahasiswa = $_SESSION['profesi_kurang_puas_pelajar_mahasiswa'] ?? 0;
          $profesi_sangat_kurang_puas_pelajar_mahasiswa = $_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa'] ?? 0;
          $profesi_sangat_puas_pengangguran = $_SESSION['profesi_sangat_puas_pengangguran'] ?? 0;
          $profesi_puas_pengangguran = $_SESSION['profesi_puas_pengangguran'] ?? 0;
          $profesi_kurang_puas_pengangguran = $_SESSION['profesi_kurang_puas_pengangguran'] ?? 0;
          $profesi_sangat_kurang_puas_pengangguran = $_SESSION['profesi_sangat_kurang_puas_pengangguran'] ?? 0;
          $total_responden_pns = $_SESSION['total_responden_pns'] ?? 0;
          $total_responden_swasta_wiraswasta = $_SESSION['total_responden_swasta_wiraswasta'] ?? 0;
          $total_responden_pelajar_mahasiswa = $_SESSION['total_responden_pelajar_mahasiswa'] ?? 0;
          $total_responden_pengangguran = $_SESSION['total_responden_pengangguran'] ?? 0;
          $total_responden_profesi = $_SESSION['total_responden_profesi'] ?? 0;
  
          // Query SQL untuk memasukkan data ke tabel gender
          $stmt_gender = $conn->prepare("
              INSERT INTO gender (laki_laki_sangat_puas, laki_laki_puas, laki_laki_kurang_puas, laki_laki_sangat_kurang_puas,
                                  perempuan_sangat_puas, perempuan_puas, perempuan_kurang_puas, perempuan_sangat_kurang_puas,
                                  total_responden_laki_laki, total_responden_perempuan, total_responden_gender)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          ");
          $stmt_gender->bind_param("iiiiiiiiiii", 
              $gender_sangat_puas_laki, $gender_puas_laki, $gender_kurang_puas_laki, $gender_sangat_kurang_puas_laki,
              $gender_sangat_puas_perempuan, $gender_puas_perempuan, $gender_kurang_puas_perempuan, $gender_sangat_kurang_puas_perempuan,
              $total_responden_laki_laki, $total_responden_perempuan, $total_responden_gender
          );
          $stmt_gender->execute();
  
          // Query SQL untuk memasukkan data ke tabel usia
          $stmt_usia = $conn->prepare("
              INSERT INTO usia (18_35_sangat_puas, 18_35_puas, 18_35_kurang_puas, 18_35_sangat_kurang_puas,
                                 36_up_sangat_puas, 36_up_puas, 36_up_kurang_puas, 36_up_sangat_kurang_puas,
                                 total_responden_18_35, total_responden_36_up, total_responden_usia)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          ");
          $stmt_usia->bind_param("iiiiiiiiiii", 
              $usia_sangat_puas_18_35, $usia_puas_18_35, $usia_kurang_puas_18_35, $usia_sangat_kurang_puas_18_35,
              $usia_sangat_puas_36_plus, $usia_puas_36_plus, $usia_kurang_puas_36_plus, $usia_sangat_kurang_puas_36_plus,
              $total_responden_18_35, $total_responden_36_up, $total_responden_usia
          );
          $stmt_usia->execute();
  
          // Query SQL untuk memasukkan data ke tabel lulusan
          $stmt_lulusan = $conn->prepare("
              INSERT INTO lulusan (sd_sangat_puas, sd_puas, sd_kurang_puas, sd_sangat_kurang_puas,
                                                smp_sangat_puas, smp_puas, smp_kurang_puas, smp_sangat_kurang_puas,
                                                sma_sangat_puas, sma_puas, sma_kurang_puas, sma_sangat_kurang_puas,
                                                diploma_sangat_puas, diploma_puas, diploma_kurang_puas, diploma_sangat_kurang_puas,
                                                sarjana_sangat_puas, sarjana_puas, sarjana_kurang_puas, sarjana_sangat_kurang_puas,
                                                total_responden_sd, total_responden_smp, total_responden_sma, total_responden_diploma, total_responden_sarjana, total_responden_lulusan)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          ");
          $stmt_lulusan->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiii", 
              $lulusan_sangat_puas_sd, $lulusan_puas_sd, $lulusan_kurang_puas_sd, $lulusan_sangat_kurang_puas_sd,
              $lulusan_sangat_puas_smp, $lulusan_puas_smp, $lulusan_kurang_puas_smp, $lulusan_sangat_kurang_puas_smp,
              $lulusan_sangat_puas_sma, $lulusan_puas_sma, $lulusan_kurang_puas_sma, $lulusan_sangat_kurang_puas_sma,
              $lulusan_sangat_puas_diploma, $lulusan_puas_diploma, $lulusan_kurang_puas_diploma, $lulusan_sangat_kurang_puas_diploma,
              $lulusan_sangat_puas_sarjana, $lulusan_puas_sarjana, $lulusan_kurang_puas_sarjana, $lulusan_sangat_kurang_puas_sarjana,
              $total_responden_sd, $total_responden_smp, $total_responden_sma, $total_responden_diploma, $total_responden_sarjana, $total_responden_lulusan
          );
          $stmt_lulusan->execute();
  
          // Query SQL untuk memasukkan data ke tabel profesi
          $stmt_profesi = $conn->prepare("
              INSERT INTO profesi (pns_sangat_puas, pns_puas, pns_kurang_puas, pns_sangat_kurang_puas,
                                                 swasta_wiraswasta_sangat_puas, swasta_wiraswasta_puas, swasta_wiraswasta_kurang_puas, swasta_wiraswasta_sangat_kurang_puas,
                                                pelajar_mahasiswa_sangat_puas, pelajar_mahasiswa_puas, pelajar_mahasiswa_kurang_puas, pelajar_mahasiswa_sangat_kurang_puas,
                                                pengangguran_sangat_puas, pengangguran_puas, pengangguran_kurang_puas, pengangguran_sangat_kurang_puas,
                                                total_responden_pns, total_responden_swasta_wiraswasta, total_responden_pelajar_mahasiswa, total_responden_pengangguran, total_responden_profesi)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          ");
          $stmt_profesi->bind_param("iiiiiiiiiiiiiiiiiiiii", 
              $profesi_sangat_puas_pns, $profesi_puas_pns, $profesi_kurang_puas_pns, $profesi_sangat_kurang_puas_pns,
              $profesi_sangat_puas_swasta_wiraswasta, $profesi_puas_swasta_wiraswasta, $profesi_kurang_puas_swasta_wiraswasta, $profesi_sangat_kurang_puas_swasta_wiraswasta,
              $profesi_sangat_puas_pelajar_mahasiswa, $profesi_puas_pelajar_mahasiswa, $profesi_kurang_puas_pelajar_mahasiswa, $profesi_sangat_kurang_puas_pelajar_mahasiswa,
              $profesi_sangat_puas_pengangguran, $profesi_puas_pengangguran, $profesi_kurang_puas_pengangguran, $profesi_sangat_kurang_puas_pengangguran,
              $total_responden_pns, $total_responden_swasta_wiraswasta, $total_responden_pelajar_mahasiswa, $total_responden_pengangguran, $total_responden_profesi
          );
          $stmt_profesi->execute();

          // Hapus variabel session yang diinginkan
            unset(
                  $_SESSION['id'], 
                  $_SESSION['judul-survey'], 
                  $_SESSION['keterangan'], 
                  $_SESSION['id_wilayah'], 
                  $_SESSION['image'],
            
                  $_SESSION['gender_sangat_puas_laki'], 
                  $_SESSION['gender_puas_laki'], 
                  $_SESSION['gender_kurang_puas_laki'], 
                  $_SESSION['gender_sangat_kurang_puas_laki'],
                  $_SESSION['gender_sangat_puas_perempuan'], 
                  $_SESSION['gender_puas_perempuan'], 
                  $_SESSION['gender_kurang_puas_perempuan'], 
                  $_SESSION['gender_sangat_kurang_puas_perempuan'],
            
                  $_SESSION['total_responden_laki_laki'], 
                  $_SESSION['total_responden_perempuan'], 
                  $_SESSION['total_responden_gender'],
            
                  $_SESSION['usia_sangat_puas_18_35'], 
                  $_SESSION['usia_puas_18_35'], 
                  $_SESSION['usia_kurang_puas_18_35'], 
                  $_SESSION['usia_sangat_kurang_puas_18_35'],
            
                  $_SESSION['usia_sangat_puas_36_plus'], 
                  $_SESSION['usia_puas_36_plus'], 
                  $_SESSION['usia_kurang_puas_36_plus'], 
                  $_SESSION['usia_sangat_kurang_puas_36_plus'],
            
                  $_SESSION['total_responden_18_35'], 
                  $_SESSION['total_responden_36_up'], 
                  $_SESSION['total_responden_usia'],
            
                  $_SESSION['lulusan_sangat_puas_sd'], 
                  $_SESSION['lulusan_puas_sd'], 
                  $_SESSION['lulusan_kurang_puas_sd'], 
                  $_SESSION['lulusan_sangat_kurang_puas_sd'],
            
                  $_SESSION['lulusan_sangat_puas_smp'], 
                  $_SESSION['lulusan_puas_smp'], 
                  $_SESSION['lulusan_kurang_puas_smp'], 
                  $_SESSION['lulusan_sangat_kurang_puas_smp'],
            
                  $_SESSION['lulusan_sangat_puas_sma'], 
                  $_SESSION['lulusan_puas_sma'], 
                  $_SESSION['lulusan_kurang_puas_sma'], 
                  $_SESSION['lulusan_sangat_kurang_puas_sma'],
            
                  $_SESSION['lulusan_sangat_puas_diploma'], 
                  $_SESSION['lulusan_puas_diploma'], 
                  $_SESSION['lulusan_kurang_puas_diploma'], 
                  $_SESSION['lulusan_sangat_kurang_puas_diploma'],
            
                  $_SESSION['lulusan_sangat_puas_sarjana'], 
                  $_SESSION['lulusan_puas_sarjana'], 
                  $_SESSION['lulusan_kurang_puas_sarjana'], 
                  $_SESSION['lulusan_sangat_kurang_puas_sarjana'],
            
                  $_SESSION['total_responden_sd'], 
                  $_SESSION['total_responden_smp'], 
                  $_SESSION['total_responden_sma'], 
                  $_SESSION['total_responden_diploma'], 
                  $_SESSION['total_responden_sarjana'], 
                  $_SESSION['total_responden_lulusan'],
            
                  $_SESSION['profesi_sangat_puas_pns'], 
                  $_SESSION['profesi_puas_pns'], 
                  $_SESSION['profesi_kurang_puas_pns'], 
                  $_SESSION['profesi_sangat_kurang_puas_pns'],
            
                  $_SESSION['profesi_sangat_puas_swasta_wiraswasta'], 
                  $_SESSION['profesi_puas_swasta_wiraswasta'], 
                  $_SESSION['profesi_kurang_puas_swasta_wiraswasta'], 
                  $_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta'],
            
                  $_SESSION['profesi_sangat_puas_pelajar_mahasiswa'], 
                  $_SESSION['profesi_puas_pelajar_mahasiswa'], 
                  $_SESSION['profesi_kurang_puas_pelajar_mahasiswa'], 
                  $_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa'],
            
                  $_SESSION['profesi_sangat_puas_pengangguran'], 
                  $_SESSION['profesi_puas_pengangguran'], 
                  $_SESSION['profesi_kurang_puas_pengangguran'], 
                  $_SESSION['profesi_sangat_kurang_puas_pengangguran'],
            
                  $_SESSION['total_responden_pns'], 
                  $_SESSION['total_responden_swasta_wiraswasta'], 
                  $_SESSION['total_responden_pelajar_mahasiswa'], 
                  $_SESSION['total_responden_pengangguran'], 
                  $_SESSION['total_responden_profesi']
            );  
          // Berhasil menyimpan data
          echo "<script>alert('Data berhasil disimpan!');</script>";
          header('Location: Admin_Hasil_Survey.php');
            exit();
      } else {
          echo "<script>alert('Gagal menyimpan data: " . htmlspecialchars($stmt->error) . "');</script>";
      }
  
      // Tutup statement dan koneksi
      $stmt->close();
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
                  <h2><span class="Tambah-Survei"><?php echo htmlspecialchars($judulSurvey); ?></span></h2>
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
            <form action="" method="post">
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
                                    <tr>
                                          <td>Laki - Laki</td>
                                          <td><?php echo htmlspecialchars($genderSangatPuasLaki); ?></td>
                                          <td><?php echo htmlspecialchars($genderPuasLaki); ?></td>
                                          <td><?php echo htmlspecialchars($genderKurangPuasLaki); ?></td>
                                          <td><?php echo htmlspecialchars($genderSangatKurangPuasLaki); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenLakiLaki); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Perempuan</td>
                                          <td><?php echo htmlspecialchars($genderSangatPuasPerempuan); ?></td>
                                          <td><?php echo htmlspecialchars($genderPuasPerempuan); ?></td>
                                          <td><?php echo htmlspecialchars($genderKurangPuasPerempuan); ?></td>
                                          <td><?php echo htmlspecialchars($genderSangatKurangPuasPerempuan); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenPerempuan); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td><?php echo htmlspecialchars($genderSangatPuasLaki + $genderSangatPuasPerempuan); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($genderPuasLaki + $genderPuasPerempuan); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($genderKurangPuasLaki + $genderKurangPuasPerempuan); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($genderSangatKurangPuasLaki + $genderSangatKurangPuasPerempuan); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($totalRespondenLakiLaki + $totalRespondenPerempuan); ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td><?php echo number_format((($genderSangatPuasLaki + $genderSangatPuasPerempuan) / $totalRespondenGender) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($genderPuasLaki + $genderPuasPerempuan) / $totalRespondenGender) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($genderKurangPuasLaki + $genderKurangPuasPerempuan) / $totalRespondenGender) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($genderSangatKurangPuasLaki + $genderSangatKurangPuasPerempuan) / $totalRespondenGender) * 100, 2); ?>%
                                          </td>
                                          <td>100%</td>
                                    </tr>
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
                                    <tr>
                                          <td>Usia 18 - 35 Tahun</td>
                                          <td><?php echo htmlspecialchars($usiaSangatPuas18_35); ?></td>
                                          <td><?php echo htmlspecialchars($usiaPuas18_35); ?></td>
                                          <td><?php echo htmlspecialchars($usiaKurangPuas18_35); ?></td>
                                          <td><?php echo htmlspecialchars($usiaSangatKurangPuas18_35); ?></td>
                                          <td><?php echo htmlspecialchars($totalResponden18_35); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Usia 36 Tahun ke Atas</td>
                                          <td><?php echo htmlspecialchars($usiaSangatPuas36Plus); ?></td>
                                          <td><?php echo htmlspecialchars($usiaPuas36Plus); ?></td>
                                          <td><?php echo htmlspecialchars($usiaKurangPuas36Plus); ?></td>
                                          <td><?php echo htmlspecialchars($usiaSangatKurangPuas36Plus); ?></td>
                                          <td><?php echo htmlspecialchars($totalResponden36Plus); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td><?php echo htmlspecialchars($usiaSangatPuas18_35 + $usiaSangatPuas36Plus); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($usiaPuas18_35 + $usiaPuas36Plus); ?></td>
                                          <td><?php echo htmlspecialchars($usiaKurangPuas18_35 + $usiaKurangPuas36Plus); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($usiaSangatKurangPuas18_35 + $usiaSangatKurangPuas36Plus); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($totalResponden18_35 + $totalResponden36Plus); ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td><?php echo number_format((($usiaSangatPuas18_35 + $usiaSangatPuas36Plus) / $totalRespondenUsia) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($usiaPuas18_35 + $usiaPuas36Plus) / $totalRespondenUsia) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($usiaKurangPuas18_35 + $usiaKurangPuas36Plus) / $totalRespondenUsia) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($usiaSangatKurangPuas18_35 + $usiaSangatKurangPuas36Plus) / $totalRespondenUsia) * 100, 2); ?>%
                                          </td>
                                          <td>100%</td>
                                    </tr>
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
                                    <tr>
                                          <td>Lulusan SD</td>
                                          <td><?php echo htmlspecialchars($lulusanSangatPuasSD); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanPuasSD); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanKurangPuasSD); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanSangatKurangPuasSD); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenSD); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan SMP</td>
                                          <td><?php echo htmlspecialchars($lulusanSangatPuasSMP); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanPuasSMP); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanKurangPuasSMP); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanSangatKurangPuasSMP); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenSMP); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan SMA</td>
                                          <td><?php echo htmlspecialchars($lulusanSangatPuasSMA); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanPuasSMA); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanKurangPuasSMA); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanSangatKurangPuasSMA); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenSMA); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan Diploma</td>
                                          <td><?php echo htmlspecialchars($lulusanSangatPuasDiploma); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanPuasDiploma); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanKurangPuasDiploma); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanSangatKurangPuasDiploma); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenDiploma); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Lulusan Sarjana</td>
                                          <td><?php echo htmlspecialchars($lulusanSangatPuasSarjana); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanPuasSarjana); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanKurangPuasSarjana); ?></td>
                                          <td><?php echo htmlspecialchars($lulusanSangatKurangPuasSarjana); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenSarjana); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td><?php echo htmlspecialchars($lulusanSangatPuasSD + $lulusanSangatPuasSMP + $lulusanSangatPuasSMA + $lulusanSangatPuasDiploma + $lulusanSangatPuasSarjana); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($lulusanPuasSD + $lulusanPuasSMP + $lulusanPuasSMA + $lulusanPuasDiploma + $lulusanPuasSarjana); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($lulusanKurangPuasSD + $lulusanKurangPuasSMP + $lulusanKurangPuasSMA + $lulusanKurangPuasDiploma + $lulusanKurangPuasSarjana); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($lulusanSangatKurangPuasSD + $lulusanSangatKurangPuasSMP + $lulusanSangatKurangPuasSMA + $lulusanSangatKurangPuasDiploma + $lulusanSangatKurangPuasSarjana); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($totalRespondenSD + $totalRespondenSMP + $totalRespondenSMA + $totalRespondenDiploma + $totalRespondenSarjana); ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td><?php echo number_format((($lulusanSangatPuasSD + $lulusanSangatPuasSMP + $lulusanSangatPuasSMA + $lulusanSangatPuasDiploma + $lulusanSangatPuasSarjana) / $totalRespondenLulusan) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($lulusanPuasSD + $lulusanPuasSMP + $lulusanPuasSMA + $lulusanPuasDiploma + $lulusanPuasSarjana) / $totalRespondenLulusan) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($lulusanKurangPuasSD + $lulusanKurangPuasSMP + $lulusanKurangPuasSMA + $lulusanKurangPuasDiploma + $lulusanKurangPuasSarjana) / $totalRespondenLulusan) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($lulusanSangatKurangPuasSD + $lulusanSangatKurangPuasSMP + $lulusanSangatKurangPuasSMA + $lulusanSangatKurangPuasDiploma + $lulusanSangatKurangPuasSarjana) / $totalRespondenLulusan) * 100, 2); ?>%
                                          </td>
                                          <td>100%</td>
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
                                          <th>Total</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                          <td>PNS</td>
                                          <td><?php echo htmlspecialchars($profesiSangatPuasPNS); ?></td>
                                          <td><?php echo htmlspecialchars($profesiPuasPNS); ?></td>
                                          <td><?php echo htmlspecialchars($profesiKurangPuasPNS); ?></td>
                                          <td><?php echo htmlspecialchars($profesiSangatKurangPuasPNS); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenPNS); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Swasta/Wiraswasta</td>
                                          <td><?php echo htmlspecialchars($profesiSangatPuasSwastaWiraswasta); ?></td>
                                          <td><?php echo htmlspecialchars($profesiPuasSwastaWiraswasta); ?></td>
                                          <td><?php echo htmlspecialchars($profesiKurangPuasSwastaWiraswasta); ?></td>
                                          <td><?php echo htmlspecialchars($profesiSangatKurangPuasSwastaWiraswasta); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($totalRespondenSwastaWiraswasta); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Pelajar/Mahasiswa</td>
                                          <td><?php echo htmlspecialchars($profesiSangatPuasPelajarMahasiswa); ?></td>
                                          <td><?php echo htmlspecialchars($profesiPuasPelajarMahasiswa); ?></td>
                                          <td><?php echo htmlspecialchars($profesiKurangPuasPelajarMahasiswa); ?></td>
                                          <td><?php echo htmlspecialchars($profesiSangatKurangPuasPelajarMahasiswa); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($totalRespondenPelajarMahasiswa); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Pengangguran</td>
                                          <td><?php echo htmlspecialchars($profesiSangatPuasPengangguran); ?></td>
                                          <td><?php echo htmlspecialchars($profesiPuasPengangguran); ?></td>
                                          <td><?php echo htmlspecialchars($profesiKurangPuasPengangguran); ?></td>
                                          <td><?php echo htmlspecialchars($profesiSangatKurangPuasPengangguran); ?></td>
                                          <td><?php echo htmlspecialchars($totalRespondenPengangguran); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Total</td>
                                          <td><?php echo htmlspecialchars($profesiSangatPuasPNS + $profesiSangatPuasSwastaWiraswasta + $profesiSangatPuasPelajarMahasiswa + $profesiSangatPuasPengangguran); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($profesiPuasPNS + $profesiPuasSwastaWiraswasta + $profesiPuasPelajarMahasiswa + $profesiPuasPengangguran); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($profesiKurangPuasPNS + $profesiKurangPuasSwastaWiraswasta + $profesiKurangPuasPelajarMahasiswa + $profesiKurangPuasPengangguran); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($profesiSangatKurangPuasPNS + $profesiSangatKurangPuasSwastaWiraswasta + $profesiSangatKurangPuasPelajarMahasiswa + $profesiSangatKurangPuasPengangguran); ?>
                                          </td>
                                          <td><?php echo htmlspecialchars($totalRespondenPNS + $totalRespondenSwastaWiraswasta + $totalRespondenPelajarMahasiswa + $totalRespondenPengangguran); ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Persentase</td>
                                          <td><?php echo number_format((($profesiSangatPuasPNS + $profesiSangatPuasSwastaWiraswasta + $profesiSangatPuasPelajarMahasiswa + $profesiSangatPuasPengangguran) / $totalRespondenProfesi) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($profesiPuasPNS + $profesiPuasSwastaWiraswasta + $profesiPuasPelajarMahasiswa + $profesiPuasPengangguran) / $totalRespondenProfesi) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($profesiKurangPuasPNS + $profesiKurangPuasSwastaWiraswasta + $profesiKurangPuasPelajarMahasiswa + $profesiKurangPuasPengangguran) / $totalRespondenProfesi) * 100, 2); ?>%
                                          </td>
                                          <td><?php echo number_format((($profesiSangatKurangPuasPNS + $profesiSangatKurangPuasSwastaWiraswasta + $profesiSangatKurangPuasPelajarMahasiswa + $profesiSangatKurangPuasPengangguran) / $totalRespondenProfesi) * 100, 2); ?>%
                                          </td>
                                          <td>100%</td>
                                    </tr>
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
                        <button type="button" onclick="window.history.back();" class="tombol-cancel">
                              <i class="fa-solid fa-arrow-left"></i><strong>Kembali</strong>
                        </button>
                        <button type="submit" name="publish" class="tombol-publish"><i
                                    class="fa-solid fa-upload"></i>Publish</button>
                  </div>
            </form>
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
            <?php echo htmlspecialchars($genderSangatPuasLaki ?? 0); ?>,
            <?php echo htmlspecialchars($genderPuasLaki ?? 0); ?>,
            <?php echo htmlspecialchars($genderKurangPuasLaki ?? 0); ?>,
            <?php echo htmlspecialchars($genderSangatKurangPuasLaki ?? 0); ?>
      ];
      createPieChart(document.getElementById('laki_laki'), 'Kategori Laki-laki', dataLakiLaki);

      // Chart untuk Gender - Perempuan
      const dataPerempuan = [
            <?php echo htmlspecialchars($genderSangatPuasPerempuan ?? 0); ?>,
            <?php echo htmlspecialchars($genderPuasPerempuan ?? 0); ?>,
            <?php echo htmlspecialchars($genderKurangPuasPerempuan ?? 0); ?>,
            <?php echo htmlspecialchars($genderSangatKurangPuasPerempuan ?? 0); ?>
      ];
      createPieChart(document.getElementById('perempuan'), 'Kategori Perempuan', dataPerempuan);

      // Chart untuk Usia - 18-35 Tahun
      const dataUsia18_35 = [
            <?php echo htmlspecialchars($usiaSangatPuas18_35 ?? 0); ?>,
            <?php echo htmlspecialchars($usiaPuas18_35 ?? 0); ?>,
            <?php echo htmlspecialchars($usiaKurangPuas18_35 ?? 0); ?>,
            <?php echo htmlspecialchars($usiaSangatKurangPuas18_35 ?? 0); ?>
      ];
      createPieChart(document.getElementById('usia_18_35'), 'Usia 18-35 Tahun', dataUsia18_35);

      // Chart untuk Usia - 36 Tahun ke atas
      const dataUsia36Up = [
            <?php echo htmlspecialchars($usiaSangatPuas36Plus ?? 0); ?>,
            <?php echo htmlspecialchars($usiaPuas36Plus ?? 0); ?>,
            <?php echo htmlspecialchars($usiaKurangPuas36Plus ?? 0); ?>,
            <?php echo htmlspecialchars($usiaSangatKurangPuas36Plus ?? 0); ?>
      ];
      createPieChart(document.getElementById('usia_36_up'), 'Usia 36 Tahun ke atas', dataUsia36Up);

      // Chart untuk Lulusan - SD
      const dataLulusanSD = [
            <?php echo htmlspecialchars($lulusanSangatPuasSD ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanPuasSD ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanKurangPuasSD ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanSangatKurangPuasSD ?? 0); ?>
      ];
      createPieChart(document.getElementById('sd'), 'Lulusan SD', dataLulusanSD);

      // Chart untuk Lulusan - SMP
      const dataLulusanSMP = [
            <?php echo htmlspecialchars($lulusanSangatPuasSMP ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanPuasSMP ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanKurangPuasSMP ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanSangatKurangPuasSMP ?? 0); ?>
      ];
      createPieChart(document.getElementById('smp'), 'Lulusan SMP', dataLulusanSMP);

      // Chart untuk Lulusan - SMA
      const dataLulusanSMA = [
            <?php echo htmlspecialchars($lulusanSangatPuasSMA ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanPuasSMA ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanKurangPuasSMA ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanSangatKurangPuasSMA ?? 0); ?>
      ];
      createPieChart(document.getElementById('sma'), 'Lulusan SMA', dataLulusanSMA);

      // Chart untuk Lulusan - Diploma
      const dataLulusanDiploma = [
            <?php echo htmlspecialchars($lulusanSangatPuasDiploma ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanPuasDiploma ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanKurangPuasDiploma ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanSangatKurangPuasDiploma ?? 0); ?>
      ];
      createPieChart(document.getElementById('diploma'), 'Lulusan Diploma', dataLulusanDiploma);

      // Chart untuk Lulusan - Sarjana
      const dataLulusanSarjana = [
            <?php echo htmlspecialchars($lulusanSangatPuasSarjana ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanPuasSarjana ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanKurangPuasSarjana ?? 0); ?>,
            <?php echo htmlspecialchars($lulusanSangatKurangPuasSarjana ?? 0); ?>
      ];
      createPieChart(document.getElementById('sarjana'), 'Lulusan Sarjana', dataLulusanSarjana);

      // Chart untuk Profesi - PNS
      const dataProfesiPNS = [
            <?php echo htmlspecialchars($profesiSangatPuasPNS ?? 0); ?>,
            <?php echo htmlspecialchars($profesiPuasPNS ?? 0); ?>,
            <?php echo htmlspecialchars($profesiKurangPuasPNS ?? 0); ?>,
            <?php echo htmlspecialchars($profesiSangatKurangPuasPNS ?? 0); ?>
      ];
      createPieChart(document.getElementById('pns'), 'Profesi PNS', dataProfesiPNS);

      // Chart untuk Profesi - Swasta/Wiraswasta
      const dataProfesiSwastaWiraswasta = [
            <?php echo htmlspecialchars($profesiSangatPuasSwastaWiraswasta ?? 0); ?>,
            <?php echo htmlspecialchars($profesiPuasSwastaWiraswasta ?? 0); ?>,
            <?php echo htmlspecialchars($profesiKurangPuasSwastaWiraswasta ?? 0); ?>,
            <?php echo htmlspecialchars($profesiSangatKurangPuasSwastaWiraswasta ?? 0); ?>
      ];
      createPieChart(document.getElementById('swasta_wiraswasta'), 'Profesi Swasta/Wiraswasta',
            dataProfesiSwastaWiraswasta);

      // Chart untuk Profesi - Pelajar/Mahasiswa
      const dataProfesiPelajarMahasiswa = [
            <?php echo htmlspecialchars($profesiSangatPuasPelajarMahasiswa ?? 0); ?>,
            <?php echo htmlspecialchars($profesiPuasPelajarMahasiswa ?? 0); ?>,
            <?php echo htmlspecialchars($profesiKurangPuasPelajarMahasiswa ?? 0); ?>,
            <?php echo htmlspecialchars($profesiSangatKurangPuasPelajarMahasiswa ?? 0); ?>
      ];
      createPieChart(document.getElementById('pelajar_mahasiswa'), 'Profesi Pelajar/Mahasiswa',
            dataProfesiPelajarMahasiswa);

      // Chart untuk Profesi - Pengangguran
      const dataProfesiPengangguran = [
            <?php echo htmlspecialchars($profesiSangatPuasPengangguran ?? 0); ?>,
            <?php echo htmlspecialchars($profesiPuasPengangguran ?? 0); ?>,
            <?php echo htmlspecialchars($profesiKurangPuasPengangguran ?? 0); ?>,
            <?php echo htmlspecialchars($profesiSangatKurangPuasPengangguran ?? 0); ?>
      ];
      createPieChart(document.getElementById('pengangguran'), 'Profesi Pengangguran', dataProfesiPengangguran);
      </script>
</body>

</html>