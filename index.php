<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/water.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>MSBKBS</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.css">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">

</head>
<body onload="startTime()">
<div class="wrapper">
    <!--MAIN SIDEBAR-->
    <div class="sidebar" data-color="yellow" data-image="assets/img/banjarmasin.png">
    <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text" style="font-weight: bolder; color: black;">
                    MSBKBS
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="table.php">
                        <i class="pe-7s-note2"></i>
                        <p>Table Data</p>
                    </a>
                </li>
                <li>
                    <a href="statistik.php">
                        <i class="pe-7s-graph2"></i>
                        <p>Statistics</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="https://maps.app.goo.gl/fQV3WYaxogNkRsjr6" target="_blank">
                        <i class="pe-7s-map"></i>
                        <p>Location</p>
                    </a>
                </li>
                <li >
                    <a href="src/config/koneksi.php">
                        test database
                    </a>
                </li>
            </ul>
    </div>
    </div>

    <!--MAIN NAVBAR -->
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" style="box-shadow: 2px 2px 5px gray; background-image: linear-gradient(to right, #d7d2cc 0%, #304352 100%);">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="color: black; font-size: x-large; font-family: 'Roboto Slab', sans-serif; font-weight: 500;">Monitoring Siaga Banjir Kecamatan Banjarmasin Selatan</a>
                </div>
            </div>
        </nav>

        <main id="main"></main>

    <!--MAIN CONTENT YANG AKAN DITAMPILKAN-->
        <div class="content">
            <div class="container-fluid">

                <div class="header">
                    <h1 style="color: white; font-family: 'Roboto Slab', sans-serif; font-weight: 500;">Monitoring Siaga Banjir Kecamatan Banjarmasin Selatan</h1>
                </div>
                <div class="dashboard">
                    <div class="container1">
                        <div class="box4">
                            <h2 align="center"><i class="fas fa-calendar-day" style="margin-right: 10px; color: #2ecc71; font-family: 'Roboto Slab', sans-serif; font-weight: 500;" ></i>Today</h2>
                            <div class="datetime">
                                <h3><i class="far fa-calendar" style="margin-right: 10px; color: #e74c3c; font-family: 'Roboto Slab', sans-serif; font-weight: 500;"></i>Date : <span id="date"> </span></h3>
                            </div>
                            <div class="datetime">
                                <h3><i class="far fa-clock" style="color: #e74c3c; font-family: 'Roboto Slab', sans-serif; font-weight: 500;"></i> Time : <span id="time"> </span></h3>
                            </div>
                        </div>

                        <div class="box1">
                            <h2 align="center"><i class="fas fa-tint" style="margin-right: 10px; color: #3498db; font-family: 'Roboto Slab', sans-serif; font-weight: 500;"></i>Water level</h2>
                            <table style="font-family: 'Roboto Slab', sans-serif; font-weight: 500;">
                                <tr>
                                    <th>Ketinggian Air</th>
                                    <th>Waktu</th>
                                </tr>
                                <?php
                                // Koneksi ke database MySQL (Anda dapat menggunakan berkas koneksi.php)
                                include 'src/config/koneksi.php';
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
                        <table>
                            <tr>
                                <th>Kecepatan Air</th>
                                <th>Waktu</th>
                            </tr>
                            <?php
                            // Koneksi ke database MySQL (Anda dapat menggunakan berkas koneksi.php)
                            include 'src/config/koneksi.php';
                            // Query untuk mengambil data terbaru dari tabel kecepatan_air
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
            </div>
        </div>

    <!--MAIN FOOTER-->
<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                            MSBKBS @Copyright 2023
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <!-- Untuk waktu dan API BMKG -->
    <script src="assets/js/Iot.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/js/all.js"></script>
</html>
