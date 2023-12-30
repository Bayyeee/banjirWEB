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

    <!-- Chart untuk statistik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
</head>

<body>
<?php
include "src/config/koneksi.php";
?>
<div class="wrapper">
    <!-- Untuk SideBar -->
    <div class="sidebar" data-color="" data-image="assets/img/banjarmasin.png">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text" style="font-weight: bolder; color: black;">
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
                <li>
                    <a href="table.php">
                        <i class="pe-7s-note2"></i>
                        <p>Table Data</p>
                    </a>
                </li>
                <li class="active">
                    <a href="statistik.php">
                        <i class="pe-7s-graph2"></i>
                        <p>Statistics</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="">
                        <i class="pe-7s-map"></i>
                        <p>Location</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Untuk Navigasi Bar -->
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" style="font-weight: bolder; color: black;">Statistics Monitoring</a>
                </div>
            </div>
        </nav>

        <!-- Main Content yang ditampilkan -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Statitics Ketinggian Air</h4>
                            </div>
                            <div class="content">
                                <div class="ct-chart">
                                    <canvas id="iotChartContainer"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Statistics Kecepatan Air</h4>
                            </div>
                            <div class="content">
                                <div class="ct-chart">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer Bawah -->
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

<script type="text/javascript">
    $(document).ready(function(){

        demo.initChartist();

    });
</script>

<script>
    function refreshCard() {
        $.ajax({
            url: 'grafketinggian.php',
            type: 'GET',
            success: function (data) {
                // Mengganti konten grafik pada tampilan utama
                $('#iotChartContainer').html(data);
            },
            error: function (error) {
                console.error('Error loading graph:', error);
            }
        });

        $.ajax({
            url: 'grafik_humidity.php',
            type: 'GET',
            success: function (data) {
                // Mengganti konten grafik pada tampilan utama
                $('#iothumidity').html(data);
            },
            error: function (error) {
                console.error('Error loading graph:', error);
            }
        });
        $.ajax({
            url: 'grafik_mq.php',
            type: 'GET',
            success: function (data) {
                // Mengganti konten grafik pada tampilan utama
                $('#mq2').html(data);
            },
            error: function (error) {
                console.error('Error loading graph:', error);
            }
        });
    }

    // Merefresh card setiap 5 detik
    setInterval(refreshCard, 5000);

    // Merefresh grafik setiap 5 detik
    setInterval(loadGraph, 5000);

    // Memanggil fungsi refreshCard saat halaman pertama kali dimuat
    $(document).ready(refreshCard);

    // Memanggil fungsi loadGraph saat halaman pertama kali dimuat
    $(document).ready(loadGraph);
</script>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<script src="assets/js/chart.js/Chart.min.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
</body>
</html>
