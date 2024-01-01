<?php
include 'src/config/koneksi.php';

// Ambil data dari ESP32 untuk ketinggian air
$tinggi_air = $_POST['waterLevel'];

// Ambil data dari database
$sql_kecepatan_air = "SELECT flow_rate FROM water_flow_data ORDER BY id DESC LIMIT 1";
$result_kecepatan_air = $koneksi->query($sql_kecepatan_air);

if ($result_kecepatan_air->num_rows > 0) {
    $row = $result_kecepatan_air->fetch_assoc();
    $flow_rate = $row['flow_rate'];
} else {
    $flow_rate = 0; // Nilai default jika data tidak ditemukan
}

// Masukkan data tinggi air ke dalam tabel ketinggian_air
$sql_tinggi_air = "INSERT INTO ketinggian_air (tinggi_air, waktu_input) VALUES ('$tinggi_air', NOW())";

$koneksi->close();
