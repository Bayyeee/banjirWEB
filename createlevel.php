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

if ($koneksi->query($sql_tinggi_air) === TRUE) {
    echo 'Data tinggi air berhasil disimpan ';

    // Cek jika ketinggian air kurang dari 50cm
    if ($tinggi_air < 50) {
        // Notifikasi ke Telegram
        $telegrambot = 'bot6424345808:AAHnMSaAjAoPTm2hVY1Jwq2mwiptUn08TU0';
        $user = '1441844858';
//        $pesan = 'Peringatan: Ketinggian air ' . $tinggi_air . 'cm. Kecepatan air ' . $flow_rate . 'm/s. Segera persiapkan diri!';
        $pesan = '🚨 Peringatan 🚨: Ketinggian air saat ini ' . $tinggi_air . ' cm dan kecepatan air ' . $flow_rate . ' l/mil.';

        // Kirim notifikasi ke Telegram
        kirim($pesan, $telegrambot, $user);
    }
} else {
    echo 'Error: ' . $sql_tinggi_air . '<br>' . $koneksi->error;
}

$koneksi->close();

// Fungsi untuk mengirim pesan ke Telegram
function kirim($pesan, $bot, $chat)
{
    $url = 'https://api.telegram.org/'.$bot.'/sendMessage?chat_id='.$chat.'&text='.$pesan;
    $result = file_get_contents($url, true);
    return $result;
}
