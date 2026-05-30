<?php $halaman = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; ?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">IT</div>
        <span class="brand-name">IT<span>academy</span></span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Belajar</div>
        <a href="<?= BASEURL ?>/index.php?page=dashboard"   class="nav-item <?= ($halaman == 'dashboard')   ? 'active' : '' ?>"><span class="nav-icon">&#9776;</span> Dashboard</a>
        <a href="<?= BASEURL ?>/index.php?page=materi"      class="nav-item <?= ($halaman == 'materi')      ? 'active' : '' ?>"><span class="nav-icon">&#9654;</span> Materi Belajar</a>
        <a href="<?= BASEURL ?>/index.php?page=kuis"        class="nav-item <?= ($halaman == 'kuis')        ? 'active' : '' ?>"><span class="nav-icon">&#9998;</span> Kuis Latihan</a>
        <a href="<?= BASEURL ?>/index.php?page=tugas"       class="nav-item <?= ($halaman == 'tugas')       ? 'active' : '' ?>"><span class="nav-icon">&#9650;</span> Tugas Proyek</a>
        <a href="<?= BASEURL ?>/index.php?page=sertifikat"  class="nav-item <?= ($halaman == 'sertifikat')  ? 'active' : '' ?>"><span class="nav-icon">&#9733;</span> Sertifikat</a>

        <div class="nav-label">Akun</div>
        <a href="<?= BASEURL ?>/index.php?page=profil" class="nav-item <?= ($halaman == 'profil') ? 'active' : '' ?>"><span class="nav-icon">&#9786;</span> Profil Saya</a>
        <a href="#" class="nav-item" style="color:#f87171;" onclick="bukaModalLogout(event)"><span class="nav-icon">&#8592;</span> Keluar</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            <div>
                <div class="user-name"><?= $nama_user; ?></div>
                <div class="user-role" style="font-size:12px;color:var(--text-muted);"><?= isset($status_keanggotaan) ? $status_keanggotaan : 'Siswa'; ?></div>
            </div>
        </div>
    </div>
</aside>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-icon" style="text-align:center; font-size:40px; margin-bottom:16px;">&#128075;</div>
        <div class="modal-title" style="text-align:center; font-size:22px; margin-bottom:8px; font-weight:700;">Yakin ingin keluar?</div>
        <p style="text-align:center; font-size:14px; color:var(--text-secondary); margin-bottom:24px; line-height:1.6;">Sesi belajar kamu akan disimpan. Kamu harus masuk kembali untuk melanjutkan.</p>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-ghost" style="flex:1; justify-content:center;" onclick="tutupModalLogout()">Batal</button>
            <a href="<?= BASEURL ?>/index.php?page=logout" class="btn btn-primary" style="flex:1; justify-content:center; background:#ef4444; text-decoration:none; display:flex; align-items:center;">Ya, Keluar</a>
        </div>
    </div>
</div>
<div id="toast" style="position:fixed; bottom:28px; right:28px; padding:12px 20px; border-radius:10px; font-size:14px; font-weight:600; z-index:2000; display:none; align-items:center; gap:8px; box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>