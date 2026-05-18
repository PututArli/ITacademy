<?php
require_once 'model/koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
    header("Location: " . BASEURL . "/index.php?page=login");
    exit();
}

$nama_user = $_SESSION['nama'];

$query_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role IN ('free', 'premium')");
$res_total = mysqli_fetch_assoc($query_total);

$query_premium = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role = 'premium'");
$res_premium = mysqli_fetch_assoc($query_premium);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - ITacademy</title>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/style.css">
    <style>
        .data-table-wrap { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-top: 20px; }
        .action-btn { padding: 5px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; transition: var(--transition); }
        .action-edit { background: rgba(59,130,246,0.15); color: var(--accent-blue); }
        .action-edit:hover { background: rgba(59,130,246,0.3); }
        .action-del { background: rgba(239,68,68,0.1); color: #ef4444; }
        .action-del:hover { background: rgba(239,68,68,0.25); }

        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; display: none; align-items: center; justify-content: center; }
        .modal-overlay.show { display: flex !important; opacity: 1 !important; }
        
        .modal-box { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 20px; padding: 32px; width: 100%; max-width: 440px; margin: 20px; }
        .modal-title { font-size: 18px; font-weight: 700; margin-bottom: 20px; }

        .summary-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 24px; }
        .summary-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px 20px; }
        .summary-val { font-size: 28px; font-weight: 800; }
        .summary-label { font-size: 13px; color: var(--text-secondary); margin-top: 2px; }
    </style>
</head>
<body>
<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">IT</div>
            <span class="brand-name">IT<span>academy</span></span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Manajemen</div>
            <a href="<?= BASEURL ?>/index.php?page=admin_dashboard" class="nav-item"><span class="nav-icon">&#9776;</span> Dashboard</a>
            <a href="<?= BASEURL ?>/index.php?page=admin_pengguna" class="nav-item active"><span class="nav-icon">&#9786;</span> Pengguna</a>
            <a href="<?= BASEURL ?>/index.php?page=admin_mentor" class="nav-item"><span class="nav-icon">&#9998;</span> Mentor</a>
            <a href="<?= BASEURL ?>/index.php?page=admin_kursus" class="nav-item"><span class="nav-icon">&#9650;</span> Kursus</a>
            <div class="nav-label">Akun</div>
            <a href="<?= BASEURL ?>/index.php?page=admin_profil" class="nav-item"><span class="nav-icon">&#9651;</span> Profil Admin</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                <div>
                    <div class="user-name"><?= $nama_user; ?></div>
                    <div class="user-role">Administrator</div>
                </div>
                <a href="#" class="user-logout" title="Keluar" onclick="bukaModalLogout(event)">&#8592;</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Manajemen Pengguna</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-blue);"><?= $res_total['total']; ?></div>
                    <div class="summary-label">Total Siswa Aktif</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-gold);"><?= $res_premium['total']; ?></div>
                    <div class="summary-label">Siswa Keanggotaan Premium</div>
                </div>
            </div>

            <div class="section-header">
                <div class="section-title">Kelola Akun Siswa</div>
                <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-user')">+ Tambah Siswa Baru</button>
            </div>

            <div class="data-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tipe Akun</th>
                            <th>Progress Belajar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong style="color:var(--text-primary);">Rafael Arlianto</strong></td>
                            <td>rafael@email.com</td>
                            <td><span class="badge badge-gold">Premium</span></td>
                            <td>66%</td>
                            <td><span class="badge badge-green">Aktif</span></td>
                            <td style="display:flex;gap:6px;">
                                <button class="action-btn action-edit" onclick="editUser('Rafael Arlianto')">Edit</button>
                                <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong style="color:var(--text-primary);">Anisa Putri</strong></td>
                            <td>anisa@email.com</td>
                            <td><span class="badge badge-blue">Free</span></td>
                            <td>50%</td>
                            <td><span class="badge badge-green">Aktif</span></td>
                            <td style="display:flex;gap:6px;">
                                <button class="action-btn action-edit" onclick="editUser('Anisa Putri')">Edit</button>
                                <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-tambah-user" onclick="closeModal('modal-tambah-user')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Pengguna Baru</div>
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-input" id="new-user-name" placeholder="Nama lengkap">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-input" id="new-user-email" placeholder="email@contoh.com">
        </div>
        <div class="form-group">
            <label class="form-label">Tipe Akun</label>
            <select class="form-input" id="new-user-tipe">
                <option value="free">Free</option>
                <option value="premium">Premium</option>
            </select>
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanUser()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-user')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Pengguna</div>
        <div class="form-group">
            <label class="form-label">Nama</type><input type="text" class="form-input" id="edit-name">
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select class="form-input" id="edit-status">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non-aktif</option>
            </select>
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanEdit()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-edit')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-title" style="text-align:center;font-size:22px;margin-bottom:8px;font-weight:700;">Yakin ingin keluar?</div>
        <p style="text-align:center;font-size:14px;color:var(--text-secondary);margin-bottom:24px;line-height:1.6;">
            Sesi admin kamu akan diakhiri. Kamu harus masuk kembali untuk mengelola sistem ITacademy.
        </p>
        <div style="display:flex;gap:12px;">
            <button class="btn btn-ghost" style="flex:1;justify-content:center;" onclick="tutupModalLogout()">Batal</button>
            <a href="<?= BASEURL ?>/index.php?page=logout" class="btn btn-primary" style="flex:1;justify-content:center;background:#ef4444;text-decoration:none;display:flex;align-items:center;">Ya, Keluar</a>
        </div>
    </div>
</div>

<div id="toast" style="position:fixed;bottom:28px;right:28px;padding:12px 20px;border-radius:10px;font-size:14px;font-weight:600;z-index:2000;display:none;align-items:center;gap:8px;box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>

<script>
function openModal(id) { document.getElementById(id).classList.add('show'); }
function closeModal(id) { document.getElementById(id).classList.remove('show'); }

function showToast(msg, ok) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.background = ok ? '#10b981' : '#ef4444';
    t.style.color = 'white';
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}

function hapusUser(btn) {
    if (!confirm('Yakin ingin menghapus pengguna ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Pengguna berhasil dihapus.', false);
}

function editUser(nama) {
    document.getElementById('edit-name').value = nama;
    document.getElementById('modal-edit-title').textContent = 'Edit: ' + nama;
    openModal('modal-edit');
}

function simpanEdit() {
    closeModal('modal-edit');
    showToast('Data berhasil diperbarui.', true);
}

function bukaModalLogout(e) {
    if (e) e.preventDefault();
    document.getElementById('modalLogout').classList.add('show');
}
function tutupModalLogout() {
    document.getElementById('modalLogout').classList.remove('show');
}
</script>
</body>
</html>