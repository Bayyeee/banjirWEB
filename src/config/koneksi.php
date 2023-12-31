<?php
$server = "localhost";
$username = "jack";
$password = "sayangbunda0098";
$database = "banjir";

$koneksi = mysqli_connect($server,$username,$password,$database);

if (mysqli_connect_error()) {
    echo "database gagal terhubung";
}
