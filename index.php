<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="60;url=http://localhost">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSBKBS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image/water.png" type="image/icon type">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins&display=swap" rel="stylesheet">
</head>
<body onload="startTime()">
    <main id="main"></main>
    <div class="header">
        <h1>Monitoring Siaga Banjir Kecamatan Banjarmasin Selatan</h1>
    </div>
    <div class="dashboard">
        <div class="container1">
        <div class="box1">
    <h2 align="center"><i class="fas fa-calendar-day" style="margin-right: 10px; color: #2ecc71;" ></i>Today</h2>
    <div class="datetime">
        <h3><i class="far fa-calendar" style="margin-right: 10px; color: #e74c3c;"></i>TANGGAL : 
        <p id="date"></p>
        </h3>
    </div>
    <div class="datetime">
        <h3><i class="far fa-clock" style="color: #e74c3c;"></i> WAKTU : 
        <p id="time"></p>
        </h3>
    </div>
    <!-- <span class="tempsymbol"><i class="fas fa-clouds cloud"></i><span class="cloudy"> Status</span></span> -->
    <!-- <div class="temp">
        <div class="Temperature">
            <strong id="temperature">Loading...</strong><sup>°C</sup>
            <p>Temperature</p>
        </div>
    </div> -->
</div>

            <div class="box1">
                <h2 align="center"><i class="fas fa-tint" style="margin-right: 10px; color: #3498db;"></i>Water level</h2>
                <table>
                    <tr>
                        <th>Ketinggian Air</th>
                        <th>Waktu</th>
                    </tr>
                    <?php
                    // Koneksi ke database MySQL (Anda dapat menggunakan berkas koneksi.php)
                    include 'koneksi.php';
                    // Query untuk mengambil data terbaru dari tabel ketinggian_air
                    $sql = "SELECT * FROM ketinggian_air ORDER BY waktu_input DESC LIMIT 1";
                    $result = $koneksi->query($sql);
                    // Periksa jika ada data yang ditemukan
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<tr>";
                        echo "<td class='numeric'>" . $row["tinggi_air"] . " cm</td>";
                        echo "<td>" . $row["waktu_input"] . "</td>";
                        echo "</tr>";
                    } else {
                        echo "<tr><td colspan='2' class='colspan'>Tidak ada data ketinggian air.</td></tr>";
                    }
                    // Tutup koneksi ke database
                    $koneksi->close();
                    ?>
                </table>
            </div>
        </div>
            <div class="box1">
                <h2 align="center"><i class="fas fa-water" style="margin-right: 10px; color: #3498db;"></i>Water Speed</h2>        
            </div>
        </div> 
    </div>
    <script src="IoT.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/js/all.js"></script>
</body>
</html>
