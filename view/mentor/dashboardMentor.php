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
                    <div><div class="stat-value"><?= $tugas_menunggu_count; ?></div><div class="stat-label">Tugas Menunggu Review</div></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">&#9786;</div>
                    <div><div class="stat-value"><?= $total_siswa_count; ?></div><div class="stat-label">Total Siswa</div></div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">&#10003;</div>
                    <div><div class="stat-value"><?= $tugas_selesai_count; ?></div><div class="stat-label">Tugas Direview</div></div>
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

                    <?php if (!empty($tugas_masuk)) : ?>
                        <?php foreach ($tugas_masuk as $tm) : ?>
                            <div class="review-card">
                                <div class="review-top">
                                    <div>
                                        <div class="review-title"><?= htmlspecialchars($tm['judul_tugas']); ?></div>
                                        <div class="review-meta"><?= htmlspecialchars($tm['nama']); ?> &middot; File: <?= htmlspecialchars($tm['nama_file']); ?></div>
                                    </div>
                                    <span class="badge badge-gold">Menunggu</span>
                                </div>
                                <p class="review-desc">Siswa telah mengirimkan file proyek tugas untuk diperiksa struktur kodenya.</p>
                                <div class="review-actions">
                                    <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=setuju&id_tugas=<?= $tm['id_tugas']; ?>" class="btn btn-primary" style="font-size:13px; text-decoration:none; display:inline-block; text-align:center;">Setujui & Sertifikat</a>
                                    <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=tolak&id_tugas=<?= $tm['id_tugas']; ?>" class="btn btn-outline" style="font-size:13px; color:#ef4444; border-color:#ef4444; text-decoration:none; display:inline-block; text-align:center;">Tolak & Revisi</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div style="background:var(--bg-card); border:1px solid var(--border); padding:24px; border-radius:var(--radius); text-align:center; color:var(--text-secondary); font-size:14px;">
                            Hebat! Belum ada tugas baru masuk yang perlu di-review.
                        </div>
                    <?php endif; ?>

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

                    <div style="background:var(--bg-card); border:1px solid var(--border); padding:16px; border-radius:var(--radius); font-size:13px; color:var(--text-secondary);">
                        Sistem mendeteksi ada total <strong><?= $total_siswa_count; ?></strong> siswa terdaftar di dalam platform ITacademy.
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

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>