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

$pecah_nama = explode(" ", $nama_user);
$nama_depan = $pecah_nama[0];
$nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Tetap mempertahankan style layout asli bawaan temanmu */
        .profile-container { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 32px; max-width: 600px; margin: 0 auto; }
        .profile-header { display: flex; align-items: center; gap: 20px; margin-bottom: 32px; border-bottom: 1px solid var(--border); padding-bottom: 24px; }
        .profile-avatar-big { width: 80px; height: 80px; border-radius: 50%; background: var(--accent-blue); color: white; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 700; }
        .profile-title-text { font-size: 20px; font-weight: 700; }
        .profile-subtitle-text { font-size: 14px; color: var(--text-muted); margin-top: 4px; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        @media (max-width: 480px) { .form-grid { grid-template-columns: 1fr; } }
        
        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
        .form-group label { font-size: 13px; font-weight: 600; color: var(--text-secondary); }
        .form-input { padding: 10px 14px; background: var(--glass); border: 1px solid var(--border); border-radius: 8px; color: var(--text-main); font-size: 14px; transition: var(--transition); }
        .form-input:focus { border-color: var(--accent-blue); outline: none; }
        .form-input[readonly] { opacity: 0.6; cursor: not-allowed; }
        
        .btn-save { background: var(--accent-blue); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: var(--transition); width: 100%; margin-top: 12px; }
        .btn-save:hover { background: #2563eb; }
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
            <a href="dashboard.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>" class="nav-item"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="materi.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>" class="nav-item"><span class="nav-icon">📖</span> Materi Belajar</a>
            <a href="kuis.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>" class="nav-item"><span class="nav-icon">🧩</span> Kuis Latihan</a>
            <a href="tugas.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>" class="nav-item"><span class="nav-icon">📁</span> Tugas Proyek</a>
            <a href="sertifikat.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>" class="nav-item"><span class="nav-icon">🎓</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="profil.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>" class="nav-item active"><span class="nav-icon">👤</span> Profil Saya</a>
            <a href="login.php" class="nav-item" style="color: #f87171;"><span class="nav-icon">🚪</span> Keluar</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                <div>
                    <div class="user-name"><?= $nama_user; ?></div>
                    <div class="user-role" style="font-size: 12px; color: var(--text-muted);"><?= $status_keanggotaan; ?></div>
                </div>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Pengaturan Akun</div>
            <div class="topbar-actions">
                <a href="profil.php?nama=<?= urlencode($nama_user); ?>&role=<?= urlencode($role_user); ?>">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">
                
                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= $nama_user; ?></div>
                        <div class="profile-subtitle-text"><?= $status_keanggotaan; ?> &middot; Anggota sejak Mei 2026</div>
                    </div>
                </div>

                <form action="#" method="POST" onsubmit="event.preventDefault();">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan</label>
                            <input type="text" class="form-input" value="<?= $nama_depan; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" value="<?= $nama_belakang; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" class="form-input" value="rizkaaprilia567@gmail.com" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tipe Keanggotaan</label>
                        <input type="text" class="form-input" value="<?= $status_keanggotaan; ?>" readonly>
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </form>

            </div>
        </div>
    </div>

</div>
</body>
</html>