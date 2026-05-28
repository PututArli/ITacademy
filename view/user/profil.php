<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Pengaturan Akun</div>
            <div class="topbar-actions">
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= htmlspecialchars($nama_user); ?></div>
                        <div class="profile-subtitle-text"><?= $status_keanggotaan; ?> &middot; Anggota sejak Mei 2026</div>
                    </div>
                </div>

                <form action="#" method="POST" onsubmit="event.preventDefault();">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan</label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($nama_depan); ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($nama_belakang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tipe Keanggotaan</label>
                        <input type="text" class="form-input" value="<?= $status_keanggotaan; ?>" readonly>
                    </div>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
</body>
</html>