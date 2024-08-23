<?php
session_start(); 
include "Koneksi_survei_litbang.php";

$surveyId = isset($_GET['id']) ? $_GET['id'] : (isset($_SESSION['survey_id']) ? $_SESSION['survey_id'] : null);

// Function to validate inputs
function validateInput($data) {
    return filter_var($data, FILTER_VALIDATE_INT) !== false ? intval($data) : 0;
}

// Retrieve gender-related data from session
$genderSangatPuasLaki = isset($_SESSION['gender_sangat_puas_laki']) ? $_SESSION['gender_sangat_puas_laki'] : '';
$genderPuasLaki = isset($_SESSION['gender_puas_laki']) ? $_SESSION['gender_puas_laki'] : '';
$genderKurangPuasLaki = isset($_SESSION['gender_kurang_puas_laki']) ? $_SESSION['gender_kurang_puas_laki'] : '';
$genderSangatKurangPuasLaki = isset($_SESSION['gender_sangat_kurang_puas_laki']) ? $_SESSION['gender_sangat_kurang_puas_laki'] : '';

$genderSangatPuasPerempuan = isset($_SESSION['gender_sangat_puas_perempuan']) ? $_SESSION['gender_sangat_puas_perempuan'] : '';
$genderPuasPerempuan = isset($_SESSION['gender_puas_perempuan']) ? $_SESSION['gender_puas_perempuan'] : '';
$genderKurangPuasPerempuan = isset($_SESSION['gender_kurang_puas_perempuan']) ? $_SESSION['gender_kurang_puas_perempuan'] : '';
$genderSangatKurangPuasPerempuan = isset($_SESSION['gender_sangat_kurang_puas_perempuan']) ? $_SESSION['gender_sangat_kurang_puas_perempuan'] : '';


// Retrieve age-related data from session
$usiaSangatPuas18_35 = isset($_SESSION['usia_sangat_puas_18_35']) ? $_SESSION['usia_sangat_puas_18_35'] : '';
$usiaPuas18_35 = isset($_SESSION['usia_puas_18_35']) ? $_SESSION['usia_puas_18_35'] : '';
$usiaKurangPuas18_35 = isset($_SESSION['usia_kurang_puas_18_35']) ? $_SESSION['usia_kurang_puas_18_35'] : '';
$usiaSangatKurangPuas18_35 = isset($_SESSION['usia_sangat_kurang_puas_18_35']) ? $_SESSION['usia_sangat_kurang_puas_18_35'] : '';

$usiaSangatPuas36Plus = isset($_SESSION['usia_sangat_puas_36_plus']) ? $_SESSION['usia_sangat_puas_36_plus'] : '';
$usiaPuas36Plus = isset($_SESSION['usia_puas_36_plus']) ? $_SESSION['usia_puas_36_plus'] : '';
$usiaKurangPuas36Plus = isset($_SESSION['usia_kurang_puas_36_plus']) ? $_SESSION['usia_kurang_puas_36_plus'] : '';
$usiaSangatKurangPuas36Plus = isset($_SESSION['usia_sangat_kurang_puas_36_plus']) ? $_SESSION['usia_sangat_kurang_puas_36_plus'] : '';


// Retrieve education-related data from session
$lulusanSangatPuasSD = isset($_SESSION['lulusan_sangat_puas_sd']) ? $_SESSION['lulusan_sangat_puas_sd'] : '';
$lulusanPuasSD = isset($_SESSION['lulusan_puas_sd']) ? $_SESSION['lulusan_puas_sd'] : '';
$lulusanKurangPuasSD = isset($_SESSION['lulusan_kurang_puas_sd']) ? $_SESSION['lulusan_kurang_puas_sd'] : '';
$lulusanSangatKurangPuasSD = isset($_SESSION['lulusan_sangat_kurang_puas_sd']) ? $_SESSION['lulusan_sangat_kurang_puas_sd'] : '';

