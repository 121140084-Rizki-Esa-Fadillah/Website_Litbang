<?php
include 'Koneksi_survei_litbang.php';

// Fetch the latest survey
$sql = "SELECT * FROM survey ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$surveyData = [];

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $surveyData['title'] = $row['title'];
    $surveyData['id_wilayah'] = $row['id_wilayah'];
}

// Fetch the latest data for gender
$sqlGender = "SELECT * FROM gender ORDER BY id DESC LIMIT 1";
$resultGender = $conn->query($sqlGender);

if ($resultGender->num_rows > 0) {
    $rowGender = $resultGender->fetch_assoc();
    $surveyData['gender'] = [
        'laki_laki' => [
            'sangat_puas' => $rowGender['laki_laki_sangat_puas'],
            'puas' => $rowGender['laki_laki_puas'],
            'kurang_puas' => $rowGender['laki_laki_kurang_puas'],
            'sangat_kurang_puas' => $rowGender['laki_laki_sangat_kurang_puas']
        ],
        'perempuan' => [
            'sangat_puas' => $rowGender['perempuan_sangat_puas'],
            'puas' => $rowGender['perempuan_puas'],
            'kurang_puas' => $rowGender['perempuan_kurang_puas'],
            'sangat_kurang_puas' => $rowGender['perempuan_sangat_kurang_puas']
        ]
    ];
}

// Similarly, fetch data for usia, lulusan, and profesi if needed.

// Fetch the latest data for usia
$sqlUsia = "SELECT * FROM usia ORDER BY id DESC LIMIT 1";
$resultUsia = $conn->query($sqlUsia);

if ($resultUsia->num_rows > 0) {
    $rowUsia = $resultUsia->fetch_assoc();
    $surveyData['usia'] = [
        '18_35' => [
            'sangat_puas' => $rowUsia['18_35_sangat_puas'],
            'puas' => $rowUsia['18_35_puas'],
            'kurang_puas' => $rowUsia['18_35_kurang_puas'],
            'sangat_kurang_puas' => $rowUsia['18_35_sangat_kurang_puas']
        ],
        '36_up' => [
            'sangat_puas' => $rowUsia['36_up_sangat_puas'],
            'puas' => $rowUsia['36_up_puas'],
            'kurang_puas' => $rowUsia['36_up_kurang_puas'],
            'sangat_kurang_puas' => $rowUsia['36_up_sangat_kurang_puas']
        ]
    ];
}

// Fetch the latest data for lulusan
$sqlLulusan = "SELECT * FROM lulusan ORDER BY id DESC LIMIT 1";
$resultLulusan = $conn->query($sqlLulusan);

if ($resultLulusan->num_rows > 0) {
    $rowLulusan = $resultLulusan->fetch_assoc();
    $surveyData['lulusan'] = [
        'sd' => [
            'sangat_puas' => $rowLulusan['sd_sangat_puas'],
            'puas' => $rowLulusan['sd_puas'],
            'kurang_puas' => $rowLulusan['sd_kurang_puas'],
            'sangat_kurang_puas' => $rowLulusan['sd_sangat_kurang_puas']
        ],
        'smp' => [
            'sangat_puas' => $rowLulusan['smp_sangat_puas'],
            'puas' => $rowLulusan['smp_puas'],
            'kurang_puas' => $rowLulusan['smp_kurang_puas'],
            'sangat_kurang_puas' => $rowLulusan['smp_sangat_kurang_puas']
        ],
        'sma' => [
            'sangat_puas' => $rowLulusan['sma_sangat_puas'],
            'puas' => $rowLulusan['sma_puas'],
            'kurang_puas' => $rowLulusan['sma_kurang_puas'],
            'sangat_kurang_puas' => $rowLulusan['sma_sangat_kurang_puas']
        ],
        'diploma' => [
            'sangat_puas' => $rowLulusan['diploma_sangat_puas'],
            'puas' => $rowLulusan['diploma_puas'],
            'kurang_puas' => $rowLulusan['diploma_kurang_puas'],
            'sangat_kurang_puas' => $rowLulusan['diploma_sangat_kurang_puas']
        ],
        'sarjana' => [
            'sangat_puas' => $rowLulusan['sarjana_sangat_puas'],
            'puas' => $rowLulusan['sarjana_puas'],
            'kurang_puas' => $rowLulusan['sarjana_kurang_puas'],
            'sangat_kurang_puas' => $rowLulusan['sarjana_sangat_kurang_puas']
        ]
    ];
}

// Fetch the latest data for profesi
$sqlProfesi = "SELECT * FROM profesi ORDER BY id DESC LIMIT 1";
$resultProfesi = $conn->query($sqlProfesi);

if ($resultProfesi->num_rows > 0) {
    $rowProfesi = $resultProfesi->fetch_assoc();
    $surveyData['profesi'] = [
        'pns' => [
            'sangat_puas' => $rowProfesi['pns_sangat_puas'],
            'puas' => $rowProfesi['pns_puas'],
            'kurang_puas' => $rowProfesi['pns_kurang_puas'],
            'sangat_kurang_puas' => $rowProfesi['pns_sangat_kurang_puas']
        ],
        'swasta_wiraswasta' => [
            'sangat_puas' => $rowProfesi['swasta_wiraswasta_sangat_puas'],
            'puas' => $rowProfesi['swasta_wiraswasta_puas'],
            'kurang_puas' => $rowProfesi['swasta_wiraswasta_kurang_puas'],
            'sangat_kurang_puas' => $rowProfesi['swasta_wiraswasta_sangat_kurang_puas']
        ],
        'pelajar_mahasiswa' => [
            'sangat_puas' => $rowProfesi['pelajar_mahasiswa_sangat_puas'],
            'puas' => $rowProfesi['pelajar_mahasiswa_puas'],
            'kurang_puas' => $rowProfesi['pelajar_mahasiswa_kurang_puas'],
            'sangat_kurang_puas' => $rowProfesi['pelajar_mahasiswa_sangat_kurang_puas']
        ],
        'pengangguran' => [
            'sangat_puas' => $rowProfesi['pengangguran_sangat_puas'],
            'puas' => $rowProfesi['pengangguran_puas'],
            'kurang_puas' => $rowProfesi['pengangguran_kurang_puas'],
            'sangat_kurang_puas' => $rowProfesi['pengangguran_sangat_kurang_puas']
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($surveyData);

$conn->close();
?>