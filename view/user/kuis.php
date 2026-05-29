<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Latihan - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title" id="topbarTitle">Kuis Latihan</div>
            <div class="topbar-actions">
                <span class="badge badge-gold"><?= $status_keanggotaan; ?></span>
                
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content" id="listView">
            <div style="margin-bottom:20px;">
                <h2 style="font-size:18px;font-weight:700;margin-bottom:4px;">Kuis Tersedia</h2>
                <p style="font-size:14px;color:var(--text-secondary);">Selesaikan kuis setelah menonton semua video di modul.</p>
            </div>
            <div class="kuis-list">
                <div class="kuis-item">
                    <div class="kuis-icon" style="background:rgba(16,185,129,0.15);">🌐</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 1: HTML Dasar</div>
                        <div style="font-size:13px;color:var(--text-muted);">5 soal · Skor kamu: 92/100</div>
                    </div>
                    <span class="badge badge-green">Lulus ✓</span>
                    <button class="btn btn-ghost" style="font-size:13px;" onclick="startKuis(1,'Kuis Modul 1: HTML Dasar')">Ulangi</button>
                </div>
                <div class="kuis-item">
                    <div class="kuis-icon" style="background:rgba(59,130,246,0.15);">📐</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 3: Flexbox & Grid</div>
                        <div style="font-size:13px;color:var(--text-muted);">5 soal · Belum dikerjakan</div>
                    </div>
                    <span class="badge badge-blue">Tersedia</span>
                    <button class="btn btn-primary" style="font-size:13px;" onclick="startKuis(3,'Kuis Modul 3: Flexbox & Grid')">Mulai</button>
                </div>
            </div>
        </div>

        <div class="page-content" style="padding:0;">
            <div class="kuis-wrap" id="kuisView" style="display:none;">
                <div class="kuis-header">
                    <div>
                        <div class="kuis-title" id="kuisName">—</div>
                        <div class="kuis-meta" id="kuisMeta">5 soal pilihan ganda</div>
                        <div style="margin-top:10px;">
                            <div class="progress-bar-wrap"><div class="progress-fill" id="progressFill" style="width:20%;"></div></div>
                            <div style="font-size:12px;color:var(--text-muted);" id="progressLabel">Soal 1 dari 5</div>
                        </div>
                    </div>
                    <div class="timer"><div class="timer-num" id="timerNum">09:47</div><div class="timer-label">Sisa Waktu</div></div>
                </div>

                <div id="questionsContainer"></div>

                <div style="display:flex;gap:10px;margin-top:8px;" id="navButtons">
                    <button class="btn btn-ghost" id="prevBtn" onclick="prevQ()" style="flex:1;" disabled>← Sebelumnya</button>
                    <button class="btn btn-primary" id="nextBtn" onclick="nextQ()" style="flex:1;">Berikutnya →</button>
                </div>
                <div style="margin-top:10px;">
                    <button class="btn btn-outline btn-full" onclick="cancelKuis()">Batalkan & Kembali</button>
                </div>

                <div class="result-card" id="resultCard">
                    <div class="result-icon" id="resultIcon">🎉</div>
                    <div class="result-score" id="resultScore">—</div>
                    <div class="result-label" id="resultLabel">—</div>
                    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                        <button class="btn btn-ghost" onclick="cancelKuis()">Kembali ke Daftar</button>
                        <a href="<?= BASEURL ?>/index.php?page=materi" class="btn btn-primary">Lanjut Belajar →</a>
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