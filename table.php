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

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.css">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="" data-image="assets/img/banjarmasin.png">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text" style="font-weight: bolder; color: black;">
                    MSBKBS
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-note2"></i>
                        <p>Table Data</p>
                    </a>
                </li>
                <li >
                    <a href="statistik.php">
                        <i class="pe-7s-graph2"></i>
                        <p>Statistics</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="font-weight: bolder; color: black;">Table Data</a>
            </div>
        </nav>
        <!-- UNTUK KETINGGIAN AIR -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ketinggian Air</h4>
                                <!-- Dropdown untuk memilih jumlah data -->
                                <label for="jumlah_data">Jumlah Data : </label>
                                <select id="jumlah_data" onchange="updateTable()">
                                    <option value="10" <?php echo isset($_GET['jumlah_data']) && $_GET['jumlah_data'] == 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="25" <?php echo isset($_GET['jumlah_data']) && $_GET['jumlah_data'] == 25 ? 'selected' : ''; ?>>25</option>
                                    <option value="50" <?php echo isset($_GET['jumlah_data']) && $_GET['jumlah_data'] == 50 ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?php echo isset($_GET['jumlah_data']) && $_GET['jumlah_data'] == 100 ? 'selected' : ''; ?>>100</option>
                                    <option value="all" <?php echo isset($_GET['jumlah_data']) && $_GET['jumlah_data'] == 'all' ? 'selected' : ''; ?>>All</option>
                                </select>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-bordered" id="ketinggianAirTable">
                                    <thead>
                                    <th style="font-weight: bolder; color: black;">ID</th>
                                    <th style="font-weight: bolder; color: black;">Ketinggian Air</th>
                                    <th style="font-weight: bolder; color: black;">Waktu</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Koneksi ke database MySQL (Anda dapat menggunakan berkas koneksi.php)
                                    include 'src/config/koneksi.php';

                                    // Ambil nilai jumlah data dari parameter URL
                                    $jumlahData = isset($_GET['jumlah_data']) ? $_GET['jumlah_data'] : '10';

                                    // Query untuk mengambil semua data atau sesuai parameter
                                    if ($jumlahData == 'all') {
                                        $sql = "SELECT * FROM ketinggian_air";
                                    } else {
                                        $sql = "SELECT * FROM ketinggian_air LIMIT " . $jumlahData;
                                    }

                                    $result = $koneksi->query($sql);

                                    // Periksa jika ada data yang ditemukan
                                    if ($result->num_rows > 0) {
                                        $lastTinggiAir = null;

                                        while ($row = $result->fetch_assoc()) {
                                            // Cek apakah nilai tinggi_air sama dengan yang sebelumnya
                                            if ($row["tinggi_air"] != $lastTinggiAir) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["tinggi_air"] . " cm</td>";
                                                echo "<td>" . $row["waktu_input"] . "</td>";
                                                echo "</tr>";
                                                $lastTinggiAir = $row["tinggi_air"];
                                            }
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' class='colspan'>Tidak ada data ketinggian air.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- UNTUK KECEPATAN AIR -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Kecepatan Air</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>ID</th>
                                    <th>Kecepatan Air</th>
                                    <th>Waktu</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    </div>
</div>


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

<!-- Script JavaScript untuk memuat ulang tabel berdasarkan jumlah data yang dipilih -->
<script>
    function updateTable() {
        var jumlahData = document.getElementById("jumlah_data").value;

        // Redirect atau load ulang halaman dengan parameter jumlah_data
        window.location.href = "table.php?jumlah_data=" + jumlahData;
    }
</script>
</html>
