<?php
$pecah_nama = explode(" ", $nama_user);
$nama_depan = $pecah_nama[0];
$nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";
$email_admin = $data_admin['email'] ?? 'admin@itacademy.com';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">

    <?php require_once 'view/layouts/adminSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Pengaturan Akun Admin</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <a href="<?= BASEURL ?>/index.php?page=profilAdmin">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">
                
                <?php if ($pesan_sukses): ?>
                    <div style="background:#10b981;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                        ✅ <?= htmlspecialchars($pesan_sukses); ?>
                    </div>
                <?php elseif ($pesan_error): ?>
                    <div style="background:#ef4444;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                        ❌ <?= htmlspecialchars($pesan_error); ?>
                    </div>
                <?php endif; ?>

                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= htmlspecialchars($nama_user); ?></div>
                        <div class="profile-subtitle-text">Role: Sistem Utama Administrator &middot; ITacademy</div>
                    </div>
                </div>

                <form action="<?= BASEURL ?>/index.php?page=profilAdmin" method="POST">
                    <input type="hidden" name="aksi" value="update_profil_admin">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan Admin</label>
                            <input type="text" class="form-input" name="nama_depan_tmp" value="<?= htmlspecialchars($nama_depan); ?>" id="inputNamaDepan">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" name="nama_belakang_tmp" value="<?= htmlspecialchars($nama_belakang); ?>" id="inputNamaBelakang">
                        </div>
                    </div>
                    <!-- Hidden field nama gabungan -->
                    <input type="hidden" name="nama" id="inputNamaGabung" value="<?= htmlspecialchars($nama_user); ?>">

                    <div class="form-group">
                        <label>Email Utama Sistem</label>
                        <input type="email" class="form-input" value="<?= htmlspecialchars($email_admin); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Hak Akses Tingkat</label>
                        <input type="text" class="form-input" value="Super Administrator (Full Access)" readonly>
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

                    <button type="submit" class="btn-save" onclick="gabungNama()">Simpan Perubahan Akun</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
    function gabungNama() {
        const depan = document.getElementById('inputNamaDepan').value.trim();
        const belakang = document.getElementById('inputNamaBelakang').value.trim();
        document.getElementById('inputNamaGabung').value = belakang ? (depan + ' ' + belakang) : depan;
    }
</script>
<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>