<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .cert-locked-page { max-width: 560px; margin: 0 auto; text-align: center; padding: 60px 20px; }
        .cert-big-icon { font-size: 72px; margin-bottom: 20px; }
        .cert-locked-title { font-size: 22px; font-weight: 700; margin-bottom: 10px; }
        .cert-locked-desc { font-size: 15px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 28px; }

        .cert-progress-list { list-style: none; text-align: left; display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px; }
        .cert-progress-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; font-size: 14px; }
        .cert-progress-item .icon-ok { color: #10b981; font-size: 16px; }
        .cert-progress-item .icon-wait { color: var(--accent-gold); font-size: 16px; }
        .cert-progress-item .icon-no { color: var(--text-muted); font-size: 16px; }

        .cert-card { background: linear-gradient(135deg, #0f1629, #131d35); border: 1px solid rgba(245,158,11,0.3); border-radius: 20px; padding: 48px 40px; text-align: center; position: relative; overflow: hidden; max-width: 640px; margin: 0 auto; }
        .cert-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--accent-gold), var(--accent-blue), var(--accent-purple)); }
        .cert-card-logo { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 28px; }
        .cert-card-title { font-size: 12px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px; }
        .cert-card-name { font-size: 36px; font-weight: 800; background: linear-gradient(135deg, var(--accent-gold), #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px; }
        .cert-card-desc { font-size: 15px; color: var(--text-secondary); margin-bottom: 28px; line-height: 1.7; }
        .cert-card-course { font-size: 20px; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
        .cert-card-date { font-size: 13px; color: var(--text-muted); margin-bottom: 28px; }
        .cert-card-sigs { display: flex; justify-content: space-around; border-top: 1px solid var(--border); padding-top: 24px; flex-wrap: wrap; gap: 20px; }
        .cert-sig { text-align: center; }
        .cert-sig-name { font-size: 14px; font-weight: 700; }
        .cert-sig-role { font-size: 12px; color: var(--text-muted); }
        .cert-sig-line { width: 120px; height: 1px; background: var(--border); margin: 8px auto; }
        .cert-id { font-size: 11px; color: var(--text-muted); margin-top: 20px; letter-spacing: 1px; }
        .cert-seal { position: absolute; bottom: 20px; right: 24px; font-size: 36px; opacity: 0.15; }
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
            <a href="materi.php" class="nav-item"><span class="nav-icon">📖</span> Materi</a>
            <a href="kuis.php" class="nav-item"><span class="nav-icon">✔</span> Kuis</a>
            <a href="tugas.php" class="nav-item"><span class="nav-icon">📤</span> Tugas Proyek</a>
            <a href="sertifikat.php" class="nav-item active"><span class="nav-icon">🏅</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="profil.php" class="nav-item"><span class="nav-icon">👤</span> Profil</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">RF</div>
                <div><div class="user-name">Rafael</div><div class="user-role">Premium</div></div>
                <a href="../" class="user-logout" title="Keluar">←</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Sertifikat Saya</div>
            <div class="topbar-actions">
                <span class="badge badge-gold">Premium</span>
                <div class="user-avatar">RF</div>
            </div>
        </div>

        <div class="page-content">

            <div id="lockedView">
                <div class="cert-locked-page">
                    <div class="cert-big-icon">🔒</div>
                    <div class="cert-locked-title">Sertifikat Belum Tersedia</div>
                    <p class="cert-locked-desc">Sertifikat akan diterbitkan secara otomatis setelah mentor menyetujui tugas proyekmu. Pantau status pengirimanmu di bawah ini.</p>

                    <ul class="cert-progress-list">
                        <li class="cert-progress-item">
                            <span class="icon-ok">✓</span>
                            <div style="flex:1;"><strong>Materi diselesaikan</strong><br><span style="font-size:12px;color:var(--text-muted);">8 dari 12 modul</span></div>
                            <span class="badge badge-green">Selesai</span>
                        </li>
                        <li class="cert-progress-item">
                            <span class="icon-ok">✓</span>
                            <div style="flex:1;"><strong>Kuis dilulus</strong><br><span style="font-size:12px;color:var(--text-muted);">2 dari 3 kuis tersedia</span></div>
                            <span class="badge badge-green">Selesai</span>
                        </li>
                        <li class="cert-progress-item">
                            <span class="icon-ok">✓</span>
                            <div style="flex:1;"><strong>Tugas proyek dikirim</strong><br><span style="font-size:12px;color:var(--text-muted);">portfolio-rafael.zip</span></div>
                            <span class="badge badge-green">Terkirim</span>
                        </li>
                        <li class="cert-progress-item">
                            <span class="icon-wait">⏳</span>
                            <div style="flex:1;"><strong>Menunggu approval mentor</strong><br><span style="font-size:12px;color:var(--text-muted);">Budi Santoso sedang mereview</span></div>
                            <span class="badge badge-gold">Menunggu</span>
                        </li>
                    </ul>

                    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                        <a href="tugas.php" class="btn btn-outline">Lihat Status Tugas</a>
                        <button class="btn btn-primary" onclick="showPreview()">Lihat Preview Sertifikat</button>
                    </div>
                </div>
            </div>

            <div id="previewView" style="display:none;padding:28px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
                    <button class="btn btn-ghost" onclick="hidePreview()">← Kembali</button>
                    <div style="font-size:16px;font-weight:700;">Preview Sertifikat</div>
                    <span class="badge badge-gold" style="margin-left:auto;">Preview — Belum Resmi</span>
                </div>

                <div style="background:rgba(245,158,11,0.06);border:1px solid rgba(245,158,11,0.2);border-radius:10px;padding:12px 16px;margin-bottom:24px;font-size:13px;color:var(--text-secondary);">
                    ⚠ Ini adalah <strong style="color:var(--text-primary);">preview saja</strong>. Sertifikat resmi hanya akan diterbitkan setelah mentor menyetujui tugas proyekmu.
                </div>

                <div class="cert-card">
                    <div class="cert-seal">🏅</div>
                    <div class="cert-card-logo">
                        <div class="brand-icon" style="width:32px;height:32px;font-size:14px;">IT</div>
                        <span class="brand-name" style="font-size:16px;">IT<span>academy</span></span>
                    </div>
                    <div class="cert-card-title">Sertifikat Kelulusan</div>
                    <div style="font-size:14px;color:var(--text-secondary);margin-bottom:12px;">Diberikan kepada</div>
                    <div class="cert-card-name">Rafael Arlianto</div>
                    <p class="cert-card-desc">telah menyelesaikan seluruh materi, lulus kuis, dan tugas proyek akhir pada kursus</p>
                    <div class="cert-card-course">Web Development Dasar</div>
                    <div class="cert-card-date">Menunggu tanggal persetujuan</div>
                    <div class="cert-card-sigs">
                        <div class="cert-sig">
                            <div class="cert-sig-line"></div>
                            <div class="cert-sig-name">Budi Santoso</div>
                            <div class="cert-sig-role">Mentor · Frontend Developer</div>
                        </div>
                        <div class="cert-sig">
                            <div class="cert-sig-line"></div>
                            <div class="cert-sig-name">ITacademy</div>
                            <div class="cert-sig-role">Platform E-Learning</div>
                        </div>
                    </div>
                    <div class="cert-id">ID: ITA-2025-XXXXXXXX</div>
                </div>

                <div style="text-align:center;margin-top:20px;">
                    <button class="btn btn-ghost" style="opacity:0.5;cursor:not-allowed;" disabled>⬇ Download PDF (Tersedia setelah Approve)</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
function showPreview() {
    document.getElementById('lockedView').style.display = 'none';
    document.getElementById('previewView').style.display = 'block';
}
function hidePreview() {
    document.getElementById('previewView').style.display = 'none';
    document.getElementById('lockedView').style.display = 'block';
}
</script>
</body>
</html>
