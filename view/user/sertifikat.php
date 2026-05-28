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
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <?php if ($_SESSION['role'] === 'premium'): ?>
                <div class="cert-main-box">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔒</div>
                    <div style="font-size: 22px; font-weight: 700; margin-bottom: 8px;">Sertifikat Belum Tersedia</div>
                    <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 500px; margin: 0 auto;">
                        Sertifikat akan diterbitkan secara otomatis setelah mentor menyetujui tugas proyekmu.
                    </p>
                </div>
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
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
</body>
</html>