<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Saya - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Sertifikat Saya</div>
            <div class="topbar-actions">
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <?php if ($_SESSION['role'] === 'premium'): ?>
                <?php if ($sertifikatSiswa): ?>
                    <div class="cert-main-box" style="border-color: var(--accent-blue); background: linear-gradient(135deg, rgba(59,130,246,0.05), rgba(139,92,246,0.05));">
                    <div class="cert-badge-status">
                        <span style="font-size:16px;">🏆</span> Tersedia
                    </div>
                    <div style="font-size: 26px; font-weight: 800; margin-bottom: 8px; color: var(--text-primary);">
                        Sertifikat Kelulusan
                    </div>
                    <p style="color: var(--text-secondary); font-size: 15px; margin-bottom: 24px;">
                        No: <strong style="color:var(--text-primary);"><?php echo $sertifikatSiswa['nomor_sertifikat'] ?? '-'; ?></strong><br>
                        
                        Terbit: <?php echo isset($sertifikatSiswa['tgl_terbit']) ? date('d M Y', strtotime($sertifikatSiswa['tgl_terbit'])) : '-'; ?>
                    </p>                    
                    <div style="background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                        <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">Diberikan kepada:</p>
                        <div style="font-size: 24px; font-weight: 700; color: var(--accent-blue); margin-bottom: 8px;">
                            <?= htmlspecialchars($sertifikatSiswa['nama_siswa'] ?? $nama_user); ?>
                        </div>
                        <p style="font-size: 14px; color: var(--text-secondary);">
                            Atas keberhasilan menyelesaikan tugas proyek Full-Stack Web Development di ITacademy.
                        </p>
                    </div>              
                    <button class="btn btn-primary btn-lg" onclick="window.print()">Unduh Sertifikat PDF</button>
                </div>
                <?php else: ?>
                    <div class="cert-main-box">
                        <div style="font-size: 64px; margin-bottom: 16px;">⏳</div>
                        <div style="font-size: 22px; font-weight: 700; margin-bottom: 8px;">Sertifikat Belum Tersedia</div>
                        <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 500px; margin: 0 auto 20px auto;">
                            Sertifikat akan diterbitkan secara otomatis setelah mentor menyetujui tugas proyekmu.
                            Pastikan kamu sudah mengirim tugas terlebih dahulu.
                        </p>
                        <a href="<?= BASEURL ?>/index.php?page=tugas" class="btn btn-primary" style="display:inline-block;">Lihat Status Tugasku</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="cert-main-box locked-container">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔒</div>
                    <div style="font-size: 22px; font-weight: 700; color: #f87171; margin-bottom: 8px;">Fitur Sertifikat Terkunci</div>
                    <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 520px; margin: 0 auto;">
                        Halo <strong><?= htmlspecialchars($nama_user); ?></strong>, fitur klaim sertifikat digital resmi ITacademy hanya terbuka untuk anggota <strong>Premium</strong>.
                    </p>
                    <a href="<?= BASEURL ?>/index.php?page=profil" class="btn-upgrade">Upgrade ke Premium Sekarang</a>
                </div>
            <?php endif; ?>
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