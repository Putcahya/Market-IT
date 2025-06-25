<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "market_it";

$conn = mysqli_connect($host, $user, $password, $database);

if ($conn) {
    //koneksi berhasil
} else {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>