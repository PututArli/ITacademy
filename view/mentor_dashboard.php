<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mentor - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .review-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; margin-bottom: 12px; transition: var(--transition); }
        .review-card:hover { border-color: var(--border-accent); }
        .review-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; flex-wrap: wrap; margin-bottom: 10px; }
        .review-title { font-size: 15px; font-weight: 700; margin-bottom: 3px; }
        .review-meta { font-size: 12px; color: var(--text-muted); }
        .review-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 14px; }
        .review-actions { display: flex; gap: 8px; flex-wrap: wrap; }

        .student-row { display: flex; align-items: center; gap: 14px; padding: 14px 18px; background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 8px; transition: var(--transition); }
        .student-row:hover { border-color: var(--border-accent); }
        .student-info { flex: 1; }
        .student-name { font-size: 14px; font-weight: 600; }
        .student-detail { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

        .feedback-box { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 10px; padding: 14px; margin-top: 12px; display: none; }
        .feedback-box textarea { width: 100%; background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 8px; padding: 10px 12px; color: var(--text-primary); font-family: 'Inter', sans-serif; font-size: 13px; resize: vertical; outline: none; transition: var(--transition); }
        .feedback-box textarea:focus { border-color: var(--accent-blue); }

        .two-col { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }
        @media (max-width: 960px) { .two-col { grid-template-columns: 1fr; } }

        .stat-small { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px 20px; }
        .stat-small-val { font-size: 28px; font-weight: 800; color: var(--accent-blue); }
        .stat-small-label { font-size: 13px; color: var(--text-secondary); }
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
            <div class="nav-label">Mentor</div>
            <a href="mentor_dashboard.php" class="nav-item active"><span class="nav-icon">&#9776;</span> Dashboard</a>
            <a href="mentor_tugas.php" class="nav-item"><span class="nav-icon">&#9998;</span> Review Tugas</a>
            <a href="mentor_siswa.php" class="nav-item"><span class="nav-icon">&#9786;</span> Siswa Saya</a>
            <div class="nav-label">Akun</div>
            <a href="mentor_profil.php" class="nav-item"><span class="nav-icon">&#9650;</span> Profil</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">BS</div>
                <div>
                    <div class="user-name">Budi Santoso</div>
                    <div class="user-role">Mentor</div>
                </div>
                <a href="login.php" class="user-logout" title="Keluar">&#8592;</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Dashboard Mentor</div>
            <div class="topbar-actions">
                <span class="badge badge-blue">Mentor</span>
                <div class="user-avatar">BS</div>
            </div>
        </div>

        <div class="page-content">

            <div class="stats-grid" style="margin-bottom:24px;">
                <div class="stat-card">
                    <div class="stat-icon purple">&#9998;</div>
                    <div><div class="stat-value">3</div><div class="stat-label">Tugas Menunggu Review</div></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">&#9786;</div>
                    <div><div class="stat-value">12</div><div class="stat-label">Total Siswa</div></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">&#10003;</div>
                    <div><div class="stat-value">42</div><div class="stat-label">Tugas Direview</div></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon gold">&#9733;</div>
                    <div><div class="stat-value">4.8</div><div class="stat-label">Rating Mentor</div></div>
                </div>
            </div>

            <div class="two-col">
                <div>
                    <div class="section-header">
                        <div class="section-title">Tugas Masuk — Perlu Direview</div>
                    </div>

                    <div class="review-card" id="tugas1">
                        <div class="review-top">
                            <div>
                                <div class="review-title">Landing Page Portfolio</div>
                                <div class="review-meta">Rafael Arlianto &middot; Dikirim 10 Mei 2025, 14:32 &middot; portfolio-rafael.zip (2.4 MB)</div>
                            </div>
                            <span class="badge badge-gold">Menunggu</span>
                        </div>
                        <p class="review-desc">Siswa membuat landing page portfolio dengan HTML & CSS. Menggunakan Flexbox untuk layout dan sudah mencakup section Hero, About, dan Contact.</p>
                        <div class="review-actions">
                            <button class="btn btn-ghost" style="font-size:13px;" onclick="toggleFeedback('fb1')">Beri Feedback</button>
                            <button class="btn btn-primary" style="font-size:13px;" onclick="setujui('tugas1')">Setujui & Terbitkan Sertifikat</button>
                            <button class="btn btn-outline" style="font-size:13px;color:#ef4444;border-color:#ef4444;" onclick="tolak('tugas1')">Tolak & Minta Revisi</button>
                        </div>
                        <div class="feedback-box" id="fb1">
                            <div style="font-size:13px;font-weight:600;margin-bottom:8px;color:var(--text-secondary);">Catatan / Feedback untuk Siswa</div>
                            <textarea rows="3" id="fbtxt1" placeholder="Tuliskan feedback untuk siswa..."></textarea>
                            <div style="margin-top:8px;display:flex;gap:8px;">
                                <button class="btn btn-primary" style="font-size:12px;" onclick="kirimFeedback('tugas1','fbtxt1')">Kirim Feedback</button>
                                <button class="btn btn-ghost" style="font-size:12px;" onclick="toggleFeedback('fb1')">Batal</button>
                            </div>
                        </div>
                    </div>

                    <div class="review-card" id="tugas2">
                        <div class="review-top">
                            <div>
                                <div class="review-title">Halaman Login Responsif</div>
                                <div class="review-meta">Anisa Putri &middot; Dikirim 12 Mei 2025, 09:15 &middot; login-page.zip (1.1 MB)</div>
                            </div>
                            <span class="badge badge-gold">Menunggu</span>
                        </div>
                        <p class="review-desc">Membuat halaman login dengan form validasi JavaScript dan desain responsif menggunakan CSS Grid dan media queries.</p>
                        <div class="review-actions">
                            <button class="btn btn-ghost" style="font-size:13px;" onclick="toggleFeedback('fb2')">Beri Feedback</button>
                            <button class="btn btn-primary" style="font-size:13px;" onclick="setujui('tugas2')">Setujui & Terbitkan Sertifikat</button>
                            <button class="btn btn-outline" style="font-size:13px;color:#ef4444;border-color:#ef4444;" onclick="tolak('tugas2')">Tolak & Minta Revisi</button>
                        </div>
                        <div class="feedback-box" id="fb2">
                            <div style="font-size:13px;font-weight:600;margin-bottom:8px;color:var(--text-secondary);">Catatan / Feedback untuk Siswa</div>
                            <textarea rows="3" id="fbtxt2" placeholder="Tuliskan feedback untuk siswa..."></textarea>
                            <div style="margin-top:8px;display:flex;gap:8px;">
                                <button class="btn btn-primary" style="font-size:12px;" onclick="kirimFeedback('tugas2','fbtxt2')">Kirim Feedback</button>
                                <button class="btn btn-ghost" style="font-size:12px;" onclick="toggleFeedback('fb2')">Batal</button>
                            </div>
                        </div>
                    </div>

                    <div class="review-card" id="tugas3">
                        <div class="review-top">
                            <div>
                                <div class="review-title">Proyek Akhir: Website Toko Online</div>
                                <div class="review-meta">Doni Pratama &middot; Dikirim 13 Mei 2025, 16:00 &middot; toko-online.zip (4.8 MB)</div>
                            </div>
                            <span class="badge badge-gold">Menunggu</span>
                        </div>
                        <p class="review-desc">Proyek akhir berupa website toko online sederhana dengan fitur katalog produk, halaman detail, dan keranjang belanja menggunakan JavaScript.</p>
                        <div class="review-actions">
                            <button class="btn btn-ghost" style="font-size:13px;" onclick="toggleFeedback('fb3')">Beri Feedback</button>
                            <button class="btn btn-primary" style="font-size:13px;" onclick="setujui('tugas3')">Setujui & Terbitkan Sertifikat</button>
                            <button class="btn btn-outline" style="font-size:13px;color:#ef4444;border-color:#ef4444;" onclick="tolak('tugas3')">Tolak & Minta Revisi</button>
                        </div>
                        <div class="feedback-box" id="fb3">
                            <div style="font-size:13px;font-weight:600;margin-bottom:8px;color:var(--text-secondary);">Catatan / Feedback untuk Siswa</div>
                            <textarea rows="3" id="fbtxt3" placeholder="Tuliskan feedback untuk siswa..."></textarea>
                            <div style="margin-top:8px;display:flex;gap:8px;">
                                <button class="btn btn-primary" style="font-size:12px;" onclick="kirimFeedback('tugas3','fbtxt3')">Kirim Feedback</button>
                                <button class="btn btn-ghost" style="font-size:12px;" onclick="toggleFeedback('fb3')">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="section-header">
                        <div class="section-title">Siswa Aktif</div>
                    </div>

                    <div class="student-row">
                        <div class="user-avatar" style="width:36px;height:36px;font-size:13px;flex-shrink:0;">RF</div>
                        <div class="student-info">
                            <div class="student-name">Rafael Arlianto</div>
                            <div class="student-detail">Progress: 66% &middot; Tugas: Menunggu</div>
                        </div>
                        <span class="badge badge-gold">Review</span>
                    </div>
                    <div class="student-row">
                        <div class="user-avatar" style="width:36px;height:36px;font-size:13px;flex-shrink:0;">AP</div>
                        <div class="student-info">
                            <div class="student-name">Anisa Putri</div>
                            <div class="student-detail">Progress: 50% &middot; Tugas: Menunggu</div>
                        </div>
                        <span class="badge badge-gold">Review</span>
                    </div>
                    <div class="student-row">
                        <div class="user-avatar" style="width:36px;height:36px;font-size:13px;flex-shrink:0;">DP</div>
                        <div class="student-info">
                            <div class="student-name">Doni Pratama</div>
                            <div class="student-detail">Progress: 100% &middot; Tugas: Menunggu</div>
                        </div>
                        <span class="badge badge-gold">Review</span>
                    </div>
                    <div class="student-row">
                        <div class="user-avatar" style="width:36px;height:36px;font-size:13px;flex-shrink:0;">SN</div>
                        <div class="student-info">
                            <div class="student-name">Siti Nuraini</div>
                            <div class="student-detail">Progress: 83% &middot; Tugas: Belum kirim</div>
                        </div>
                        <span class="badge badge-blue">Aktif</span>
                    </div>
                    <div class="student-row">
                        <div class="user-avatar" style="width:36px;height:36px;font-size:13px;flex-shrink:0;">BH</div>
                        <div class="student-info">
                            <div class="student-name">Bagas Hendra</div>
                            <div class="student-detail">Progress: 33% &middot; Tugas: Belum kirim</div>
                        </div>
                        <span class="badge badge-blue">Aktif</span>
                    </div>

                    <div style="margin-top:20px;">
                        <div class="section-header">
                            <div class="section-title">Info Profil Mentor</div>
                        </div>
                        <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:18px;">
                            <div style="font-size:14px;font-weight:600;margin-bottom:4px;">Budi Santoso</div>
                            <div style="font-size:12px;color:var(--accent-blue);margin-bottom:10px;">Frontend Developer</div>
                            <div style="font-size:13px;color:var(--text-secondary);line-height:1.6;margin-bottom:12px;">5 tahun pengalaman di industri web. Spesialis HTML, CSS, dan JavaScript modern.</div>
                            <div style="display:flex;justify-content:space-between;font-size:13px;padding:6px 0;border-top:1px solid var(--border);">
                                <span style="color:var(--text-muted);">Total direview</span><span style="font-weight:600;">42 tugas</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;font-size:13px;padding:6px 0;border-top:1px solid var(--border);">
                                <span style="color:var(--text-muted);">Rata-rata waktu</span><span style="font-weight:600;">1.5 hari</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;font-size:13px;padding:6px 0;border-top:1px solid var(--border);">
                                <span style="color:var(--text-muted);">Rating</span><span style="font-weight:600;color:var(--accent-gold);">4.8 / 5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="toast" style="position:fixed;bottom:28px;right:28px;padding:12px 20px;border-radius:10px;font-size:14px;font-weight:600;z-index:1000;display:none;align-items:center;gap:8px;box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>

<script>
function toggleFeedback(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

function showToast(msg, ok) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.background = ok ? '#10b981' : '#ef4444';
    t.style.color = 'white';
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}

function setujui(id) {
    const card = document.getElementById(id);
    card.style.opacity = '0.5';
    card.style.pointerEvents = 'none';
    const badge = card.querySelector('.badge');
    badge.className = 'badge badge-green';
    badge.textContent = 'Disetujui';
    showToast('Tugas disetujui. Sertifikat akan diterbitkan.', true);
}

function tolak(id) {
    const card = document.getElementById(id);
    const badge = card.querySelector('.badge');
    badge.className = 'badge badge-red';
    badge.textContent = 'Perlu Revisi';
    showToast('Tugas ditolak. Siswa akan diminta revisi.', false);
}

function kirimFeedback(tugasId, txtId) {
    const txt = document.getElementById(txtId).value.trim();
    if (!txt) { alert('Tulis feedback terlebih dahulu.'); return; }
    showToast('Feedback berhasil dikirim ke siswa.', true);
    document.getElementById(txtId).value = '';
    const fbId = txtId.replace('fbtxt', 'fb');
    document.getElementById(fbId).style.display = 'none';
}
</script>
</body>
</html>
