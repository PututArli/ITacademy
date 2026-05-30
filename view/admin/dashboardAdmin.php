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
                                    <a href="<?= BASEURL ?>/index.php?page=penggunaAdmin" class="action-btn action-edit">Kelola</a>
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
                                    <a href="<?= BASEURL ?>/index.php?page=mentorAdmin" class="action-btn action-edit">Kelola</a>
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
                                <td><?= htmlspecialchars($tugas['judul_tugas'] ?? 'Tugas #' . $tugas['id_tugas']); ?></td>
                                <td><?= isset($tugas['created_at']) ? date('d M Y', strtotime($tugas['created_at'])) : '-'; ?></td>
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
    <form class="modal-box" onclick="event.stopPropagation()" method="POST" action="<?= BASEURL ?>/index.php?page=penggunaAdmin">
        <input type="hidden" name="aksi" value="tambah_user">
        <div class="modal-title">Tambah Pengguna Baru</div>
        <div class="form-group"><label class="form-label">Nama</label><input type="text" name="nama" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Password</label><input type="password" name="password" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Tipe Akun</label>
            <select name="role" class="form-input">
                <option value="free">Free</option>
                <option value="premium">Premium</option>
            </select>
        </div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button type="submit" class="btn btn-primary" style="flex:1;">Simpan</button>
            <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-user')">Batal</button>
        </div>
    </form>
</div>

<div class="modal-overlay" id="modal-tambah-mentor" onclick="closeModal('modal-tambah-mentor')">
    <form class="modal-box" onclick="event.stopPropagation()" method="POST" action="<?= BASEURL ?>/index.php?page=mentorAdmin">
        <input type="hidden" name="aksi" value="tambah_mentor">
        <div class="modal-title">Tambah Mentor Baru</div>
        <div class="form-group"><label class="form-label">Nama Lengkap</label><input type="text" name="nama" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Password</label><input type="password" name="password" class="form-input" required></div>
        <div style="display:flex;gap:10px;margin-top:8px;">
            <button type="submit" class="btn btn-primary" style="flex:1;">Simpan</button>
            <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-mentor')">Batal</button>
        </div>
    </form>
</div>

<div id="toast" style="display:none;position:fixed;bottom:24px;right:24px;padding:14px 22px;border-radius:10px;font-weight:600;z-index:9999;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(0,0,0,.3);"></div>
<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>