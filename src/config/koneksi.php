<?php
$host = 'localhost';
$user = 'jack';
$pass = 'sayangbunda0098';
$dbname = 'banjir';

// Buat koneksi ke database
$koneksi = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die('Koneksi database gagal: ' . $koneksi->connect_error);
}

