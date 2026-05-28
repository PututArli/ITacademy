<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mentor - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/adminSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Manajemen Mentor</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-purple);">4</div>
                    <div class="summary-label">Total Mentor Aktif</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:#10b981;">42</div>
                    <div class="summary-label">Total Proyek Direview</div>
                </div>
            </div>

            <div class="section-header">
                <div class="section-title">Kelola Akun Mentor</div>
                <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-mentor')">+ Tambah Mentor Baru</button>
            </div>

            <div class="data-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Spesialisasi</th>
                            <th>Siswa Bimbingan</th>
                            <th>Tugas Direview</th>
                            <th>Rating</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong style="color:var(--text-primary);">Budi Santoso</strong></td>
                            <td>Frontend Developer</td>
                            <td>12 Siswa</td>
                            <td>42 Tugas</td>
                            <td style="color:var(--accent-gold); font-weight:600;">⭐ 4.8 / 5.0</td>
                            <td style="display:flex; gap:6px;">
                                <button class="action-btn action-edit" onclick="editMentor('Budi Santoso')">Edit</button>
                                <button class="action-btn action-del" onclick="hapusMentor(this)">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-tambah-mentor" onclick="closeModal('modal-tambah-mentor')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Mentor Baru</div>
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-input" id="new-mentor-name">
        </div>
        <div class="form-group">
            <label class="form-label">Spesialisasi</label>
            <input type="text" class="form-input" id="new-mentor-specialization">
        </div>
        <button class="btn btn-primary" onclick="simpanMentor()">Simpan</button>
    </div>
</div>

<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
</body>
</html>