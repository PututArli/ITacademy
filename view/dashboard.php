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
            <a href="dashboard.php" class="nav-item active"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="materi.php" class="nav-item"><span class="nav-icon">📖</span> Materi</a>
            <a href="kuis.php" class="nav-item"><span class="nav-icon">✔</span> Kuis</a>
            <a href="tugas.php" class="nav-item"><span class="nav-icon">📤</span> Tugas Proyek</a>
            <a href="sertifikat.php" class="nav-item"><span class="nav-icon">🏅</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="profil.php" class="nav-item"><span class="nav-icon">👤</span> Profil</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">RF</div>
                <div>
                    <div class="user-name">Rafael</div>
                    <div class="user-role">Premium</div>
                </div>
                <a href="login.php" class="user-logout" title="Keluar">←</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Dashboard</div>
            <div class="topbar-actions">
                <span class="badge badge-gold">Premium</span>
                <a href="profil.php"><div class="user-avatar" style="cursor:pointer;">RF</div></a>
            </div>
        </div>

        <div class="page-content">

            <div class="welcome-bar">
                <div>
                    <div class="welcome-text">Selamat datang, Rafael 👋</div>
                    <div class="welcome-sub">Lanjutkan belajar Web Development — kamu sudah 66% selesai.</div>
                </div>
                <a href="materi.php" class="btn btn-primary">Lanjut Belajar →</a>
            </div>

            <div class="stats-grid">
                <a href="materi.php" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon blue">📖</div>
                    <div><div class="stat-value">8/12</div><div class="stat-label">Modul Selesai</div></div>
                </a>
                <a href="kuis.php" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon purple">✔</div>
                    <div><div class="stat-value">2/3</div><div class="stat-label">Kuis Lulus</div></div>
                </a>
                <a href="tugas.php" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon gold">📤</div>
                    <div><div class="stat-value">1</div><div class="stat-label">Tugas Dikirim</div></div>
                </a>
                <a href="sertifikat.php" class="stat-card" style="text-decoration:none;">
                    <div class="stat-icon green">🏅</div>
                    <div><div class="stat-value">0</div><div class="stat-label">Sertifikat</div></div>
                </a>
            </div>

            <div class="two-col">

                <div>
                    <div class="section-header">
                        <div class="section-title">Modul Pembelajaran</div>
                        <a href="materi.php" class="btn btn-ghost" style="font-size:13px;padding:6px 12px;">Lihat Semua</a>
                    </div>
                    <div class="module-list">
                        <div class="module-row">
                            <div class="module-num done">&check;</div>
                            <div class="module-info">
                                <div class="module-name">Pengenalan HTML</div>
                                <div class="module-detail">4 video &middot; Kuis selesai (92/100)</div>
                            </div>
                            <span class="badge badge-green">Selesai</span>
                        </div>
                        <div class="module-row">
                            <div class="module-num done">&check;</div>
                            <div class="module-info">
                                <div class="module-name">CSS Dasar & Styling</div>
                                <div class="module-detail">3 video &middot; Kuis selesai (88/100)</div>
                            </div>
                            <span class="badge badge-green">Selesai</span>
                        </div>
                        <div class="module-row">
                            <div class="module-num done">&check;</div>
                            <div class="module-info">
                                <div class="module-name">Flexbox & Grid Layout</div>
                                <div class="module-detail">3 video &middot; Kuis selesai (80/100)</div>
                            </div>
                            <span class="badge badge-green">Selesai</span>
                        </div>
                        <div class="module-row">
                            <div class="module-num current">4</div>
                            <div class="module-info">
                                <div class="module-name">JavaScript Dasar</div>
                                <div class="module-detail">2/4 video ditonton &middot; Kuis belum</div>
                            </div>
                            <span class="badge badge-blue">Sedang</span>
                        </div>
                        <div class="module-row" style="opacity:0.5;">
                            <div class="module-num">5</div>
                            <div class="module-info">
                                <div class="module-name">DOM & Event Handling</div>
                                <div class="module-detail">Belum dibuka</div>
                            </div>
                            <span class="badge" style="color:var(--text-muted);">Terkunci</span>
                        </div>
                    </div>

                    <div class="task-section">
                        <div class="section-header">
                            <div class="section-title">Tugas Proyek</div>
                            <a href="tugas.php" class="btn btn-ghost" style="font-size:13px;padding:6px 12px;">Kirim Tugas</a>
                        </div>
                        <div class="task-card">
                            <div class="task-status">
                                <span class="badge badge-gold">Sedang Direview</span>
                                <span style="font-size:12px;color:var(--text-muted);">Dikirim 10 Mei 2025</span>
                            </div>
                            <div style="font-size:15px;font-weight:600;margin-bottom:8px;">Landing Page Portfolio</div>
                            <div class="task-file">
                                <span class="task-file-icon"></span>
                                <span>portfolio-rafael.zip (2.4 MB)</span>
                            </div>
                            <div class="task-feedback">
                                <div class="task-feedback-label">Catatan dari Mentor Budi Santoso</div>
                                File diterima. Akan saya review dalam 1-2 hari. Pastikan file sudah include semua asset gambar ya.
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="section-header">
                        <div class="section-title">Sertifikat</div>
                    </div>
                    <div class="cert-box locked">
                        <div class="cert-icon"></div>
                        <div class="cert-title">Belum tersedia</div>
                        <p class="cert-desc">Sertifikat akan diterbitkan setelah mentor menyetujui tugas proyek akhir kamu.</p>
                    </div>

                    <div style="margin-top:20px;">
                        <div class="section-header">
                            <div class="section-title">Progress</div>
                        </div>
                        <div class="progress-ring">
                            <div class="ring-num">66%</div>
                            <div>
                                <div class="ring-title">Materi</div>
                                <div class="ring-label">8 dari 12 modul selesai</div>
                            </div>
                        </div>
                        <div class="progress-ring">
                            <div class="ring-num" style="color:var(--accent-purple);">71%</div>
                            <div>
                                <div class="ring-title">Kuis</div>
                                <div class="ring-label">5 dari 7 kuis lulus</div>
                            </div>
                        </div>
                        <div class="progress-ring">
                            <div class="ring-num" style="color:var(--accent-gold);">1/1</div>
                            <div>
                                <div class="ring-title">Tugas Proyek</div>
                                <div class="ring-label">Menunggu review mentor</div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:20px;">
                        <div class="section-header">
                            <div class="section-title">Mentor</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;padding:14px;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;">
                            <div class="user-avatar" style="width:40px;height:40px;font-size:14px;">BS</div>
                            <div>
                                <div style="font-size:14px;font-weight:600;">Budi Santoso</div>
                                <div style="font-size:12px;color:var(--text-muted);">Frontend Developer</div>
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
