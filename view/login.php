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
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="auth-screen">
    <div class="auth-bg-glow glow-1"></div>
    <div class="auth-bg-glow glow-2"></div>

    <div class="auth-card">
        <div class="auth-logo">
            <div class="brand-icon">IT</div>
            <span class="brand-name">IT<span>academy</span></span>
        </div>

        <h1 class="auth-title">Selamat Datang Kembali</h1>
        <p class="auth-subtitle">Masuk untuk lanjutkan perjalanan belajarmu</p>

        <form action="" method="POST">
            
            <?php if(!empty($error)): ?>
                <div style="color: #ef4444; font-size: 13px; margin-bottom: 12px; text-align: center; font-weight: 600;"><?= $error; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-input" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-input" placeholder="Masukkan password" required>
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

            <div style="margin-bottom:20px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--text-secondary);cursor:pointer;">
                    <input type="checkbox" style="accent-color:var(--accent-blue);"> Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-full btn-lg">Masuk Sekarang</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="<?= BASEURL ?>/index.php?page=register">Daftar di sini</a>
        </div>
    </div>
</div>
</body>
</html>