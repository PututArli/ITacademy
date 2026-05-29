<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style.css">
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
                    <label class="form-label">Paket Pilihan Kamu</label>
                    <select name="role_hidden" class="form-input" style="font-weight: 600; cursor: pointer;">
                        <option value="free" <?= $plan_pilihan == 'free' ? 'selected' : '' ?>>Paket Free (Gratis)</option>
                        <option value="premium" <?= $plan_pilihan == 'premium' ? 'selected' : '' ?>>Paket Premium</option>
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
    <div id="successData" data-message="<?= $success ?>" style="display:none;"></div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASEURL ?>/assets/js/main.js"></script>

</body>
</html>