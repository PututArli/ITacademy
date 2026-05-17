<?php
session_start();
require_once '../model/koneksi.php';
$nama_user = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : "User";

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
    <title>Dashboard - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .welcome-bar { background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(139,92,246,0.06)); border: 1px solid rgba(59,130,246,0.2); border-radius: var(--radius); padding: 20px 24px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .welcome-text { font-size: 18px; font-weight: 700; }
        .welcome-sub { font-size: 14px; color: var(--text-secondary); margin-top: 2px; }

        .module-list { display: flex; flex-direction: column; gap: 8px; }
        .module-row { display: flex; align-items: center; gap: 14px; padding: 14px 18px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; transition: var(--transition); cursor: pointer; }
        .module-row:hover { border-color: var(--border-accent); }
        .module-num { width: 32px; height: 32px; border-radius: 8px; background: var(--glass); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: var(--text-muted); flex-shrink: 0; }
        .module-num.done { background: rgba(16,185,129,0.15); border-color: rgba(16,185,129,0.3); color: #10b981; }
        .module-num.current { background: rgba(59,130,246,0.15); border-color: rgba(59,130,246,0.3); color: var(--accent-blue); }
        .module-info { flex: 1; }
        .module-name { font-size: 14px; font-weight: 600; }
        .module-detail { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

        .task-section { margin-top: 24px; }
        .task-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; margin-top: 12px; }
        .task-status { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .task-file { display: flex; align-items: center; gap: 10px; padding: 12px; background: var(--glass); border: 1px solid var(--border); border-radius: 10px; font-size: 13px; color: var(--text-secondary); margin-bottom: 12px; }
        .task-file-icon { font-size: 20px; }
        .task-feedback { padding: 14px; background: rgba(59,130,246,0.05); border: 1px solid rgba(59,130,246,0.15); border-radius: 10px; font-size: 13px; color: var(--text-secondary); line-height: 1.6; }
        .task-feedback-label { font-size: 12px; font-weight: 600; color: var(--accent-blue); margin-bottom: 6px; }

        .cert-box { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 28px; text-align: center; }
        .cert-box.locked { opacity: 0.6; }
        .cert-icon { font-size: 40px; margin-bottom: 12px; }
        .cert-title { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
        .cert-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.5; }

        .progress-ring { display: flex; align-items: center; gap: 14px; padding: 16px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; }
        .ring-num { font-size: 22px; font-weight: 800; color: var(--accent-blue); min-width: 50px; }
        .ring-label { font-size: 13px; color: var(--text-secondary); }
        .ring-title { font-size: 14px; font-weight: 600; }

        .two-col { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
        @media (max-width: 960px) { .two-col { grid-template-columns: 1fr; } }

        .upload-area { border: 2px dashed var(--border); border-radius: 12px; padding: 24px; text-align: center; cursor: pointer; transition: var(--transition); margin-top: 12px; }
        .upload-area:hover { border-color: var(--accent-blue); background: rgba(59,130,246,0.03); }
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
            <a href="dashboard.php?nama=<?= urlencode($nama_user); ?>" class="nav-item active"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="materi.php?nama=<?= urlencode($nama_user); ?>" class="nav-item"><span class="nav-icon">📖</span> Materi Belajar</a>
            <a href="kuis.php?nama=<?= urlencode($nama_user); ?>" class="nav-item"><span class="nav-icon">🧩</span> Kuis Latihan</a>
            <a href="tugas.php?nama=<?= urlencode($nama_user); ?>" class="nav-item"><span class="nav-icon">📁</span> Tugas Proyek</a>
            <a href="sertifikat.php?nama=<?= urlencode($nama_user); ?>" class="nav-item"><span class="nav-icon">🎓</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="profil.php?nama=<?= urlencode($nama_user); ?>" class="nav-item"><span class="nav-icon">👤</span> Profil Saya</a>
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
            <div class="topbar-title">Ringkasan Belajar</div>
            <div class="topbar-actions">
                <a href="profil.php?nama=<?= urlencode($nama_user); ?>">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">

            <div class="welcome-bar">
                <div>
                    <div class="welcome-text">Selamat datang, <?= $nama_user; ?>! 👋</div>
                    <div class="welcome-sub">Lanjutkan progress belajarmu hari ini. Fokus pada proyek akhir!</div>
                </div>
                <a href="materi.php?nama=<?= urlencode($nama_user); ?>" class="btn btn-primary" style="background: var(--accent-blue); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">Lanjut Belajar</a>
            </div>

            <div class="stats-grid">
                <a href="materi.php?nama=<?= urlencode($nama_user); ?>" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon blue">📖</div>
                    <div><div class="stat-value">8/12</div><div class="stat-label">Modul Selesai</div></div>
                </a>
                <a href="kuis.php?nama=<?= urlencode($nama_user); ?>" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon purple">🧩</div>
                    <div><div class="stat-value">2/3</div><div class="stat-label">Kuis Lulus</div></div>
                </a>
                <a href="tugas.php?nama=<?= urlencode($nama_user); ?>" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon gold">📁</div>
                    <div><div class="stat-value">1</div><div class="stat-label">Tugas Dikirim</div></div>
                </a>
                <a href="sertifikat.php?nama=<?= urlencode($nama_user); ?>" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon green">🎓</div>
                    <div><div class="stat-value">0</div><div class="stat-label">Sertifikat</div></div>
                </a>
            </div>

            <div class="section-header">
                <div class="section-title">Kurikulum Web Development</div>
            </div>

            <div class="two-col">

                <div>
                    <div class="module-list">
                        <div class="module-row">
                            <div class="module-num done">&check;</div>
                            <div class="module-info">
                                <div class="module-name">Modul 1: Pengenalan HTML & Struktur Dasar</div>
                                <div class="module-detail">4 Video &middot; 1 Kuis</div>
                            </div>
                            <span class="badge badge-green" style="color: #10b981;">Selesai &check;</span>
                        </div>
                        <div class="module-row">
                            <div class="module-num done">&check;</div>
                            <div class="module-info">
                                <div class="module-name">Modul 2: CSS Styling & Layout Dasar</div>
                                <div class="module-detail">5 Video &middot; 1 Kuis</div>
                            </div>
                            <span class="badge badge-green" style="color: #10b981;">Selesai &check;</span>
                        </div>
                        <div class="module-row">
                            <div class="module-num done">&check;</div>
                            <div class="module-info">
                                <div class="module-name">Modul 3: Flexbox & Grid Layout Modern</div>
                                <div class="module-detail">4 Video &middot; 1 Kuis</div>
                            </div>
                            <span class="badge badge-green" style="color: #10b981;">Selesai &check;</span>
                        </div>
                        <div class="module-row">
                            <div class="module-num current">4</div>
                            <div class="module-info">
                                <div class="module-name">Modul 4: JavaScript Dasar & Logika Pemrograman</div>
                                <div class="module-detail">2/6 Video ditonton &middot; Kuis Belum</div>
                            </div>
                            <span class="badge badge-blue">Sedang Dipelajari</span>
                        </div>
                        <div class="module-row" style="opacity:0.5;">
                            <div class="module-num">5</div>
                            <div class="module-info">
                                <div class="module-name">Modul 5: DOM Manipulation & Interaktivitas</div>
                                <div class="module-detail">Belum terbuka</div>
                            </div>
                            <span class="badge" style="color:var(--text-muted);">Terkunci</span>
                        </div>
                    </div>

                    <div class="task-section">
                        <div class="section-header">
                            <div class="section-title">Tugas Proyek</div>
                            <a href="tugas.php?nama=<?= urlencode($nama_user); ?>" class="btn btn-ghost" style="font-size:13px;padding:6px 12px;">Kirim Tugas</a>
                        </div>
                        <div class="task-card">
                            <div class="task-status">
                                <span class="badge badge-gold" style="background: rgba(245,158,11,0.15); color: #f59e0b; padding: 4px 8px; border-radius: 6px; font-size: 12px;">Sedang Direview</span>
                                <span style="font-size:12px;color:var(--text-muted); margin-left: 10px;">Dikirim 15 Mei 2026</span>
                            </div>
                            <div style="font-size:15px;font-weight:600;margin-top:10px;margin-bottom:8px;">Landing Page Portfolio Bisnis</div>
                            <div class="task-file">
                                <span class="task-file-icon">📁</span>
                                <span>portfolio-<?= strtolower(explode(' ', $nama_user)[0]); ?>-v2.zip (3.1 MB)</span>
                            </div>
                            <div class="task-feedback">
                                <div class="task-feedback-label">Catatan Terakhir dari Mentor (Budi Santoso)</div>
                                Kode responsifnya sudah rapi di tampilan mobile. Saya cek struktur kodenya dulu ya, besok siang saya kabari lagi hasilnya.
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="section-header">
                        <div class="section-title">Sertifikat Kelulusan</div>
                    </div>
                    <div class="cert-box locked">
                        <div class="cert-icon" style="font-size: 48px; margin-bottom: 10px;">🔒</div>
                        <div class="cert-title">Belum Tersedia</div>
                        <p class="cert-desc">Sertifikat digital akan otomatis terbuka setelah tugas proyek akhir kamu dinyatakan LULUS oleh mentor.</p>
                    </div>

                    <div style="margin-top:24px;">
                        <div class="section-header">
                            <div class="section-title">Progress Belajar</div>
                        </div>
                        <div class="progress-ring">
                            <div class="ring-num">66%</div>
                            <div>
                                <div class="ring-title">Materi Terbuka</div>
                                <div class="ring-label">8 dari 12 modul selesai</div>
                            </div>
                        </div>
                        <div class="progress-ring">
                            <div class="ring-num" style="color:#a855f7;">75%</div>
                            <div>
                                <div class="ring-title">Kuis Latihan</div>
                                <div class="ring-label">3 dari 4 kuis diselesaikan</div>
                            </div>
                        </div>
                        <div class="progress-ring">
                            <div class="ring-num" style="color:#f59e0b;">1/1</div>
                            <div>
                                <div class="ring-title">Proyek Akhir</div>
                                <div class="ring-label">Menunggu persetujuan mentor</div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:24px;">
                        <div class="section-header">
                            <div class="section-title">Mentor Kamu</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;padding:14px;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;">
                            <div class="user-avatar" style="width:40px;height:40px;font-size:14px; background: var(--accent-purple); color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%;">BS</div>
                            <div>
                                <div style="font-size:14px;font-weight:600;">Budi Santoso</div>
                                <div style="font-size:12px;color:var(--text-muted);">Senior Frontend Developer</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</body>
</html>