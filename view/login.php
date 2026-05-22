<?php
require_once 'model/koneksi.php';

if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
    $nama_url = urlencode($_SESSION['nama']);
    if ($_SESSION['role'] === 'admin') {
        header("Location: " . BASEURL . "/index.php?page=admin_dashboard&nama=" . $nama_url);
    } elseif ($_SESSION['role'] === 'mentor') {
        header("Location: " . BASEURL . "/index.php?page=mentor_dashboard&nama=" . $nama_url);
    } else {
        header("Location: " . BASEURL . "/index.php?page=dashboard&nama=" . $nama_url);
    }
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role = '$role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['role'] = $row['role'];

        $nama_url = urlencode($row['nama']);

        if ($row['role'] === 'admin') {
            echo "<script>window.location.href = '" . BASEURL . "/index.php?page=admin_dashboard&nama=" . $nama_url . "';</script>";
        } elseif ($row['role'] === 'mentor') {
            echo "<script>window.location.href = '" . BASEURL . "/index.php?page=mentor_dashboard&nama=" . $nama_url . "';</script>";
        } else {
            echo "<script>window.location.href = '" . BASEURL . "/index.php?page=dashboard&nama=" . $nama_url . "';</script>";
        }
        exit;
    }
    $error = "Email, Password, atau Peran salah!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ITacademy</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-split-container">
    
    <div class="auth-split-visual">
        <div class="auth-split-content-wrap">
            <h1 class="brand-name">IT<span>academy</span></h1>
            <p class=brand-tagline">Tempat terbaik untuk membangun portofolio nyata, mengasah keahlian digital, dan melangkah pasti menuju karier IT impianmu.</p>        </div>
    </div>

    <div class="auth-split-form-side">
        <div class="auth-card">
            <a href="index.php" class="back-home">&larr; Kembali ke Beranda</a>
            
            <h1 class="auth-title" style="text-align: left; margin-bottom: 6px;">Selamat Datang Kembali!</h1>
            <p class="auth-subtitle" style="text-align: left; margin-bottom: 24px;">Sesi belajar coding kamu sudah menunggu. Masuk sekarang.</p>
            
            <form action="" method="POST">
                
                <?php if(!empty($error)): ?>
                    <div style="color: #ef4444; font-size: 13px; margin-bottom: 12px; text-align: center; font-weight: 600;"><?= $error; ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required placeholder="email@contoh.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-input" required placeholder="******">
                </div>
                <div class="form-group">
                    <label class="form-label">Masuk Sebagai</label>
                    <select name="role" class="form-input" required>
                        <option value="" disabled selected>Pilih peran...</option>
                        <option value="free">User (Free)</option>  
                        <option value="premium">User (Premium)</option>
                        <option value="mentor">Mentor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-full btn-lg" style="margin-top: 10px;">Masuk Sistem</button>
            </form>
            
            <div class="auth-footer" style="text-align: left; margin-top: 24px;">
                Belum punya akun? <a href="index.php?page=register">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>