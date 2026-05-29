<?php
$pecah_nama = explode(" ", $nama_user);
$nama_depan = $pecah_nama[0];
$nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";
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
                
                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= $nama_user; ?></div>
                        <div class="profile-subtitle-text">Role: Sistem Utama Administrator &middot; ITacademy</div>
                    </div>
                </div>

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Profil admin berhasil diperbarui! (Simulasi)');">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan Admin</label>
                            <input type="text" class="form-input" value="<?= $nama_depan; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" value="<?= $nama_belakang; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email Utama Sistem</label>
                        <input type="email" class="form-input" value="admin@itacademy.com" readonly>
                    </div>

                    <div class="form-group">
                        <label>Hak Akses Tingkat</label>
                        <input type="text" class="form-input" value="Super Administrator (Full Access)" readonly>
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan Akun</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>