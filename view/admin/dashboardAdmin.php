<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    
    <?php require_once 'view/layouts/adminSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Dashboard Admin</div>
            <div class="topbar-actions">
                <span class="badge badge-purple">Admin</span>
                <a href="<?= BASEURL ?>/index.php?page=profilAdmin">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-blue);"><?= $total_pengguna; ?></div>
                    <div class="summary-label">Total Pengguna</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-purple);"><?= $total_mentor; ?></div>
                    <div class="summary-label">Total Mentor</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-gold);"><?= $total_premium; ?></div>
                    <div class="summary-label">User Premium</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:#10b981;"><?= $total_sertifikat; ?></div>
                    <div class="summary-label">Sertifikat Diterbitkan</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-blue);"><?= $total_tugas_menunggu; ?></div>
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
                            <?php foreach($daftar_pengguna as $user): ?>
                            <tr>
                                <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($user['nama']); ?></strong></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <?php if($user['role'] == 'premium'): ?>
                                        <span class="badge badge-gold">Premium</span>
                                    <?php else: ?>
                                        <span class="badge badge-blue">Free</span>
                                    <?php endif; ?>
                                </td>
                                <td>0%</td>
                                <td><span class="badge badge-green">Aktif</span></td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('<?= htmlspecialchars($user['nama']); ?>')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <?php if(empty($daftar_pengguna)): ?>
                            <tr><td colspan="6" style="text-align:center; padding:20px; color:var(--text-muted);">Belum ada pengguna terdaftar.</td></tr>
                            <?php endif; ?>
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
                                <th>Email</th>
                                <th>Rating</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($daftar_mentor as $mentor): ?>
                            <tr>
                                <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($mentor['nama']); ?></strong></td>
                                <td><?= htmlspecialchars($mentor['email']); ?></td>
                                <td style="color:var(--accent-gold);font-weight:600;">Menunggu Penilaian</td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('<?= htmlspecialchars($mentor['nama']); ?>')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(this)">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <?php if(empty($daftar_mentor)): ?>
                            <tr><td colspan="4" style="text-align:center; padding:20px; color:var(--text-muted);">Belum ada mentor terdaftar.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-tugas" style="display:none;">
                <div class="section-header" style="margin-bottom:14px;">
                    <div class="section-title">Semua Tugas Masuk (Menunggu Review)</div>
                </div>
                <div class="data-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>File Tugas</th>
                                <th>Tanggal Kirim</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($daftar_tugas as $tugas): ?>
                            <tr>
                                <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($tugas['nama_siswa']); ?></strong></td>
                                <td>Tugas #<?= $tugas['id']; ?></td>
                                <td>Sistem Terbaru</td>
                                <td><span class="badge badge-gold">Menunggu</span></td>
                            </tr>
                            <?php endforeach; ?>

                            <?php if(empty($daftar_tugas)): ?>
                            <tr><td colspan="4" style="text-align:center; padding:20px; color:var(--text-muted);">Tidak ada tugas yang menunggu review saat ini.</td></tr>
                            <?php endif; ?>
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
        <div class="form-group"><label class="form-label">Nama</label><input type="text" class="form-input" id="new-user-name"></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" class="form-input"></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanUser()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-user')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-tambah-mentor" onclick="closeModal('modal-tambah-mentor')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Mentor Baru</div>
        <div class="form-group"><label class="form-label">Nama Lengkap</label><input type="text" class="form-input" id="new-mentor-name"></div>
        <div class="form-group"><label class="form-label">Spesialisasi</label><input type="text" class="form-input"></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanMentor()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-mentor')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Pengguna</div>
        <div class="form-group"><label class="form-label">Nama</label><input type="text" class="form-input" id="edit-name"></div>
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