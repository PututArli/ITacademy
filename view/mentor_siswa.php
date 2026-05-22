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

// QUERY: Mengambil semua user yang rolenya 'siswa'
$ambil_siswa = mysqli_query($conn, "SELECT id, nama, email FROM users WHERE role = 'siswa' ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Saya - ITacademy</title>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/style.css">
    <style>
        .mentor-layout { display: flex; min-height: 100vh; background-color: #0f172a; color: #f8fafc; font-family: sans-serif; }
        .sidebar { width: 260px; background-color: #1e293b; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid #334155; }
        .main-content { flex: 1; padding: 40px; }
        .brand-name { font-size: 20px; font-weight: bold; color: #3b82f6; text-decoration: none; }
        .brand-name span { color: #38bdf8; }
        .nav-menu { list-style: none; padding: 0; margin: 20px 0; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #94a3b8; text-decoration: none; border-radius: 8px; margin-bottom: 8px; font-weight: 500; }
        .nav-item.active { background-color: #334155; color: #38bdf8; }
        .nav-item:hover { background-color: #334155; color: #ffffff; }
        
        /* Style Tabel Premium Dark Mode */
        .siswa-table { width: 100%; border-collapse: collapse; background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; margin-top: 24px; }
        .siswa-table th { background-color: #111827; color: #94a3b8; text-align: left; padding: 16px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #334155; }
        .siswa-table td { padding: 16px; color: #e2e8f0; font-size: 14px; border-bottom: 1px solid #334155; }
        .siswa-table tr:last-child td { border-bottom: none; }
        .siswa-table tr:hover { background-color: rgba(51, 65, 85, 0.5); }
        .badge-siswa { background-color: rgba(56, 189, 248, 0.1); color: #38bdf8; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
    </style>
</head>
<body>

<div class="mentor-layout">
    <div class="sidebar">
        <div>
            <a href="#" class="brand-name">IT<span>academy</span></a>
            <div style="font-size: 11px; color: #64748b; margin-top: 24px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Mentor</div>
            <ul class="nav-menu">
                <li><a href="index.php?page=mentor_dashboard" class="nav-item">📊 Dashboard</a></li>
                <li><a href="index.php?page=review_tugas" class="nav-item">📝 Review Tugas</a></li>
                <li><a href="index.php?page=mentor_siswa" class="nav-item active">☺ Siswa Saya</a></li>
            </ul>
            <div style="font-size: 11px; color: #64748b; margin-top: 24px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Akun</div>
            <ul class="nav-menu">
                <li><a href="index.php?page=profil" class="nav-item">👤 Profil</a></li>
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
        <h1 style="font-size: 24px; font-weight: 700; color: white; margin: 0;">Daftar Siswa</h1>
        <p style="color: #94a3b8; font-size: 14px; margin: 4px 0 0 0;">Seluruh siswa aktif yang terdaftar di platform ITacademy.</p>
        
        <table class="siswa-table">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nama Siswa</th>
                    <th>Alamat Email</th>
                    <th>Status Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($ambil_siswa && mysqli_num_rows($ambil_siswa) > 0) {
                    while($row = mysqli_fetch_assoc($ambil_siswa)) {
                ?>
                    <tr>
                        <td style="font-weight: 600; color: #64748b;">#<?= $row['id']; ?></td>
                        <td style="font-weight: 600; color: #ffffff;"><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><span class="badge-siswa">Siswa Aktif</span></td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align: center; color: #64748b; padding: 24px;'>Belum ada data siswa terdaftar di database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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