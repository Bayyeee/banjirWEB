<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MSBKBS</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyIxO6RPW3Rn0e2+i1DGMN4N54n5z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-XpMLC1VwJjY8BME0zEHiwPLOt+5fLrN5uFHIxTqIrKoas5Z6MVBw91K46adFvT5v" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyIxO6RPW3Rn0e2+i1DGMN4N54n5z" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
include "src/config/koneksi.php";
?>

<!-- Page Wrapper -->
<div id="wrapper-content">
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-5">
                            <div class="card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-black-50">Chart Data</h6>
                                    <div class="navbar navbar-expand">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link font-weight-bold " href="index.php">Dashboard</a>
                                            </li>
                                            <li class="nav-item font-weight-bold">
                                                <a class="nav-link" href="table.php">Table Data</a>
                                            </li>
                                            <li class="nav-item font-weight-bold">
                                                <a class="nav-link" href="stati.php">Statistics</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Add additional card content or body here if needed -->
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <!-- suhu -->
                                    <div class="col-md-6">
                                        <div class="card shadow mb-10">
                                            <div class="card-body">
                                                <div class="chart-area">
                                                    <div class="panel-body">
                                                        <div class="grafik-container">
                                                            <div id="iotChartContainer"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tambahkan kartu lainnya jika diperlukan -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



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

                <!-- Page level plugins -->
                <script src="assets/js/chart.js/Chart.min.js"></script>

</body>

</html>