$lulusanSangatPuasSMP = isset($_SESSION['lulusan_sangat_puas_smp']) ? $_SESSION['lulusan_sangat_puas_smp'] : '';
$lulusanPuasSMP = isset($_SESSION['lulusan_puas_smp']) ? $_SESSION['lulusan_puas_smp'] : '';
$lulusanKurangPuasSMP = isset($_SESSION['lulusan_kurang_puas_smp']) ? $_SESSION['lulusan_kurang_puas_smp'] : '';
$lulusanSangatKurangPuasSMP = isset($_SESSION['lulusan_sangat_kurang_puas_smp']) ? $_SESSION['lulusan_sangat_kurang_puas_smp'] : '';

$lulusanSangatPuasSMA = isset($_SESSION['lulusan_sangat_puas_sma']) ? $_SESSION['lulusan_sangat_puas_sma'] : '';
$lulusanPuasSMA = isset($_SESSION['lulusan_puas_sma']) ? $_SESSION['lulusan_puas_sma'] : '';
$lulusanKurangPuasSMA = isset($_SESSION['lulusan_kurang_puas_sma']) ? $_SESSION['lulusan_kurang_puas_sma'] : '';
$lulusanSangatKurangPuasSMA = isset($_SESSION['lulusan_sangat_kurang_puas_sma']) ? $_SESSION['lulusan_sangat_kurang_puas_sma'] : '';

$lulusanSangatPuasDiploma = isset($_SESSION['lulusan_sangat_puas_diploma']) ? $_SESSION['lulusan_sangat_puas_diploma'] : '';
$lulusanPuasDiploma = isset($_SESSION['lulusan_puas_diploma']) ? $_SESSION['lulusan_puas_diploma'] : '';
$lulusanKurangPuasDiploma = isset($_SESSION['lulusan_kurang_puas_diploma']) ? $_SESSION['lulusan_kurang_puas_diploma'] : '';
$lulusanSangatKurangPuasDiploma = isset($_SESSION['lulusan_sangat_kurang_puas_diploma']) ? $_SESSION['lulusan_sangat_kurang_puas_diploma'] : '';

$lulusanSangatPuasSarjana = isset($_SESSION['lulusan_sangat_puas_sarjana']) ? $_SESSION['lulusan_sangat_puas_sarjana'] : '';
$lulusanPuasSarjana = isset($_SESSION['lulusan_puas_sarjana']) ? $_SESSION['lulusan_puas_sarjana'] : '';
$lulusanKurangPuasSarjana = isset($_SESSION['lulusan_kurang_puas_sarjana']) ? $_SESSION['lulusan_kurang_puas_sarjana'] : '';
$lulusanSangatKurangPuasSarjana = isset($_SESSION['lulusan_sangat_kurang_puas_sarjana']) ? $_SESSION['lulusan_sangat_kurang_puas_sarjana'] : '';


// Retrieve profession-related data from session
$profesiSangatPuasPNS = isset($_SESSION['profesi_sangat_puas_pns']) ? $_SESSION['profesi_sangat_puas_pns'] : '';
$profesiPuasPNS = isset($_SESSION['profesi_puas_pns']) ? $_SESSION['profesi_puas_pns'] : '';
$profesiKurangPuasPNS = isset($_SESSION['profesi_kurang_puas_pns']) ? $_SESSION['profesi_kurang_puas_pns'] : '';
$profesiSangatKurangPuasPNS = isset($_SESSION['profesi_sangat_kurang_puas_pns']) ? $_SESSION['profesi_sangat_kurang_puas_pns'] : '';

$profesiSangatPuasSwastaWiraswasta = isset($_SESSION['profesi_sangat_puas_swasta_wiraswasta']) ? $_SESSION['profesi_sangat_puas_swasta_wiraswasta'] : '';
$profesiPuasSwastaWiraswasta = isset($_SESSION['profesi_puas_swasta_wiraswasta']) ? $_SESSION['profesi_puas_swasta_wiraswasta'] : '';
$profesiKurangPuasSwastaWiraswasta = isset($_SESSION['profesi_kurang_puas_swasta_wiraswasta']) ? $_SESSION['profesi_kurang_puas_swasta_wiraswasta'] : '';
$profesiSangatKurangPuasSwastaWiraswasta = isset($_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta']) ? $_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta'] : '';

