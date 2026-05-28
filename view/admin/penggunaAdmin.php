<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    
    <?php require_once 'view/layouts/adminSidebar.php'; ?>

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
                    <div class="summary-val" style="color:var(--accent-blue);"><?= isset($total_pengguna) ? $total_pengguna : 0; ?></div>
                    <div class="summary-label">Total Siswa Aktif</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-gold);"><?= isset($total_premium) ? $total_premium : 0; ?></div>
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
        <div class="form-group"><label class="form-label">Nama Lengkap</label><input type="text" class="form-input" id="new-user-name" placeholder="Nama lengkap"></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" class="form-input" id="new-user-email" placeholder="email@contoh.com"></div>
        <div class="form-group"><label class="form-label">Tipe Akun</label>
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
        <div class="form-group"><label class="form-label">Nama</label><input type="text" class="form-input" id="edit-name"></div>
        <div class="form-group"><label class="form-label">Status</label>
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

<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
</body>
</html>