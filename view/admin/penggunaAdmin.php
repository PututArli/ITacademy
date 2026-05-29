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
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
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
                        <?php
                        // Load pengguna dari DB
                        require_once 'model/userModel.php';
                        $userModelLocal = new userModel();
                        $semua_pengguna = $userModelLocal->getAllPengguna();

                        if (!empty($semua_pengguna)):
                            foreach ($semua_pengguna as $u):
                        ?>
                        <tr>
                            <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($u['nama']); ?></strong></td>
                            <td><?= htmlspecialchars($u['email']); ?></td>
                            <td>
                                <?php if ($u['role'] == 'premium'): ?>
                                    <span class="badge badge-gold">Premium</span>
                                <?php else: ?>
                                    <span class="badge badge-blue">Free</span>
                                <?php endif; ?>
                            </td>
                            <td>–</td>
                            <td><span class="badge badge-green">Aktif</span></td>
                            <td style="display:flex;gap:6px;">
                                <button class="action-btn action-edit" onclick="editUser('<?= htmlspecialchars($u['nama']); ?>', '<?= $u['id']; ?>', '<?= $u['role']; ?>')">Edit</button>
                                <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                            </td>
                        </tr>
                        <?php
                            endforeach;
                        else:
                        ?>
                        <tr><td colspan="6" style="text-align:center; padding:20px; color:var(--text-muted);">Belum ada siswa terdaftar.</td></tr>
                        <?php endif; ?>
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
        <div class="form-group"><label class="form-label">Tipe Akun</label>
            <select class="form-input" id="edit-status">
                <option value="free">Free</option>
                <option value="premium">Premium</option>
            </select>
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanEdit()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-edit')">Batal</button>
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