<?php
require_once 'model/koneksi.php';

if (isset($_SESSION['nama'])) {
    header("Location: " . BASEURL . "/index.php");
    exit();
}

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
                $success = "Akun berhasil dibuat! Silakan masuk.";
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-split-container">
    
    <div class="auth-split-visual">
        <div class="auth-split-content-wrap">
            <h1 class="brand-name">IT<span>academy</span></h1>
            <p class="brand-tagline">Mulai perjalanan belajarmu hari ini. Bersiaplah menjadi talenta teknologi masa depan.</p>
            </div>
    </div>

    <div class="auth-split-form-side">
        <div class="auth-card" style="max-width:460px;">
            <a href="index.php" class="back-home">&larr; Kembali ke Beranda</a>

            <h1 class="auth-title" style="text-align: left; margin-bottom: 6px;">Buat Akun Baru</h1>
            <p class="auth-subtitle" style="text-align: left; margin-bottom: 24px;">Bergabung dan mulai kuasai dunia IT hari ini</p>

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

                <button type="submit" class="btn btn-primary btn-full btn-lg" style="margin-top: 10px;">Buat Akun</button>
            </form>

            <div class="auth-footer" style="text-align: left; margin-top: 24px;">
                Sudah punya akun? <a href="index.php?page=login">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($success)): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= $success ?>',
            icon: 'success',
            confirmButtonText: 'Lanjut Login',
            background: 'var(--bg-card)',
            color: 'var(--text-primary)',
            confirmButtonColor: 'var(--accent-blue)'
        }).then((result) => {
            window.location.href = 'index.php?page=login';
        });
    </script>
<?php endif; ?>

</body>
</html>