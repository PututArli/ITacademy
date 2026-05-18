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
    <title>Manajemen Kursus - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .data-table-wrap { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-top: 20px; }
        .action-btn { padding: 5px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; transition: var(--transition); }
        .action-edit { background: rgba(59,130,246,0.15); color: var(--accent-blue); }
        .action-edit:hover { background: rgba(59,130,246,0.3); }
        .action-del { background: rgba(239,68,68,0.1); color: #ef4444; }
        .action-del:hover { background: rgba(239,68,68,0.25); }

        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 1000; display: none; align-items: center; justify-content: center; }
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
            <a href="admin_dashboard.php" class="nav-item"><span class="nav-icon">&#9776;</span> Dashboard</a>
            <a href="admin_pengguna.php" class="nav-item"><span class="nav-icon">&#9786;</span> Pengguna</a>
            <a href="admin_mentor.php" class="nav-item"><span class="nav-icon">&#9998;</span> Mentor</a>
            <a href="admin_kursus.php" class="nav-item active"><span class="nav-icon">&#9650;</span> Kursus</a>
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
            <div class="topbar-title">Manajemen Kursus</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <div class="summary-grid">
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-val" style="color:var(--accent-blue);">1</div>
                        <div class="summary-label">Kursus Aktif</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-val" style="color:var(--accent-purple);">12</div>
                        <div class="summary-label">Total Modul Materi</div>
                    </div>
                </div>
            </div>

            <div class="section-header">
                <div class="section-title">Daftar Kursus ITacademy</div>
                <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-kursus')">+ Tambah Kursus Baru</button>
            </div>

            <div class="data-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Kursus</th>
                            <th>Kategori</th>
                            <th>Jumlah Modul</th>
                            <th>Tingkat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong style="color:var(--text-primary);">Full-Stack Web Development</strong></td>
                            <td>Programming</td>
                            <td>12 Modul</td>
                            <td>Pemula - Mahir</td>
                            <td><span class="badge badge-green">Aktif</span></td>
                            <td style="display:flex; gap:6px;">
                                <button class="action-btn action-edit" onclick="editKursus('Full-Stack Web Development')">Edit</button>
                                <button class="action-btn action-del" onclick="hapusKursus(this)">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-tambah-kursus" onclick="closeModal('modal-tambah-kursus')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Kursus Baru</div>
        <div class="form-group">
            <label class="form-label">Nama Kursus</label>
            <input type="text" class="form-input" id="new-course-name" placeholder="Nama kursus baru">
        </div>
        <div class="form-group">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-input" id="new-course-cat" placeholder="cth: Programming, Design">
        </div>
        <div style="display:flex; gap:10px; margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanKursus()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-kursus')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Kursus</div>
        <div class="form-group">
            <label class="form-label">Nama Kursus</label>
            <input type="text" class="form-input" id="edit-name">
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select class="form-input" id="edit-status">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non-aktif</option>
            </select>
        </div>
        <div style="display:flex; gap:10px; margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanEdit()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-edit')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalLogout" onclick="tutupModalLogout()">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" style="text-align:center; font-size:22px; margin-bottom:8px;">Yakin ingin keluar?</div>
        <p style="text-align:center; font-size:14px; color:var(--text-secondary); margin-bottom:24px; line-height:1.6;">
            Sesi admin kamu akan diakhiri. Kamu harus masuk kembali untuk mengelola sistem.
        </p>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-ghost" style="flex:1; justify-content:center;" onclick="tutupModalLogout()">Batal</button>
            <a href="logout.php" class="btn btn-primary" style="flex:1; justify-content:center; background:#ef4444; text-decoration:none; display:flex; align-items:center;">Ya, Keluar</a>
        </div>
    </div>
</div>

<div id="toast" style="position:fixed; bottom:28px; right:28px; padding:12px 20px; border-radius:10px; font-size:14px; font-weight:600; z-index:2000; display:none; align-items:center; gap:8px; box-shadow:0 8px 24px rgba(0,0,0,0.3);"></div>

<script>
function openModal(id) { document.getElementById(id).style.display = 'flex'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }

function showToast(msg, ok) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.background = ok ? '#10b981' : '#ef4444';
    t.style.color = 'white';
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}

function hapusKursus(btn) {
    if (!confirm('Yakin ingin menghapus kursus ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Kursus berhasil dihapus.', false);
}

function editKursus(nama) {
    document.getElementById('edit-name').value = nama;
    document.getElementById('modal-edit-title').textContent = 'Edit Kursus: ' + nama;
    openModal('modal-edit');
}

function simpanEdit() {
    closeModal('modal-edit');
    showToast('Data kursus berhasil diperbarui.', true);
}

function simpanKursus() {
    const nama = document.getElementById('new-course-name').value.trim();
    if (!nama) { alert('Isi nama kursus terlebih dahulu.'); return; }
    closeModal('modal-tambah-kursus');
    showToast('Kursus baru berhasil ditambahkan.', true);
}

function bukaModalLogout(e) {
    if (e) e.preventDefault();
    document.getElementById('modalLogout').style.display = 'flex';
}
function tutupModalLogout() {
    document.getElementById('modalLogout').style.display = 'none';
}
</script>
</body>
</html>