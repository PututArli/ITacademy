<?php
$host = 'sql107.infinityfree.com';
$user = 'if0_41926977';
$pass = 'Workplus123';
$db   = 'if0_41926977_it_academy';

try {
    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    die("Error Database: " . $e->getMessage() . "<br>Pastikan nama database dan kredensial di model/koneksi.php sudah benar (termasuk prefix if0_...).");
}
?>