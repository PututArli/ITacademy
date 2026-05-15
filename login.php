<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ITacademy</title>
    <link rel="stylesheet" href="assets/css/style.css">
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

        <h1 class="auth-title">Selamat Datang Kembali 👋</h1>
        <p class="auth-subtitle">Masuk untuk lanjutkan perjalanan belajarmu</p>

        <form action="dashboard.php" id="loginForm">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input id="email" type="email" class="form-input" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input id="password" type="password" class="form-input" placeholder="Masukkan password" required>
            </div>
            <div class="form-group">
                <label class="form-label">Masuk Sebagai</label>
                <select id="role" class="form-input" required>
                    <option value="" disabled selected>Pilih peran...</option>
                    <option value="user">👤 User (Free / Premium)</option>
                    <option value="mentor">🎓 Mentor</option>
                    <option value="admin">🛡️ Admin</option>
                </select>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <label style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--text-secondary);cursor:pointer;">
                    <input type="checkbox" style="accent-color:var(--accent-blue);"> Ingat saya
                </label>
                <a href="#" style="font-size:13px;color:var(--accent-blue);">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-primary btn-full btn-lg">Masuk Sekarang</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
</div>
</body>
</html>
