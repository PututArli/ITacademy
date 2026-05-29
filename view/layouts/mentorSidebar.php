<?php $halaman = isset($_GET['page']) ? $_GET['page'] : 'dashboardMentor'; ?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">IT</div>
        <span class="brand-name">IT<span>academy</span></span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Mentor</div>
        <a href="<?= BASEURL ?>/index.php?page=dashboardMentor" class="nav-item <?= ($halaman == 'dashboardMentor') ? 'active' : '' ?>"><span class="nav-icon">&#9776;</span> Dashboard</a>
        <a href="<?= BASEURL ?>/index.php?page=reviewTugasMentor" class="nav-item <?= ($halaman == 'reviewTugasMentor') ? 'active' : '' ?>"><span class="nav-icon">&#9998;</span> Review Tugas</a>
        <a href="<?= BASEURL ?>/index.php?page=siswaMentor" class="nav-item <?= ($halaman == 'siswaMentor') ? 'active' : '' ?>"><span class="nav-icon">&#9786;</span> Siswa Saya</a>
        <a href="<?= BASEURL ?>/index.php?page=tambahMateri" class="nav-item <?= ($halaman == 'tambahMateri') ? 'active' : '' ?>"><span class="nav-icon">&#9786;</span> Tambah Materi</a>
        
        <div class="nav-label">Akun</div>
        <a href="<?= BASEURL ?>/index.php?page=profilMentor" class="nav-item <?= ($halaman == 'profilMentor') ? 'active' : '' ?>"><span class="nav-icon">&#9650;</span> Profil</a>
        
        <a href="#" class="nav-item" style="color: #f87171;" onclick="bukaModalLogout(event)"><span class="nav-icon">🚪</span> Keluar</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <?= isset($nama_user) && !empty($nama_user) ? strtoupper(substr($nama_user, 0, 2)) : 'BU'; ?>
            </div>
            <div>
                <div class="user-name"><?= isset($nama_user) ? htmlspecialchars($nama_user) : 'Budi Santoso'; ?></div>
                <div class="user-role">Mentor</div>
            </div>
            <a href="#" class="user-logout" title="Keluar" onclick="bukaModalLogout(event)">&#8592;</a>
        </div>
    </div>
</aside>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-title" style="text-align:center; font-size:22px; margin-bottom:8px; font-weight:700;">Yakin ingin keluar?</div>
        <p style="text-align:center; font-size:14px; color:var(--text-secondary); margin-bottom:24px; line-height:1.6;">Sesi ngajar kamu akan diakhiri. Kamu harus masuk kembali untuk mereview tugas siswa.</p>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-ghost" style="flex:1; justify-content:center;" onclick="tutupModalLogout()">Batal</button>
            <a href="<?= BASEURL ?>/index.php?page=logout" class="btn btn-primary" style="flex:1; justify-content:center; background:#ef4444; text-decoration:none;">Ya, Keluar</a>
        </div>
    </div>
</div>
<div id="toast" style="position:fixed; bottom:28px; right:28px; padding:12px 20px; border-radius:10px; font-size:14px; font-weight:600; z-index:2000; display:none; align-items:center; gap:8px; box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>