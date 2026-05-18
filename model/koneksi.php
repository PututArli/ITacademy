<?php
$is_localhost = (
    $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ||
    $_SERVER['REMOTE_ADDR'] === '::1' ||
    $_SERVER['HTTP_HOST'] === 'localhost' ||
    strpos($_SERVER['HTTP_HOST'], 'localhost') !== false
);

if ($is_localhost) {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "it_academy";
} else {
    $db_host = "sql107.infinityfree.com";
    $db_user = "if0_41926977";
    $db_pass = "Workplus123";
    $db_name = "if0_41926977_it_academy";
}

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$conn = $koneksi;
?>