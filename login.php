<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ITacademy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="auth-card">
        <h2>Masuk ITacademy</h2>
        <form action="dashboard.php">
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="********" required>
            </div>
            <div class="form-group">
                <label>Masuk Sebagai</label>
                <select>
                    <option value="user">User (Free/Premium)</option>
                    <option value="mentor">Mentor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn" style="width: 100%; margin-top: 10px;">Login</button>
        </form>
        <div class="switch-link">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>