<?php
session_start();
require_once '../model/koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$nama_user = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-tabs { display: flex; gap: 2px; background: var(--bg-secondary); border-radius: 10px; padding: 4px; width: fit-content; margin-bottom: 24px; }
        .admin-tab { padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; color: var(--text-secondary); transition: var(--transition); border: none; background: transparent; }
        .admin-tab.active { background: var(--bg-card); color: var(--text-primary); }

        .data-table-wrap { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }

        .action-btn { padding: 5px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; transition: var(--transition); }
        .action-edit { background: rgba(59,130,246,0.15); color: var(--accent-blue); }
        .action-edit:hover { background: rgba(59,130,246,0.3); }
        .action-del { background: rgba(239,68,68,0.1); color: #ef4444; }
        .action-del:hover { background: rgba(239,68,68,0.25); }

        /* Diubah agar display: none tidak mengunci class modal secara kaku */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; display: none; align-items: center; justify-content: center; }
        .modal-overlay.show { display: flex !important; opacity: 1 !important; }
        
        .modal-box { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 20px; padding: 32px; width: 100%; max-width: 440px; margin: 20px; }
        .modal-title { font-size: 18px; font-weight: 700; margin-bottom: 20px; }

        .summary-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; margin-bottom: 24px; }
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
            <a href="admin_dashboard.php" class="nav-item active"><span class="nav-icon">&#9776;</span> Dashboard</a>
            <a href="admin_pengguna.php" class="nav-item"><span class="nav-icon">&#9786;</span> Pengguna</a>
            <a href="admin_mentor.php" class="nav-item"><span class="nav-icon">&#9998;</span> Mentor</a>
            <a href="admin_kursus.php" class="nav-item"><span class="nav-icon">&#9650;</span> Kursus</a>
            <div class="nav-label">Akun</div>
            <a href="admin_profil.php" class="nav-item"><span class="nav-icon">&#9651;</span> Profil Admin</a>
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
            <div class="topbar-title">Dashboard Admin</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-blue);">156</div>
                    <div class="summary-label">Total Pengguna</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-purple);">4</div>
                    <div class="summary-label">Total Mentor</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-gold);">89</div>
                    <div class="summary-label">User Premium</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:#10b981;">34</div>
                    <div class="summary-label">Sertifikat Diterbitkan</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-blue);">12</div>
                    <div class="summary-label">Tugas Menunggu</div>
                </div>
            </div>

            <div class="admin-tabs">
                <button class="admin-tab active" onclick="switchTab(this,'tab-pengguna')">Pengguna</button>
                <button class="admin-tab" onclick="switchTab(this,'tab-mentor')">Mentor</button>
                <button class="admin-tab" onclick="switchTab(this,'tab-tugas')">Tugas Masuk</button>
            </div>

            <div id="tab-pengguna">
                <div class="section-header" style="margin-bottom:14px;">
                    <div class="section-title">Daftar Pengguna</div>
                    <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-user')">+ Tambah Pengguna</button>
                </div>
                <div class="data-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tipe</th>
                                <th>Progress</th>
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
                            <tr>
                                <td><strong style="color:var(--text-primary);">Doni Pratama</strong></td>
                                <td>doni@email.com</td>
                                <td><span class="badge badge-gold">Premium</span></td>
                                <td>100%</td>
                                <td><span class="badge badge-green">Aktif</span></td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('Doni Pratama')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Siti Nuraini</strong></td>
                                <td>siti@email.com</td>
                                <td><span class="badge badge-blue">Free</span></td>
                                <td>25%</td>
                                <td><span class="badge badge-red">Non-aktif</span></td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('Siti Nuraini')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Bagas Hendra</strong></td>
                                <td>bagas@email.com</td>
                                <td><span class="badge badge-gold">Premium</span></td>
                                <td>33%</td>
                                <td><span class="badge badge-green">Aktif</span></td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('Bagas Hendra')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-mentor" style="display:none;">
                <div class="section-header" style="margin-bottom:14px;">
                    <div class="section-title">Daftar Mentor</div>
                    <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-mentor')">+ Tambah Mentor</button>
                </div>
                <div class="data-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Spesialisasi</th>
                                <th>Siswa</th>
                                <th>Tugas Direview</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Budi Santoso</strong></td>
                                <td>Frontend Developer</td>
                                <td>12</td>
                                <td>42</td>
                                <td style="color:var(--accent-gold);font-weight:600;">4.8 / 5.0</td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('Budi Santoso')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Anita Wijaya</strong></td>
                                <td>UI/UX Designer</td>
                                <td>8</td>
                                <td>27</td>
                                <td style="color:var(--accent-gold);font-weight:600;">4.9 / 5.0</td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('Anita Wijaya')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Rudi Hermawan</strong></td>
                                <td>Backend Developer</td>
                                <td>5</td>
                                <td>15</td>
                                <td style="color:var(--accent-gold);font-weight:600;">4.7 / 5.0</td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('Rudi Hermawan')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-tugas" style="display:none;">
                <div class="section-header" style="margin-bottom:14px;">
                    <div class="section-title">Semua Tugas Masuk</div>
                </div>
                <div class="data-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Judul Tugas</th>
                                <th>Mentor</th>
                                <th>Tanggal Kirim</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Rafael Arlianto</strong></td>
                                <td>Landing Page Portfolio</td>
                                <td>Budi Santoso</td>
                                <td>10 Mei 2026</td>
                                <td><span class="badge badge-gold">Menunggu</span></td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Anisa Putri</strong></td>
                                <td>Halaman Login Responsif</td>
                                <td>Budi Santoso</td>
                                <td>12 Mei 2026</td>
                                <td><span class="badge badge-gold">Menunggu</span></td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Doni Pratama</strong></td>
                                <td>Proyek Akhir: Toko Online</td>
                                <td>Budi Santoso</td>
                                <td>13 Mei 2026</td>
                                <td><span class="badge badge-gold">Menunggu</span></td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Lisa Maharani</strong></td>
                                <td>Halaman Profil Pengguna</td>
                                <td>Anita Wijaya</td>
                                <td>8 Mei 2026</td>
                                <td><span class="badge badge-green">Disetujui</span></td>
                            </tr>
                            <tr>
                                <td><strong style="color:var(--text-primary);">Hendra Gunawan</strong></td>
                                <td>Website Company Profile</td>
                                <td>Anita Wijaya</td>
                                <td>5 Mei 2026</td>
                                <td><span class="badge badge-red">Perlu Revisi</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

