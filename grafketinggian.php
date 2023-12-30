<?php
include "src/config/koneksi.php";

//
$query = mysqli_query($koneksi, "SELECT MAX(id) AS id, tinggi_air, MAX(waktu_input) AS waktu_input FROM ketinggian_air GROUP BY tinggi_air ORDER BY waktu_input DESC LIMIT 10");
$tinggiAirData = [];
$timestamp = [];
while ($data = mysqli_fetch_array($query)) {
    $tinggiAirData[] = $data['tinggi_air'];
    $timestamp[] = date('H:i:s', strtotime($data['waktu_input']));
}
$tinggiAirData = array_reverse($tinggiAirData);
$timestamp = array_reverse($timestamp);
?>



<!-- Bagian untuk grafik -->
<div class="grafik-container">
    <canvas id="iotChartt"></canvas>
</div>

<script>
    // Ambil elemen canvas
    var ctx = document.getElementById('iotChartt').getContext('2d');

    // Buat grafik menggunakan Chart.js
    var iotChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($timestamp); ?>,
            datasets: [{
                label: 'Ketinggian Air ',
                backgroundColor: 'rgba(41,163,255,0.2)',
                borderColor: 'rgb(94,122,241)',
                borderWidth: 1,
                data: <?php echo json_encode($tinggiAirData); ?>,
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    reverse: true,
                    ticks: {
                        fontSize: 8
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 50 // Sesuaikan sesuai dengan kebutuhan
                    }
                }
            },
            plugins: {
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'xy'
                    },
                    zoom: {
                        enabled: true,
                        mode: 'xy'
                    }
                }
            },
            animation: {
                duration: 0 // Menonaktifkan animasi
            }
        }

    });
</script>
