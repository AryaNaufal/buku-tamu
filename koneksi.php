<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "buku-tamu";

$koneksi = mysqli_connect($server, $user, $password, $database);

if (!$koneksi) die("Koneksi gagal: " . mysqli_connect_error());
