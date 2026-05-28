<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style.css">
</head>
<body>

<div class="auth-split-container">
    
    <div class="auth-split-visual">
        <div class="auth-split-content-wrap">
            <h1 class="brand-name">IT<span>academy</span></h1>
            <p class="brand-tagline">Tempat terbaik untuk membangun portofolio nyata, mengasah keahlian digital, dan melangkah pasti menuju karier IT impianmu.</p>
        </div>
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

                <?php if(isset($_GET['timeout'])): ?>
                    <div style="color: #f59e0b; background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); padding: 8px; border-radius: 8px; font-size: 12px; margin-bottom: 16px; text-align: center; font-weight: 600;">
                        Sesi Anda berakhir karena tidak ada aktivitas selama 30 menit. Silakan masuk kembali.
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required placeholder="email@contoh.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-input" required placeholder="******">
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