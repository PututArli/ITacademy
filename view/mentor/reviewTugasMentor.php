<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Tugas - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/mentorSidebar.php'; ?>
    <div class="main-content">
        <div class="topbar">
            <h1 style="font-size: 20px; font-weight: 700; margin: 0;">Review Tugas Masuk</h1>
            <div style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600;">Mentor</div>
        </div>

        <div class="page-content">
            <div class="tugas-list">
                <?php 
                if ($ambil_tugas && mysqli_num_rows($ambil_tugas) > 0) {
                    while($row = mysqli_fetch_assoc($ambil_tugas)) { 
                        $status_class = '';
                        if ($row['status'] == 'Selesai') $status_class = 'selesai';
                        if ($row['status'] == 'Revisi') $status_class = 'revisi';
                ?>
                    <div class="tugas-card">
                        <div class="tugas-header">
                            <h3 class="tugas-title"><?= htmlspecialchars($row['judul_tugas']); ?></h3>
                            <span class="badge-status <?= $status_class; ?>"><?= htmlspecialchars($row['status']); ?></span>
                        </div>
                        
                        <div class="tugas-meta">
                            Siswa: <span><?= htmlspecialchars($row['nama_siswa']); ?></span> &bull; File: <a href="#"><?= htmlspecialchars($row['nama_file']); ?></a>
                        </div>
                        
                        <p class="tugas-desc">
                            Ini adalah tugas yang dikirim oleh siswa untuk dipelajari dan direview struktur kodenya.
                        </p>
                        
                        <div class="btn-group">
                            <button class="btn-action btn-feedback">Beri Feedback</button>

                            <?php if ($row['status'] == 'Menunggu') : ?>
                                <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=setuju&id_tugas=<?= $row['id_tugas']; ?>" class="btn-action btn-approve">Setujui & Terbitkan Sertifikat</a>
                                <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=tolak&id_tugas=<?= $row['id_tugas']; ?>" class="btn-action btn-reject">Tolak & Minta Revisi</a>
                            <?php else : ?>
                                <span style="font-size: 14px; color: gray; font-weight: 600; padding: 6px 12px;">Tugas telah di-review</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo "<div style='background: var(--bg-card); padding: 24px; border-radius: 8px; text-align: center; color: var(--text-muted);'>Belum ada data tugas yang masuk di database.</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
</body>
</html>