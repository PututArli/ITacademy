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
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <?php
            require_once 'model/userModel.php';
            $userModelLocal = new userModel();
            $semua_mentor   = $userModelLocal->getAllMentor();
            $jml_mentor     = count($semua_mentor);
            ?>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-purple);"><?= $jml_mentor; ?></div>
                    <div class="summary-label">Total Mentor Aktif</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:#10b981;"><?= isset($total_mentor) ? $total_mentor : $jml_mentor; ?></div>
                    <div class="summary-label">Mentor Terdaftar</div>
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
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($semua_mentor)): ?>
                            <?php foreach ($semua_mentor as $mentor): ?>
                            <tr>
                                <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($mentor['nama']); ?></strong></td>
                                <td><?= htmlspecialchars($mentor['email']); ?></td>
                                <td><span class="badge badge-green">Aktif</span></td>
                                <td style="display:flex; gap:6px;">
                                    <button class="action-btn action-edit" onclick="editMentor('<?= htmlspecialchars($mentor['nama']); ?>', '<?= $mentor['id']; ?>')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusMentor(this)">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align:center; padding:20px; color:var(--text-muted);">Belum ada mentor terdaftar.</td></tr>
                        <?php endif; ?>
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
            <input type="text" class="form-input" id="new-mentor-name" placeholder="Nama mentor">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-input" id="new-mentor-email" placeholder="email@contoh.com">
        </div>
        <div class="form-group">
            <label class="form-label">Spesialisasi</label>
            <input type="text" class="form-input" id="new-mentor-specialization" placeholder="cth: Frontend Developer">
        </div>
        <div style="display:flex; gap:10px; margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanMentor()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-mentor')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Mentor</div>
        <div class="form-group"><label class="form-label">Nama</label><input type="text" class="form-input" id="edit-name"></div>
        <div style="display:flex; gap:10px; margin-top:8px;">
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