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
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">

                <?php if (!empty($pesan_sukses)): ?>
                    <div style="background:#10b981;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                        ✅ <?= htmlspecialchars($pesan_sukses); ?>
                    </div>
                <?php elseif (!empty($pesan_error)): ?>
                    <div style="background:#ef4444;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                        ❌ <?= htmlspecialchars($pesan_error); ?>
                    </div>
                <?php endif; ?>

                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= htmlspecialchars($nama_user); ?></div>
                        <div class="profile-subtitle-text"><?= $status_keanggotaan; ?> &middot; Anggota sejak <?= isset($data_user['created_at']) ? date('M Y', strtotime($data_user['created_at'])) : 'Mei 2026'; ?></div>
                    </div>
                </div>

                <form action="<?= BASEURL ?>/index.php?page=profil" method="POST">
                    <input type="hidden" name="aksi" value="update_profil">
                    <!-- Hidden field nama gabungan -->
                    <input type="hidden" name="nama" id="inputNamaGabung" value="<?= htmlspecialchars($nama_user); ?>">

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan</label>
                            <input type="text" class="form-input" id="inputNamaDepan" value="<?= htmlspecialchars($nama_depan); ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" id="inputNamaBelakang" value="<?= htmlspecialchars($nama_belakang); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-input" value="<?= htmlspecialchars($data_user['email'] ?? ''); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tipe Keanggotaan</label>
                        <input type="text" class="form-input" value="<?= $status_keanggotaan; ?>" readonly>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Password Baru <span style="color:var(--text-muted);font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                            <input type="password" class="form-input" name="password_baru" placeholder="Password baru">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-input" name="konfirmasi" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <button type="submit" class="btn-save" onclick="gabungNama()">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
    function gabungNama() {
        const depan   = document.getElementById('inputNamaDepan').value.trim();
        const belakang = document.getElementById('inputNamaBelakang').value.trim();
        document.getElementById('inputNamaGabung').value = belakang ? (depan + ' ' + belakang) : depan;
    }
</script>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>