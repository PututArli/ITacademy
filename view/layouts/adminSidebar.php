<?php $halaman = isset($_GET['page']) ? $_GET['page'] : 'dashboardAdmin'; ?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">IT</div>
        <span class="brand-name">IT<span>academy</span></span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Manajemen</div>
        <a href="<?= BASEURL ?>/index.php?page=dashboardAdmin" class="nav-item <?= ($halaman == 'dashboardAdmin') ? 'active' : '' ?>"><span class="nav-icon"><iconify-icon icon="lucide:layout-dashboard"></iconify-icon></span> Dashboard</a>
        <a href="<?= BASEURL ?>/index.php?page=penggunaAdmin" class="nav-item <?= ($halaman == 'penggunaAdmin') ? 'active' : '' ?>"><span class="nav-icon"><iconify-icon icon="lucide:users"></iconify-icon></span> Pengguna</a>
        <a href="<?= BASEURL ?>/index.php?page=mentorAdmin"   class="nav-item <?= ($halaman == 'mentorAdmin')   ? 'active' : '' ?>"><span class="nav-icon"><iconify-icon icon="lucide:user-check"></iconify-icon></span> Mentor</a>
        <a href="<?= BASEURL ?>/index.php?page=kursusAdmin"   class="nav-item <?= ($halaman == 'kursusAdmin')   ? 'active' : '' ?>"><span class="nav-icon"><iconify-icon icon="lucide:book-open"></iconify-icon></span> Kursus</a>

        <div class="nav-label">Akun</div>
        <a href="<?= BASEURL ?>/index.php?page=profilAdmin" class="nav-item <?= ($halaman == 'profilAdmin') ? 'active' : '' ?>"><span class="nav-icon"><iconify-icon icon="lucide:user"></iconify-icon></span> Profil Admin</a>
        <a href="#" class="nav-item" style="color:#f87171;" onclick="bukaModalLogout(event)"><span class="nav-icon"><iconify-icon icon="lucide:log-out"></iconify-icon></span> Keluar</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            <div>
                <div class="user-name"><?= $nama_user; ?></div>
                <div class="user-role">Administrator</div>
            </div>
            <a href="#" class="user-logout" title="Keluar" onclick="bukaModalLogout(event)"><iconify-icon icon="lucide:log-out"></iconify-icon></a>
        </div>
    </div>
</aside>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-title" style="text-align:center; font-size:22px; margin-bottom:8px; font-weight:700;">Yakin ingin keluar?</div>
        <p style="text-align:center; font-size:14px; color:var(--text-secondary); margin-bottom:24px; line-height:1.6;">Sesi admin kamu akan diakhiri. Kamu harus masuk kembali untuk mengelola sistem ITacademy.</p>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-ghost" style="flex:1; justify-content:center;" onclick="tutupModalLogout()">Batal</button>
            <a href="<?= BASEURL ?>/index.php?page=logout" class="btn btn-primary" style="flex:1; justify-content:center; background:#ef4444; text-decoration:none; display:flex; align-items:center;">Ya, Keluar</a>
        </div>
    </div>
</div>
<div id="toast" style="position:fixed; bottom:28px; right:28px; padding:12px 20px; border-radius:10px; font-size:14px; font-weight:600; z-index:2000; display:none; align-items:center; gap:8px; box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>