<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "websitetechion";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Gagal terkoneksi");
} else {
    echo "Koneksi berhasil";
}
