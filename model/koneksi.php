<?php
$host = 'sql107.infinityfree.com';
$user = 'if0_41926977';
$pass = 'Workplus123';
$db   = 'it_academy';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>