<div class="modal-overlay" id="modal-tambah-mentor" onclick="closeModal('modal-tambah-mentor')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Mentor Baru</div>
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-input" id="new-mentor-name" placeholder="Nama lengkap">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-input" id="new-mentor-email" placeholder="email@contoh.com">
        </div>
        <div class="form-group">
            <label class="form-label">Spesialisasi</label>
            <input type="text" class="form-input" id="new-mentor-spec" placeholder="cth: Frontend Developer">
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanMentor()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-mentor')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Pengguna</div>
        <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" class="form-input" id="edit-name">
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
            <a href="logout.php" class="btn btn-primary" style="flex:1;justify-content:center;background:#ef4444;text-decoration:none;display:flex;align-items:center;">Ya, Keluar</a>
        </div>
    </div>
</div>

<div id="toast" style="position:fixed;bottom:28px;right:28px;padding:12px 20px;border-radius:10px;font-size:14px;font-weight:600;z-index:2000;display:none;align-items:center;gap:8px;box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>

<script>
function switchTab(btn, id) {
    document.querySelectorAll('.admin-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    ['tab-pengguna','tab-mentor','tab-tugas'].forEach(t => {
        document.getElementById(t).style.display = t === id ? 'block' : 'none';
    });
}

// Menggunakan penambahan/penghapusan class .show agar serasi dengan style.css kustom kita
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

function simpanUser() {
    const nama = document.getElementById('new-user-name').value.trim();
    if (!nama) { alert('Isi nama terlebih dahulu.'); return; }
    closeModal('modal-tambah-user');
    showToast('Pengguna baru berhasil ditambahkan.', true);
}

function simpanMentor() {
    const nama = document.getElementById('new-mentor-name').value.trim();
    if (!nama) { alert('Isi nama terlebih dahulu.'); return; }
    closeModal('modal-tambah-mentor');
    showToast('Mentor baru berhasil ditambahkan.', true);
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