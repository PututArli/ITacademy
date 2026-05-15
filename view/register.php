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

        <form action="login.php" id="registerForm">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input id="nama" type="text" class="form-input" placeholder="Nama lengkapmu" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input id="email" type="email" class="form-input" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipe Akun</label>
                <select id="tipe" class="form-input" required>
                    <option value="" disabled selected>Pilih tipe akun...</option>
                    <option value="free">User (Free) — Gratis</option>  
                    <option value="premium">User (Premium) — Rp 99k/bln</option>
                    <option value="mentor">Mentor</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input id="password" type="password" class="form-input" placeholder="Min. 8 karakter" required>
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input id="konfirmasi" type="password" class="form-input" placeholder="Ulangi password" required>
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