$profesiSangatPuasPelajarMahasiswa = isset($_SESSION['profesi_sangat_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_sangat_puas_pelajar_mahasiswa'] : '';
$profesiPuasPelajarMahasiswa = isset($_SESSION['profesi_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_puas_pelajar_mahasiswa'] : '';
$profesiKurangPuasPelajarMahasiswa = isset($_SESSION['profesi_kurang_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_kurang_puas_pelajar_mahasiswa'] : '';
$profesiSangatKurangPuasPelajarMahasiswa = isset($_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa']) ? $_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa'] : '';

$profesiSangatPuasPengangguran = isset($_SESSION['profesi_sangat_puas_pengangguran']) ? $_SESSION['profesi_sangat_puas_pengangguran'] : '';
$profesiPuasPengangguran = isset($_SESSION['profesi_puas_pengangguran']) ? $_SESSION['profesi_puas_pengangguran'] : '';
$profesiKurangPuasPengangguran = isset($_SESSION['profesi_kurang_puas_pengangguran']) ? $_SESSION['profesi_kurang_puas_pengangguran'] : '';
$profesiSangatKurangPuasPengangguran = isset($_SESSION['profesi_sangat_kurang_puas_pengangguran']) ? $_SESSION['profesi_sangat_kurang_puas_pengangguran'] : '';


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

      // Store data in session variables
      $_SESSION['gender_sangat_puas_laki'] = $gender_sangat_puas_laki;
      $_SESSION['gender_puas_laki'] = $gender_puas_laki;
      $_SESSION['gender_kurang_puas_laki'] = $gender_kurang_puas_laki;
      $_SESSION['gender_sangat_kurang_puas_laki'] = $gender_sangat_kurang_puas_laki;

      $_SESSION['gender_sangat_puas_perempuan'] = $gender_sangat_puas_perempuan;
      $_SESSION['gender_puas_perempuan'] = $gender_puas_perempuan;
      $_SESSION['gender_kurang_puas_perempuan'] = $gender_kurang_puas_perempuan;
      $_SESSION['gender_sangat_kurang_puas_perempuan'] = $gender_sangat_kurang_puas_perempuan;

      // Calculate totals
      $total_responden_laki_laki = $gender_sangat_puas_laki + $gender_puas_laki + $gender_kurang_puas_laki + $gender_sangat_kurang_puas_laki;
      $total_responden_perempuan = $gender_sangat_puas_perempuan + $gender_puas_perempuan + $gender_kurang_puas_perempuan + $gender_sangat_kurang_puas_perempuan;
      $total_responden_gender = $total_responden_laki_laki + $total_responden_perempuan;

      // Store totals in session variables
      $_SESSION['total_responden_laki_laki'] = $total_responden_laki_laki;
      $_SESSION['total_responden_perempuan'] = $total_responden_perempuan;
      $_SESSION['total_responden_gender'] = $total_responden_gender;
    
    // Validate and sanitize age group inputs
      $usia_sangat_puas_18_35 = validateInput($_POST['usia_sangat_puas_18_35']);
      $usia_puas_18_35 = validateInput($_POST['usia_puas_18_35']);
      $usia_kurang_puas_18_35 = validateInput($_POST['usia_kurang_puas_18_35']);
      $usia_sangat_kurang_puas_18_35 = validateInput($_POST['usia_sangat_kurang_puas_18_35']);

      $usia_sangat_puas_36_plus = validateInput($_POST['usia_sangat_puas_36_plus']);
      $usia_puas_36_plus = validateInput($_POST['usia_puas_36_plus']);
      $usia_kurang_puas_36_plus = validateInput($_POST['usia_kurang_puas_36_plus']);
      $usia_sangat_kurang_puas_36_plus = validateInput($_POST['usia_sangat_kurang_puas_36_plus']);

      // Store data in session variables
      $_SESSION['usia_sangat_puas_18_35'] = $usia_sangat_puas_18_35;
      $_SESSION['usia_puas_18_35'] = $usia_puas_18_35;
      $_SESSION['usia_kurang_puas_18_35'] = $usia_kurang_puas_18_35;
      $_SESSION['usia_sangat_kurang_puas_18_35'] = $usia_sangat_kurang_puas_18_35;

      $_SESSION['usia_sangat_puas_36_plus'] = $usia_sangat_puas_36_plus;
      $_SESSION['usia_puas_36_plus'] = $usia_puas_36_plus;
      $_SESSION['usia_kurang_puas_36_plus'] = $usia_kurang_puas_36_plus;
      $_SESSION['usia_sangat_kurang_puas_36_plus'] = $usia_sangat_kurang_puas_36_plus;

      // Calculate totals
      $total_responden_18_35 = $usia_sangat_puas_18_35 + $usia_puas_18_35 + $usia_kurang_puas_18_35 + $usia_sangat_kurang_puas_18_35;
      $total_responden_36_up = $usia_sangat_puas_36_plus + $usia_puas_36_plus + $usia_kurang_puas_36_plus + $usia_sangat_kurang_puas_36_plus;
      $total_responden_usia = $total_responden_18_35 + $total_responden_36_up;

      // Store totals in session variables
      $_SESSION['total_responden_18_35'] = $total_responden_18_35;
      $_SESSION['total_responden_36_up'] = $total_responden_36_up;
      $_SESSION['total_responden_usia'] = $total_responden_usia;

    
    // Validate and sanitize education level inputs
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

      // Store data in session variables
      $_SESSION['lulusan_sangat_puas_sd'] = $lulusan_sangat_puas_sd;
      $_SESSION['lulusan_puas_sd'] = $lulusan_puas_sd;
      $_SESSION['lulusan_kurang_puas_sd'] = $lulusan_kurang_puas_sd;
      $_SESSION['lulusan_sangat_kurang_puas_sd'] = $lulusan_sangat_kurang_puas_sd;

      $_SESSION['lulusan_sangat_puas_smp'] = $lulusan_sangat_puas_smp;
      $_SESSION['lulusan_puas_smp'] = $lulusan_puas_smp;
      $_SESSION['lulusan_kurang_puas_smp'] = $lulusan_kurang_puas_smp;
      $_SESSION['lulusan_sangat_kurang_puas_smp'] = $lulusan_sangat_kurang_puas_smp;

      $_SESSION['lulusan_sangat_puas_sma'] = $lulusan_sangat_puas_sma;
      $_SESSION['lulusan_puas_sma'] = $lulusan_puas_sma;
      $_SESSION['lulusan_kurang_puas_sma'] = $lulusan_kurang_puas_sma;
      $_SESSION['lulusan_sangat_kurang_puas_sma'] = $lulusan_sangat_kurang_puas_sma;

      $_SESSION['lulusan_sangat_puas_diploma'] = $lulusan_sangat_puas_diploma;
      $_SESSION['lulusan_puas_diploma'] = $lulusan_puas_diploma;
      $_SESSION['lulusan_kurang_puas_diploma'] = $lulusan_kurang_puas_diploma;
      $_SESSION['lulusan_sangat_kurang_puas_diploma'] = $lulusan_sangat_kurang_puas_diploma;

      $_SESSION['lulusan_sangat_puas_sarjana'] = $lulusan_sangat_puas_sarjana;
      $_SESSION['lulusan_puas_sarjana'] = $lulusan_puas_sarjana;
      $_SESSION['lulusan_kurang_puas_sarjana'] = $lulusan_kurang_puas_sarjana;
      $_SESSION['lulusan_sangat_kurang_puas_sarjana'] = $lulusan_sangat_kurang_puas_sarjana;

      // Calculate totals
      $total_responden_sd = $lulusan_sangat_puas_sd + $lulusan_puas_sd + $lulusan_kurang_puas_sd + $lulusan_sangat_kurang_puas_sd;
      $total_responden_smp = $lulusan_sangat_puas_smp + $lulusan_puas_smp + $lulusan_kurang_puas_smp + $lulusan_sangat_kurang_puas_smp;
      $total_responden_sma = $lulusan_sangat_puas_sma + $lulusan_puas_sma + $lulusan_kurang_puas_sma + $lulusan_sangat_kurang_puas_sma;
      $total_responden_diploma = $lulusan_sangat_puas_diploma + $lulusan_puas_diploma + $lulusan_kurang_puas_diploma + $lulusan_sangat_kurang_puas_diploma;
      $total_responden_sarjana = $lulusan_sangat_puas_sarjana + $lulusan_puas_sarjana + $lulusan_kurang_puas_sarjana + $lulusan_sangat_kurang_puas_sarjana;
      $total_responden_lulusan = $total_responden_sd + $total_responden_smp + $total_responden_sma + $total_responden_diploma + $total_responden_sarjana;

      // Store totals in session variables
      $_SESSION['total_responden_sd'] = $total_responden_sd;
      $_SESSION['total_responden_smp'] = $total_responden_smp;
      $_SESSION['total_responden_sma'] = $total_responden_sma;
      $_SESSION['total_responden_diploma'] = $total_responden_diploma;
      $_SESSION['total_responden_sarjana'] = $total_responden_sarjana;
      $_SESSION['total_responden_lulusan'] = $total_responden_lulusan;

    
    // Validate and sanitize profession inputs
      $profesi_sangat_puas_pns = validateInput($_POST['profesi_sangat_puas_pns']);
      $profesi_puas_pns = validateInput($_POST['profesi_puas_pns']);
      $profesi_kurang_puas_pns = validateInput($_POST['profesi_kurang_puas_pns']);
      $profesi_sangat_kurang_puas_pns = validateInput($_POST['profesi_sangat_kurang_puas_pns']);

      $profesi_sangat_puas_swasta_wiraswasta = validateInput($_POST['profesi_sangat_puas_swasta_wiraswasta']);
      $profesi_puas_swasta_wiraswasta = validateInput($_POST['profesi_puas_swasta_wiraswasta']);
      $profesi_kurang_puas_swasta_wiraswasta = validateInput($_POST['profesi_kurang_puas_swasta_wiraswasta']);
      $profesi_sangat_kurang_puas_swasta_wiraswasta = validateInput($_POST['profesi_sangat_kurang_puas_swasta_wiraswasta']);

      $profesi_sangat_puas_pelajar_mahasiswa = validateInput($_POST['profesi_sangat_puas_pelajar_mahasiswa']);
      $profesi_puas_pelajar_mahasiswa = validateInput($_POST['profesi_puas_pelajar_mahasiswa']);
      $profesi_kurang_puas_pelajar_mahasiswa = validateInput($_POST['profesi_kurang_puas_pelajar_mahasiswa']);
      $profesi_sangat_kurang_puas_pelajar_mahasiswa = validateInput($_POST['profesi_sangat_kurang_puas_pelajar_mahasiswa']);

      $profesi_sangat_puas_pengangguran = validateInput($_POST['profesi_sangat_puas_pengangguran']);
      $profesi_puas_pengangguran = validateInput($_POST['profesi_puas_pengangguran']);
      $profesi_kurang_puas_pengangguran = validateInput($_POST['profesi_kurang_puas_pengangguran']);
      $profesi_sangat_kurang_puas_pengangguran = validateInput($_POST['profesi_sangat_kurang_puas_pengangguran']);

      // Store data in session variables
      $_SESSION['profesi_sangat_puas_pns'] = $profesi_sangat_puas_pns;
      $_SESSION['profesi_puas_pns'] = $profesi_puas_pns;
      $_SESSION['profesi_kurang_puas_pns'] = $profesi_kurang_puas_pns;
      $_SESSION['profesi_sangat_kurang_puas_pns'] = $profesi_sangat_kurang_puas_pns;

      $_SESSION['profesi_sangat_puas_swasta_wiraswasta'] = $profesi_sangat_puas_swasta_wiraswasta;
      $_SESSION['profesi_puas_swasta_wiraswasta'] = $profesi_puas_swasta_wiraswasta;
      $_SESSION['profesi_kurang_puas_swasta_wiraswasta'] = $profesi_kurang_puas_swasta_wiraswasta;
      $_SESSION['profesi_sangat_kurang_puas_swasta_wiraswasta'] = $profesi_sangat_kurang_puas_swasta_wiraswasta;

      $_SESSION['profesi_sangat_puas_pelajar_mahasiswa'] = $profesi_sangat_puas_pelajar_mahasiswa;
      $_SESSION['profesi_puas_pelajar_mahasiswa'] = $profesi_puas_pelajar_mahasiswa;
      $_SESSION['profesi_kurang_puas_pelajar_mahasiswa'] = $profesi_kurang_puas_pelajar_mahasiswa;
      $_SESSION['profesi_sangat_kurang_puas_pelajar_mahasiswa'] = $profesi_sangat_kurang_puas_pelajar_mahasiswa;

      $_SESSION['profesi_sangat_puas_pengangguran'] = $profesi_sangat_puas_pengangguran;
      $_SESSION['profesi_puas_pengangguran'] = $profesi_puas_pengangguran;
      $_SESSION['profesi_kurang_puas_pengangguran'] = $profesi_kurang_puas_pengangguran;
      $_SESSION['profesi_sangat_kurang_puas_pengangguran'] = $profesi_sangat_kurang_puas_pengangguran;

      // Calculate totals
      $total_responden_pns = $profesi_sangat_puas_pns + $profesi_puas_pns + $profesi_kurang_puas_pns + $profesi_sangat_kurang_puas_pns;
      $total_responden_swasta_wiraswasta = $profesi_sangat_puas_swasta_wiraswasta + $profesi_puas_swasta_wiraswasta + $profesi_kurang_puas_swasta_wiraswasta + $profesi_sangat_kurang_puas_swasta_wiraswasta;
      $total_responden_pelajar_mahasiswa = $profesi_sangat_puas_pelajar_mahasiswa + $profesi_puas_pelajar_mahasiswa + $profesi_kurang_puas_pelajar_mahasiswa + $profesi_sangat_kurang_puas_pelajar_mahasiswa;
      $total_responden_pengangguran = $profesi_sangat_puas_pengangguran + $profesi_puas_pengangguran + $profesi_kurang_puas_pengangguran + $profesi_sangat_kurang_puas_pengangguran;
      $total_responden_profesi = $total_responden_pns + $total_responden_swasta_wiraswasta + $total_responden_pelajar_mahasiswa + $total_responden_pengangguran;

      // Store totals in session variables
      $_SESSION['total_responden_pns'] = $total_responden_pns;
      $_SESSION['total_responden_swasta_wiraswasta'] = $total_responden_swasta_wiraswasta;
      $_SESSION['total_responden_pelajar_mahasiswa'] = $total_responden_pelajar_mahasiswa;
      $_SESSION['total_responden_pengangguran'] = $total_responden_pengangguran;
      $_SESSION['total_responden_profesi'] = $total_responden_profesi;

      header('Location: Admin_Tambah_Survey_Hal3.php');
      exit();
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

                  <!-- Tabel Gender -->
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
                                          <td><input type="number" name="gender_sangat_puas_laki" required
                                                      value="<?php echo htmlspecialchars($genderSangatPuasLaki); ?>">
                                          </td>
                                          <td><input type="number" name="gender_puas_laki" required
                                                      value="<?php echo htmlspecialchars($genderPuasLaki); ?>"></td>
                                          <td><input type="number" name="gender_kurang_puas_laki" required
                                                      value="<?php echo htmlspecialchars($genderKurangPuasLaki); ?>">
                                          </td>
                                          <td><input type="number" name="gender_sangat_kurang_puas_laki" required
                                                      value="<?php echo htmlspecialchars($genderSangatKurangPuasLaki); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Perempuan</td>
                                          <td><input type="number" name="gender_sangat_puas_perempuan" required
                                                      value="<?php echo htmlspecialchars($genderSangatPuasPerempuan); ?>">
                                          </td>
                                          <td><input type="number" name="gender_puas_perempuan" required
                                                      value="<?php echo htmlspecialchars($genderPuasPerempuan); ?>">
                                          </td>
                                          <td><input type="number" name="gender_kurang_puas_perempuan" required
                                                      value="<?php echo htmlspecialchars($genderKurangPuasPerempuan); ?>">
                                          </td>
                                          <td><input type="number" name="gender_sangat_kurang_puas_perempuan" required
                                                      value="<?php echo htmlspecialchars($genderSangatKurangPuasPerempuan); ?>">
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
                                          <td><input type="number" name="usia_sangat_puas_18_35" required
                                                      value="<?php echo htmlspecialchars($usiaSangatPuas18_35); ?>">
                                          </td>
                                          <td><input type="number" name="usia_puas_18_35" required
                                                      value="<?php echo htmlspecialchars($usiaPuas18_35); ?>"></td>
                                          <td><input type="number" name="usia_kurang_puas_18_35" required
                                                      value="<?php echo htmlspecialchars($usiaKurangPuas18_35); ?>">
                                          </td>
                                          <td><input type="number" name="usia_sangat_kurang_puas_18_35" required
                                                      value="<?php echo htmlspecialchars($usiaSangatKurangPuas18_35); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>36 Tahun ke atas</td>
                                          <td><input type="number" name="usia_sangat_puas_36_plus" required
                                                      value="<?php echo htmlspecialchars($usiaSangatPuas36Plus); ?>">
                                          </td>
                                          <td><input type="number" name="usia_puas_36_plus" required
                                                      value="<?php echo htmlspecialchars($usiaPuas36Plus); ?>"></td>
                                          <td><input type="number" name="usia_kurang_puas_36_plus" required
                                                      value="<?php echo htmlspecialchars($usiaKurangPuas36Plus); ?>">
                                          </td>
                                          <td><input type="number" name="usia_sangat_kurang_puas_36_plus" required
                                                      value="<?php echo htmlspecialchars($usiaSangatKurangPuas36Plus); ?>">
                                          </td>
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
                                          <td><input type="number" name="lulusan_sangat_puas_sd" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatPuasSD); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_puas_sd" required
                                                      value="<?php echo htmlspecialchars($lulusanPuasSD); ?>"></td>
                                          <td><input type="number" name="lulusan_kurang_puas_sd" required
                                                      value="<?php echo htmlspecialchars($lulusanKurangPuasSD); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_sd" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatKurangPuasSD); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>SMP</td>
                                          <td><input type="number" name="lulusan_sangat_puas_smp" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatPuasSMP); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_puas_smp" required
                                                      value="<?php echo htmlspecialchars($lulusanPuasSMP); ?>"></td>
                                          <td><input type="number" name="lulusan_kurang_puas_smp" required
                                                      value="<?php echo htmlspecialchars($lulusanKurangPuasSMP); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_smp" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatKurangPuasSMP); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>SMA</td>
                                          <td><input type="number" name="lulusan_sangat_puas_sma" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatPuasSMA); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_puas_sma" required
                                                      value="<?php echo htmlspecialchars($lulusanPuasSMA); ?>"></td>
                                          <td><input type="number" name="lulusan_kurang_puas_sma" required
                                                      value="<?php echo htmlspecialchars($lulusanKurangPuasSMA); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_sma" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatKurangPuasSMA); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Diploma</td>
                                          <td><input type="number" name="lulusan_sangat_puas_diploma" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatPuasDiploma); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_puas_diploma" required
                                                      value="<?php echo htmlspecialchars($lulusanPuasDiploma); ?>"></td>
                                          <td><input type="number" name="lulusan_kurang_puas_diploma" required
                                                      value="<?php echo htmlspecialchars($lulusanKurangPuasDiploma); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_diploma" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatKurangPuasDiploma); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>S1/S2/S3</td>
                                          <td><input type="number" name="lulusan_sangat_puas_sarjana" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatPuasSarjana); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_puas_sarjana" required
                                                      value="<?php echo htmlspecialchars($lulusanPuasSarjana); ?>"></td>
                                          <td><input type="number" name="lulusan_kurang_puas_sarjana" required
                                                      value="<?php echo htmlspecialchars($lulusanKurangPuasSarjana); ?>">
                                          </td>
                                          <td><input type="number" name="lulusan_sangat_kurang_puas_sarjana" required
                                                      value="<?php echo htmlspecialchars($lulusanSangatKurangPuasSarjana); ?>">
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
                                          <td><input type="number" name="profesi_sangat_puas_pns" required
                                                      value="<?php echo htmlspecialchars($profesiSangatPuasPNS); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_puas_pns" required
                                                      value="<?php echo htmlspecialchars($profesiPuasPNS); ?>"></td>
                                          <td><input type="number" name="profesi_kurang_puas_pns" required
                                                      value="<?php echo htmlspecialchars($profesiKurangPuasPNS); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_pns" required
                                                      value="<?php echo htmlspecialchars($profesiSangatKurangPuasPNS); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Swasta/Wiraswasta</td>
                                          <td><input type="number" name="profesi_sangat_puas_swasta_wiraswasta" required
                                                      value="<?php echo htmlspecialchars($profesiSangatPuasSwastaWiraswasta); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_puas_swasta_wiraswasta" required
                                                      value="<?php echo htmlspecialchars($profesiPuasSwastaWiraswasta); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_kurang_puas_swasta_wiraswasta" required
                                                      value="<?php echo htmlspecialchars($profesiKurangPuasSwastaWiraswasta); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_swasta_wiraswasta"
                                                      required
                                                      value="<?php echo htmlspecialchars($profesiSangatKurangPuasSwastaWiraswasta); ?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Pelajar/Mahasiswa</td>
                                          <td><input type="number" name="profesi_sangat_puas_pelajar_mahasiswa" required
                                                      value="<?php echo htmlspecialchars($profesiSangatPuasPelajarMahasiswa); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_puas_pelajar_mahasiswa" required
                                                      value="<?php echo htmlspecialchars($profesiPuasPelajarMahasiswa); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_kurang_puas_pelajar_mahasiswa" required
                                                      value="<?php echo htmlspecialchars($profesiKurangPuasPelajarMahasiswa); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_pelajar_mahasiswa"
                                                      required
                                                      value="<?php echo htmlspecialchars($profesiSangatKurangPuasPelajarMahasiswa); ?>">
                                          </td>
                                    </tr>

                                    <tr>
                                          <td>Pengangguran</td>
                                          <td><input type="number" name="profesi_sangat_puas_pengangguran" required
                                                      value="<?php echo htmlspecialchars($profesiSangatPuasPengangguran); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_puas_pengangguran" required
                                                      value="<?php echo htmlspecialchars($profesiPuasPengangguran); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_kurang_puas_pengangguran" required
                                                      value="<?php echo htmlspecialchars($profesiKurangPuasPengangguran); ?>">
                                          </td>
                                          <td><input type="number" name="profesi_sangat_kurang_puas_pengangguran"
                                                      required
                                                      value="<?php echo htmlspecialchars($profesiSangatKurangPuasPengangguran); ?>">
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