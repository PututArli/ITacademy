<?php
session_start();
require_once '../model/koneksi.php';

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit();
}

$nama_user = $_SESSION['nama'];
$ambil_user = mysqli_query($conn, "SELECT * FROM users WHERE nama = '$nama_user'");
$data = mysqli_fetch_assoc($ambil_user);
$role_user = isset($data['role']) ? $data['role'] : 'free';
$status_keanggotaan = "Siswa " . ucfirst($role_user);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Saya - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .cert-main-box { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 40px; text-align: center; max-width: 700px; margin: 40px auto 0 auto; }
        .cert-badge-status { background: rgba(245,158,11,0.1); color: #f59e0b; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; display: inline-block; margin-bottom: 20px; }
        .progress-list { margin-top: 32px; text-align: left; display: flex; flex-direction: column; gap: 12px; }
        .progress-item { display: flex; justify-content: space-between; align-items: center; padding: 16px; background: var(--glass); border: 1px solid var(--border); border-radius: 12px; }
        
        .locked-container { border: 2px dashed #f87171 !important; background: rgba(248,113,113,0.02) !important; }
        .btn-upgrade { background: #f59e0b; color: white; border: none; padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-block; margin-top: 20px; transition: var(--transition); }
        .btn-upgrade:hover { background: #d97706; transform: translateY(-1px); }
    </style>
</head>
<body>
<div class="app-layout">

    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">IT</div>
            <span class="brand-name">IT<span>academy</span></span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Belajar</div>
            <a href="dashboard.php" class="nav-item"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="materi.php" class="nav-item"><span class="nav-icon">📖</span> Materi Belajar</a>
            <a href="kuis.php" class="nav-item"><span class="nav-icon">🧩</span> Kuis Latihan</a>
            <a href="tugas.php" class="nav-item"><span class="nav-icon">📁</span> Tugas Proyek</a>
            <a href="sertifikat.php" class="nav-item active"><span class="nav-icon">🎓</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="profil.php" class="nav-item"><span class="nav-icon">👤</span> Profil Saya</a>
            <a href="#" class="nav-item" style="color: #f87171;" onclick="bukaModalLogout(event)"><span class="nav-icon">🚪</span> Keluar</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                <div>
                    <div class="user-name"><?= $nama_user; ?></div>
                    <div class="user-role" style="font-size: 12px; color: var(--text-muted);"><?= $status_keanggotaan; ?></div>
                </div>
                <a href="#" class="user-logout" title="Keluar" onclick="bukaModalLogout(event)">←</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Sertifikat Saya</div>
            <div class="topbar-actions">
                <span class="badge" style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size:12px; margin-right:10px;"><?= ucfirst($role_user); ?></span>
                <a href="profil.php">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            
            <?php if ($role_user === 'premium'): ?>
                <div class="cert-main-box">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔒</div>
                    <div style="font-size: 22px; font-weight: 700; margin-bottom: 8px;">Sertifikat Belum Tersedia</div>
                    <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 500px; margin: 0 auto;">
                        Sertifikat akan diterbitkan secara otomatis setelah mentor menyetujui tugas proyekmu. Pantau status pengirimanmu di bawah ini.
                    </p>

                    <div class="progress-list">
                        <div class="progress-item">
                            <div>
                                <div style="font-size: 14px; font-weight: 600;">Materi diselesaikan</div>
                                <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">8 dari 12 modul</div>
                            </div>
                            <span style="color: #10b981; font-weight: 600; font-size: 13px;">Selesai &check;</span>
                        </div>
                        <div class="progress-item">
                            <div>
                                <div style="font-size: 14px; font-weight: 600;">Kuis dilulusan</div>
                                <div style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">2 dari 3 kuis tersedia</div>
                            </div>
                            <span style="color: #10b981; font-weight: 600; font-size: 13px;">Selesai &check;</span>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="cert-main-box locked-container">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔒</div>
                    <div style="font-size: 22px; font-weight: 700; color: #f87171; margin-bottom: 8px;">Fitur Sertifikat Terkunci</div>
                    <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 520px; margin: 0 auto;">
                        Halo <strong><?= $nama_user; ?></strong>, saat ini Anda menggunakan akun <strong>Siswa Free</strong>. Fitur kelulusan, peninjauan kode proyek oleh mentor, serta klaim sertifikat digital resmi ITacademy hanya terbuka untuk anggota <strong>Premium</strong>.
                    </p>
                    <a href="profil.php" class="btn-upgrade">Upgrade ke Premium Sekarang</a>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-icon">👋</div>
        <div class="modal-title">Yakin ingin keluar?</div>
        <div class="modal-desc">Sesi belajar kamu akan diakhiri. Kamu harus masuk kembali untuk melanjutkan.</div>
        <div class="modal-actions">
            <button class="btn btn-ghost" onclick="tutupModalLogout()">Batal</button>
            <a href="logout.php" class="btn btn-danger">Ya, Keluar</a>
        </div>
    </div>
</div>

<script>
    function bukaModalLogout(e) {
        if (e) e.preventDefault();
        document.getElementById('modalLogout').classList.add('show');
    }
    function tutupModalLogout() {
        document.getElementById('modalLogout').classList.remove('show');
    }
</script>
</body>
</html>