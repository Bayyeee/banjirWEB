<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "banjir";

$koneksi = mysqli_connect($server,$username,$password,$database);

if (mysqli_connect_error()) {
    echo "database gagal terhubung";
}
