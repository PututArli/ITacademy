<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">

    <!-- Memanggil Sidebar User -->
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Ringkasan Belajar</div>
            <div class="topbar-actions">
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">

            <div class="welcome-bar">
                <div>
                    <div class="welcome-text">Selamat datang, <?= htmlspecialchars($nama_user); ?>! 👋</div>
                    <div class="welcome-sub">Lanjutkan progress belajarmu hari ini. Fokus pada proyek akhir!</div>
                </div>
                <a href="<?= BASEURL ?>/index.php?page=materi" class="btn btn-primary" style="background: var(--accent-blue); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">Lanjut Belajar</a>
            </div>

            <div class="stats-grid">
                <a href="<?= BASEURL ?>/index.php?page=materi" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon blue"></div>
                    <div><div class="stat-value">8/12</div><div class="stat-label">Modul Selesai</div></div>
                </a>
                <a href="<?= BASEURL ?>/index.php?page=kuis" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon purple"></div>
                    <div><div class="stat-value">2/3</div><div class="stat-label">Kuis Lulus</div></div>
                </a>
                <a href="<?= BASEURL ?>/index.php?page=tugas" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon gold"></div>
                    <div>
                        <div class="stat-value">
                            <?= (isset($status_tugas) && $status_tugas != 'Belum Mengirim') ? '1' : '0'; ?>
                        </div>
                        <div class="stat-label">Tugas Dikirim</div>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/index.php?page=sertifikat" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon green"></div>
                    <div>
                        <div class="stat-value">
                            <?= (isset($status_tugas) && $status_tugas == 'Selesai') ? '1' : '0'; ?>
                        </div>
                        <div class="stat-label">Sertifikat</div>
                    </div>
                </a>
            </div>

            <div class="section-header">
                <div class="section-title">Kurikulum Web Development</div>
            </div>

            <div class="two-col">
                <!-- Kolom Kiri: Modul dan Tugas -->
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
                            <a href="<?= BASEURL ?>/index.php?page=tugas" class="btn btn-ghost" style="font-size:13px;padding:6px 12px;"><?= ($_SESSION['role'] === 'free') ? 'Buka Premium' : 'Kirim Tugas' ?></a>
                        </div>
                        <?php if ($_SESSION['role'] === 'free'): ?>
                        <div class="task-card" style="text-align:center; padding:30px 20px; border:1px dashed var(--border);">
                            <div style="font-size:32px; margin-bottom:12px;">🔒</div>
                            <div style="font-weight:600; margin-bottom:6px;">Tugas Proyek Terkunci</div>
                            <div style="font-size:13px; color:var(--text-muted);">Upgrade ke Premium untuk membuka tugas proyek akhir dan review mentor.</div>
                        </div>
                        <?php else: ?>
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
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Kolom Kanan: Sertifikat, Progress, Mentor -->
                <div>
                    <div class="section-header">
                        <div class="section-title">Sertifikat Kelulusan</div>
                    </div>
                    <div class="cert-box locked">
                        <div class="cert-icon" style="font-size: 48px; margin-bottom: 10px;">🔒</div>
                        <div class="cert-title">Belum Tersedia</div>
                        <p class="cert-desc">
                            <?php if ($_SESSION['role'] === 'free'): ?>
                                Sertifikat digital adalah fitur eksklusif. Upgrade ke Premium untuk mendapatkan sertifikat setelah lulus.
                            <?php else: ?>
                                Sertifikat digital akan otomatis terbuka setelah tugas proyek akhir kamu dinyatakan LULUS oleh mentor.
                            <?php endif; ?>
                        </p>
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
                            <div class="ring-num" style="color:#f59e0b;"><?= ($_SESSION['role'] === 'free') ? '🔒' : '1/1' ?></div>
                            <div>
                                <div class="ring-title">Proyek Akhir</div>
                                <div class="ring-label"><?= ($_SESSION['role'] === 'free') ? 'Premium Only' : 'Menunggu persetujuan mentor' ?></div>
                            </div>
                        </div>
                    </div>

                    <?php if ($_SESSION['role'] === 'premium'): ?>
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
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>