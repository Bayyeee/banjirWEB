<?php
include 'koneksi.php';

// Ambil data dari ESP32
$tinggi_air = $_POST['waterLevel']; // Sesuaikan dengan nama variabel yang Anda kirim dari ESP32

// Masukkan data tinggi air ke dalam tabel ketinggian_air
$sql_tinggi_air = "INSERT INTO ketinggian_air (tinggi_air, waktu_input) VALUES ('$tinggi_air', NOW())";

if ($koneksi->query($sql_tinggi_air) === TRUE) {
    echo 'Data tinggi air berhasil disimpan';
} else {
    echo 'Error: ' . $sql_tinggi_air . '<br>' . $koneksi->error;
}

$koneksi->close();
?>
