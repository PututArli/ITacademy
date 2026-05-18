<?php
session_start();
require_once '../model/koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$nama_user = $_SESSION['nama'];

$pecah_nama = explode(" ", $nama_user);
$nama_depan = $pecah_nama[0];
$nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .profile-container { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 32px; max-width: 600px; margin: 20px auto 0 auto; }
        .profile-header { display: flex; align-items: center; gap: 20px; margin-bottom: 32px; border-bottom: 1px solid var(--border); padding-bottom: 24px; }
        .profile-avatar-big { width: 80px; height: 80px; border-radius: 50%; background: var(--accent-purple); color: white; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 700; }
        .profile-title-text { font-size: 20px; font-weight: 700; }
        .profile-subtitle-text { font-size: 14px; color: var(--text-muted); margin-top: 4px; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        @media (max-width: 480px) { .form-grid { grid-template-columns: 1fr; } }
        
        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
        .form-group label { font-size: 13px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input { padding: 12px 14px; background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 10px; color: var(--text-primary); font-size: 14px; transition: var(--transition); outline: none; }
        .form-input:focus { border-color: var(--accent-blue); }
        .form-input[readonly] { opacity: 0.6; cursor: not-allowed; }
        
        .btn-save { background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple)); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: var(--transition); width: 100%; margin-top: 12px; box-shadow: 0 4px 20px rgba(59,130,246,0.2); }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(59,130,246,0.3); }

        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; display: none; align-items: center; justify-content: center; }
        .modal-overlay.show { display: flex !important; opacity: 1 !important; }
        .modal-box { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 20px; padding: 32px; width: 100%; max-width: 440px; margin: 20px; }
        .modal-title { font-size: 18px; font-weight: 700; margin-bottom: 20px; }
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
            <div class="nav-label">Manajemen</div>
            <a href="admin_dashboard.php" class="nav-item"><span class="nav-icon">&#9776;</span> Dashboard</a>
            <a href="admin_pengguna.php" class="nav-item"><span class="nav-icon">&#9786;</span> Pengguna</a>
            <a href="admin_mentor.php" class="nav-item"><span class="nav-icon">&#9998;</span> Mentor</a>
            <a href="admin_kursus.php" class="nav-item"><span class="nav-icon">&#9650;</span> Kursus</a>
            <div class="nav-label">Akun</div>
            <a href="admin_profil.php" class="nav-item active"><span class="nav-icon">&#9651;</span> Profil Admin</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                <div>
                    <div class="user-name"><?= $nama_user; ?></div>
                    <div class="user-role">Administrator</div>
                </div>
                <a href="#" class="user-logout" title="Keluar" onclick="bukaModalLogout(event)">&#8592;</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Pengaturan Akun Admin</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">
                
                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= $nama_user; ?></div>
                        <div class="profile-subtitle-text">Role: Sistem Utama Administrator &middot; ITacademy</div>
                    </div>
                </div>

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Profil admin berhasil diperbarui! (Simulasi)');">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan Admin</label>
                            <input type="text" class="form-input" value="<?= $nama_depan; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" value="<?= $nama_belakang; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email Utama Sistem</label>
                        <input type="email" class="form-input" value="admin@itacademy.com" readonly>
                    </div>

                    <div class="form-group">
                        <label>Hak Akses Tingkat</label>
                        <input type="text" class="form-input" value="Super Administrator (Full Access)" readonly>
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan Akun</button>
                </form>

            </div>
        </div>
    </div>

</div>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-title" style="text-align:center; font-size:22px; margin-bottom:8px; font-weight:700;">Yakin ingin keluar?</div>
        <p style="text-align:center; font-size:14px; color:var(--text-secondary); margin-bottom:24px; line-height:1.6;">
            Sesi admin kamu akan diakhiri. Kamu harus masuk kembali untuk mengelola sistem ITacademy.
        </p>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-ghost" style="flex:1; justify-content:center;" onclick="tutupModalLogout()">Batal</button>
            <a href="logout.php" class="btn btn-primary" style="flex:1; justify-content:center; background:#ef4444; text-decoration:none; display:flex; align-items:center;">Ya, Keluar</a>
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