<?php
session_start();
require_once '../model/koneksi.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama       = mysqli_real_escape_string($conn, $_POST['nama']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $role       = mysqli_real_escape_string($conn, $_POST['role']);
    $password   = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($password !== $konfirmasi) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($cek_email) > 0) {
            $error = "Email sudah terdaftar, gunakan email lain!";
        } else {
            $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
            
            if (mysqli_query($conn, $query)) {
                echo "<script>
                    alert('Akun berhasil dibuat! Silakan masuk.');
                    window.location.href = 'login.php';
                </script>";
                exit;
            } else {
                $error = "Gagal menyimpan ke database: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="auth-screen">
    <div class="auth-bg-glow glow-1"></div>
    <div class="auth-bg-glow glow-2"></div>

    <div class="auth-card" style="max-width:460px;">
        <div class="auth-logo">
            <div class="brand-icon">IT</div>
            <span class="brand-name">IT<span>academy</span></span>
        </div>

        <h1 class="auth-title">Buat Akun Baru</h1>
        <p class="auth-subtitle">Bergabung dan mulai kuasai dunia IT hari ini</p>

        <form action="" method="POST" id="registerForm">
            
            <?php if(!empty($error)): ?>
                <div style="color: #ef4444; font-size: 13px; margin-bottom: 12px; text-align: center; font-weight: 600;"><?= $error; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input id="nama" name="nama" type="text" class="form-input" placeholder="Nama lengkapmu" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-input" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipe Akun</label>
                <select id="tipe" name="role" class="form-input" required>
                    <option value="" disabled selected>Pilih tipe akun...</option>
                    <option value="free">User (Free) — Gratis</option>  
                    <option value="premium">User (Premium) — Rp 99k/bln</option>
                    <option value="mentor">Mentor</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input id="password" name="password" type="password" class="form-input" placeholder="Min. 8 karakter" required>
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input id="konfirmasi" name="konfirmasi" type="password" class="form-input" placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-full btn-lg">Buat Akun</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </div>
    </div>
</div>
</body>
</html>