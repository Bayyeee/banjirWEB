<?php
include "src/config/koneksi.php";

//
$query = mysqli_query($koneksi, "SELECT MAX(id) AS id, flow_rate, MAX(timestamp ) AS timestamp FROM water_flow_data GROUP BY flow_rate ORDER BY timestamp DESC LIMIT 10");
$KecepatanAirData = [];
$timestamp = [];
while ($data = mysqli_fetch_array($query)) {
    $KecepatanAirData[] = $data['flow_rate'];
    $timestamp[] = date('H:i:s', strtotime($data['timestamp']));
}
$KecepatanAirData = array_reverse($KecepatanAirData);
$timestamp = array_reverse($timestamp);
?>



<!-- Bagian untuk grafik -->
<div class="grafik-container">
    <canvas id="iotChart"></canvas>
</div>

<script>
    // Ambil elemen canvas
    var ctx = document.getElementById('iotChart').getContext('2d');

    // Buat grafik menggunakan Chart.js
    var iotChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($timestamp); ?>,
            datasets: [{
                label: 'Kecepatan Air ',
                backgroundColor: 'rgba(255,30,30,0.39)',
                borderColor: 'rgb(241,94,94)',
                borderWidth: 1,
                data: <?php echo json_encode($KecepatanAirData); ?>,
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
