<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Belajar - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Materi Belajar</div>
            <div class="topbar-actions">
                <span class="badge badge-gold"><?= $status_keanggotaan; ?></span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="materi-layout">
            <div class="module-sidebar">
                <div class="module-sidebar-title">Modul Kursus</div>
                <div class="mod-item active">
                    <div class="mod-dot active">3</div>
                    <div class="mod-label">Flexbox & Grid</div>
                    <span class="badge badge-blue" style="font-size:10px;padding:2px 7px;">Aktif</span>
                </div>
                <div class="mod-item">
                    <div class="mod-dot done">✓</div>
                    <div class="mod-label">Pengenalan HTML</div>
                </div>
            </div>

            <div class="video-area">
                <div class="video-player">
                    <div class="video-overlay">
                        <div class="play-btn" onclick="this.innerHTML='⏸'">▶</div>
                        <div class="video-title-overlay">CSS Flexbox — Konsep Dasar</div>
                    </div>
                </div>

                <div class="video-info">
                    <h1 class="video-title">CSS Flexbox & Grid Layout</h1>
                    <div class="video-meta">
                        <span>📖 Modul 3 · Video 1 dari 4</span>
                        <span>⏱ 12 menit</span>
                        <span class="badge badge-blue">Sedang Ditonton</span>
                    </div>
                </div>

                <div class="materi-content-tab">
                    <button class="tab-btn active" onclick="switchTab(this,'video')">Video</button>
                    <button class="tab-btn" onclick="switchTab(this,'materi')">Materi Teks</button>
                    <button class="tab-btn" onclick="switchTab(this,'kuis')">Kuis Modul</button>
                </div>

                <div id="tab-video">
                    <div class="video-list-title">Video dalam Modul Ini</div>
                    <div class="video-item active">
                        <div class="video-thumb">📹</div>
                        <div>
                            <div class="video-item-title">1. Konsep Dasar Flexbox</div>
                            <div class="video-item-dur">12 menit</div>
                        </div>
                        <span style="margin-left:auto;color:var(--accent-blue);font-size:12px;font-weight:600;">▶ Sedang</span>
                    </div>
                </div>

                <div id="tab-materi" style="display:none;">
                    <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;font-size:14px;line-height:1.9;color:var(--text-secondary);">
                        <h3 style="color:var(--text-primary);margin-bottom:12px;font-size:17px;">Apa itu Flexbox?</h3>
                        <p>Flexbox (Flexible Box) adalah model tata letak CSS yang memungkinkan kamu mengatur elemen-elemen di dalam sebuah container secara fleksibel.</p>
                    </div>
                </div>

                <div id="tab-kuis" style="display:none;">
                    <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center;">
                        <div style="font-size:36px;margin-bottom:14px;">🧩</div>
                        <div style="font-size:17px;font-weight:700;margin-bottom:8px;">Kuis Modul 3: CSS Flexbox & Grid</div>
                        <a href="<?= BASEURL ?>/index.php?page=kuis" class="btn btn-primary btn-lg">Mulai Kuis Sekarang</a>
                    </div>
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