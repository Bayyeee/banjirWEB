<?php
    include 'src/config/koneksi.php';

// Menerima data dari ESP32
$flow_rate = $_POST['flow_rate'];

// Menyimpan data ke dalam tabel
$sql = "INSERT INTO water_flow_data (flow_rate) VALUES ('$flow_rate')";

if ($koneksi->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}
$koneksi->close();