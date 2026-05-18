<?php
$is_localhost = ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1' || $_SERVER['HTTP_HOST'] === 'localhost');

if ($is_localhost) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "it_academy";
} else {
    $host = "sql107.infinityfree.com";
    $user = "if0_41926977";
    $pass = "Workplus123";
    $db   = "if0_41926977_it_academy";
}

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>