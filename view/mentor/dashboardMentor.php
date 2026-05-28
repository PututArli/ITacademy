<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mentor - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/mentorSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Dashboard Mentor</div>
            <div class="topbar-actions">
                <span class="badge badge-blue">Mentor</span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
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
                                <div class="review-meta">Rafael Arlianto &middot; Dikirim 10 Mei 2026, 14:32 &middot; portfolio-rafael.zip (2.4 MB)</div>
                            </div>
                            <span class="badge badge-gold">Menunggu</span>
                        </div>
                        <p class="review-desc">Siswa membuat landing page portfolio dengan HTML & CSS.</p>
                        <div class="review-actions">
                            <button class="btn btn-ghost" style="font-size:13px;" onclick="toggleFeedback('fb1')">Beri Feedback</button>
                            <button class="btn btn-primary" style="font-size:13px;" onclick="setujui('tugas1')">Setujui</button>
                            <button class="btn btn-outline" style="font-size:13px;color:#ef4444;border-color:#ef4444;" onclick="tolak('tugas1')">Tolak</button>
                        </div>
                        <div class="feedback-box" id="fb1">
                            <div style="font-size:13px;font-weight:600;margin-bottom:8px;color:var(--text-secondary);">Catatan untuk Siswa</div>
                            <textarea rows="3" id="fbtxt1" placeholder="Tuliskan feedback..."></textarea>
                            <div style="margin-top:8px;display:flex;gap:8px;">
                                <button class="btn btn-primary" style="font-size:12px;" onclick="kirimFeedback('tugas1','fbtxt1')">Kirim</button>
                                <button class="btn btn-ghost" style="font-size:12px;" onclick="toggleFeedback('fb1')">Batal</button>
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
                            <div class="student-name">Rizka Aprilia</div>
                            <div class="student-detail">Progress: 50% &middot; Tugas: Menunggu</div>
                        </div>
                        <span class="badge badge-gold">Review</span>
                    </div>

                    <div style="margin-top:20px;">
                        <div class="section-header">
                            <div class="section-title">Info Profil Mentor</div>
                        </div>
                        <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:18px;">
                            <div style="font-size:14px;font-weight:600;margin-bottom:4px;"><?= htmlspecialchars($nama_user); ?></div>
                            <div style="font-size:12px;color:var(--accent-blue);margin-bottom:10px;">Frontend Developer</div>
                            <div style="font-size:13px;color:var(--text-secondary);line-height:1.6;margin-bottom:12px;">5 tahun pengalaman di industri web.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
</body>
</html>