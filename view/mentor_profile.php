<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../model/koneksi.php';

// PROTEKSI LOGIN MENTOR
if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'mentor') {
    header("Location: " . BASEURL . "/index.php?page=login");
    exit();
}

$nama_user = $_SESSION['nama'];

// Mengambil data detail mentor yang sedang login dari database
// Kita cari berdasarkan nama atau id_user sesuai session kelompokmu
$query_mentor = "SELECT * FROM users WHERE nama = '" . mysqli_real_escape_string($conn, $nama_user) . "' AND role = 'mentor' LIMIT 1";
$ambil_mentor = mysqli_query($conn, $query_mentor);
$data_mentor = mysqli_fetch_assoc($ambil_mentor);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mentor - ITacademy</title>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/style.css">
    <style>
        .mentor-layout { display: flex; min-height: 100vh; background-color: #0f172a; color: #f8fafc; font-family: sans-serif; }
        .sidebar { width: 260px; background-color: #1e293b; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid #334155; box-sizing: border-box; }
        .main-content { flex: 1; padding: 40px; }
        .brand-name { font-size: 20px; font-weight: bold; color: #3b82f6; text-decoration: none; }
        .brand-name span { color: #38bdf8; }
        .nav-menu { list-style: none; padding: 0; margin: 20px 0; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #94a3b8; text-decoration: none; border-radius: 8px; margin-bottom: 8px; font-weight: 500; }
        .nav-item.active { background-color: #334155; color: #38bdf8; }
        .nav-item:hover { background-color: #334155; color: #ffffff; }
        
        /* Style Khusus Halaman Profil */
        .profile-container { background-color: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; max-width: 600px; margin-top: 24px; }
        .profile-header { display: flex; align-items: center; gap: 24px; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 24px; }
        .profile-avatar { width: 80px; height: 80px; background-color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: bold; color: white; box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
        .info-group { margin-bottom: 20px; }
        .info-label { font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px; }
        .info-value { font-size: 16px; color: #ffffff; background-color: #0f172a; padding: 12px 16px; border-radius: 8px; border: 1px solid #334155; }
    </style>
</head>
<body>

<div class="mentor-layout">
    <div class="sidebar">
        <div>
            <a href="<?= BASEURL ?>/index.php?page=mentor_dashboard" class="brand-name">IT<span>academy</span></a>
            <div style="font-size: 11px; color: #64748b; margin-top: 24px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Mentor</div>
            <ul class="nav-menu">
                <li><a href="<?= BASEURL ?>/index.php?page=mentor_dashboard" class="nav-item">📊 Dashboard</a></li>
                <li><a href="<?= BASEURL ?>/index.php?page=review_tugas" class="nav-item">📝 Review Tugas</a></li>
                <li><a href="<?= BASEURL ?>/index.php?page=mentor_siswa" class="nav-item">👥 Siswa Saya</a></li>
            </ul>
            <div style="font-size: 11px; color: #64748b; margin-top: 24px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Akun</div>
            <ul class="nav-menu">
                <li><a href="<?= BASEURL ?>/index.php?page=mentor_profile" class="nav-item active">👤 Profil</a></li>
                <li><a href="#" onclick="bukaModalLogout(event)" class="nav-item" style="color: #f87171;">🚪 Keluar</a></li>
            </ul>
        </div>
        
        <div style="background-color: #111827; padding: 12px; border-radius: 12px; display: flex; align-items: center; gap: 12px;">
            <div style="width: 36px; height: 36px; background-color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            <div>
                <div style="font-size: 14px; font-weight: 600; color: white;"><?= htmlspecialchars($nama_user); ?></div>
                <div style="font-size: 11px; color: #64748b;">Mentor</div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <h1 style="font-size: 24px; font-weight: 700; color: white; margin: 0;">Profil Saya</h1>
        <p style="color: #94a3b8; font-size: 14px; margin: 4px 0 0 0;">Informasi akun mentor data terdaftar platform ITacademy.</p>
        
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?= strtoupper(substr($nama_user, 0, 2)); ?>
                </div>
                <div>
                    <h2 style="margin: 0; font-size: 20px; color: white;"><?= htmlspecialchars($nama_user); ?></h2>
                    <p style="margin: 4px 0 0 0; color: #38bdf8; font-weight: 600; font-size: 14px;">ID Mentor: #<?= $data_mentor['id'] ?? '-'; ?></p>
                </div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value"><?= htmlspecialchars($data_mentor['nama'] ?? $nama_user); ?></div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Alamat Email</div>
                <div class="info-value"><?= htmlspecialchars($data_mentor['email'] ?? 'belum diatur'); ?></div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Peran Sistem (Role)</div>
                <div class="info-value" style="color: #38bdf8; font-weight: 600; text-transform: uppercase;">💼 <?= htmlspecialchars($data_mentor['role'] ?? 'MENTOR'); ?></div>
            </div>
        </div>
    </div>
</div>

<div id="logoutModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; width: 100%; max-width: 400px; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 16px;">👋</div>
        <h2 style="color: #ffffff; font-size: 20px; font-weight: 700; margin-bottom: 8px;">Yakin ingin keluar?</h2>
        <p style="color: #94a3b8; font-size: 14px; line-height: 1.5; margin-bottom: 24px;">Sesi ngajar kamu akan diakhiri. Kamu harus masuk kembali untuk mengakses dashboard.</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="tutupModalLogout()" style="background: #334155; color: #ffffff; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; flex: 1;">Batal</button>
            <a href="index.php?page=logout" style="background: #ef4444; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; flex: 1; display: inline-block;">Ya, Keluar</a>
        </div>
    </div>
</div>

<script>
function bukaModalLogout(e) { e.preventDefault(); document.getElementById('logoutModal').style.display = 'flex'; }
function tutupModalLogout() { document.getElementById('logoutModal').style.display = 'none'; }
</script>
</body>
</html>