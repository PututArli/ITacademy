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
                <a href="<?= BASEURL ?>/index.php?page=profilAdmin">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">

            <?php if (!empty($pesan_sukses)): ?>
                <div id="toast-msg" style="background:#10b981;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                    ✅ <?= htmlspecialchars($pesan_sukses); ?>
                </div>
            <?php elseif (!empty($pesan_error)): ?>
                <div id="toast-msg" style="background:#ef4444;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                    ❌ <?= htmlspecialchars($pesan_error); ?>
                </div>
            <?php endif; ?>

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

            <!-- Filter Bar -->
            <div class="filter-card">
                <div class="filter-search-wrap">
                    <span class="filter-search-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
                    <input type="text" id="filterSearch" class="filter-input-search" placeholder="Cari nama atau email siswa...">
                </div>
                <div class="filter-select-wrap">
                    <select id="filterRole" class="filter-input-select">
                        <option value="all">Semua Tipe Akun</option>
                        <option value="free">Free Account</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>
            </div>

            <div class="data-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tipe Akun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelDataSiswa">
                        <?php if (!empty($semua_pengguna)): ?>
                            <?php foreach ($semua_pengguna as $u): ?>
                            <tr id="row-user-<?= $u['id']; ?>" class="data-row" data-nama="<?= strtolower(htmlspecialchars($u['nama'])); ?>" data-email="<?= strtolower(htmlspecialchars($u['email'])); ?>" data-role="<?= $u['role']; ?>">
                                <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($u['nama']); ?></strong></td>
                                <td><?= htmlspecialchars($u['email']); ?></td>
                                <td>
                                    <?php if ($u['role'] == 'premium'): ?>
                                        <span class="badge badge-gold">Premium</span>
                                    <?php else: ?>
                                        <span class="badge badge-blue">Free</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-green">Aktif</span></td>
                                <td style="display:flex;gap:6px;">
                                    <button class="action-btn action-edit" onclick="editUser('<?= htmlspecialchars($u['nama']); ?>', '<?= $u['id']; ?>', '<?= $u['role']; ?>')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusUser(<?= $u['id']; ?>, this)">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="empty-state-db"><td colspan="5" style="text-align:center; padding:20px; color:var(--text-muted);">Belum ada siswa terdaftar di database.</td></tr>
                        <?php endif; ?>
                        <tr id="no-data-filter" style="display:none;"><td colspan="5" style="text-align:center; padding:30px; color:var(--text-muted);">Pencarian tidak menemukan siswa yang sesuai.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal-overlay" id="modal-tambah-user" onclick="closeModal('modal-tambah-user')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Pengguna Baru</div>
        <form id="form-tambah-user" action="<?= BASEURL ?>/index.php?page=penggunaAdmin" method="POST">
            <input type="hidden" name="aksi" value="tambah_user">
            <div class="form-group"><label class="form-label">Nama Lengkap</label><input type="text" class="form-input" name="nama" id="new-user-name" placeholder="Nama lengkap" required></div>
            <div class="form-group"><label class="form-label">Email</label><input type="email" class="form-input" name="email" id="new-user-email" placeholder="email@contoh.com" required></div>
            <div class="form-group"><label class="form-label">Password</label><input type="password" class="form-input" name="password" placeholder="Password" required></div>
            <div class="form-group"><label class="form-label">Tipe Akun</label>
                <select class="form-input" name="role" id="new-user-tipe">
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
</div>

<!-- Modal Edit User -->
<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Pengguna</div>
        <form id="form-edit-user" action="<?= BASEURL ?>/index.php?page=penggunaAdmin" method="POST">
            <input type="hidden" name="aksi" value="edit_user">
            <input type="hidden" name="id" id="edit-user-id">
            <div class="form-group"><label class="form-label">Nama</label><input type="text" class="form-input" name="nama" id="edit-name"></div>
            <div class="form-group"><label class="form-label">Tipe Akun</label>
                <select class="form-input" name="role" id="edit-status">
                    <option value="free">Free</option>
                    <option value="premium">Premium</option>
                </select>
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">Simpan</button>
                <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-edit')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Form Hapus User (hidden) -->
<form id="form-hapus-user" action="<?= BASEURL ?>/index.php?page=penggunaAdmin" method="POST" style="display:none;">
    <input type="hidden" name="aksi" value="hapus_user">
    <input type="hidden" name="id" id="hapus-user-id">
</form>

<div id="toast" style="display:none;position:fixed;bottom:24px;right:24px;padding:14px 22px;border-radius:10px;font-weight:600;z-index:9999;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(0,0,0,.3);"></div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';

    function editUser(nama, id, role) {
        document.getElementById('edit-name').value = nama;
        document.getElementById('edit-user-id').value = id;
        const sel = document.getElementById('edit-status');
        for (let opt of sel.options) {
            if (opt.value === role) { opt.selected = true; break; }
        }
        document.getElementById('modal-edit-title').textContent = 'Edit: ' + nama;
        openModal('modal-edit');
    }

    function hapusUser(id, btn) {
        if (!confirm('Yakin ingin menghapus pengguna ini?')) return;
        document.getElementById('hapus-user-id').value = id;
        document.getElementById('form-hapus-user').submit();
    }

    // Auto-hide pesan setelah 4 detik
    setTimeout(function() {
        const msg = document.getElementById('toast-msg');
        if (msg) msg.style.transition = 'opacity .5s', msg.style.opacity = '0', setTimeout(() => msg.remove(), 500);
    }, 4000);

    // Fitur Filter Real-Time
    const filterSearch = document.getElementById('filterSearch');
    const filterRole = document.getElementById('filterRole');
    const tableRows = document.querySelectorAll('#tabelDataSiswa .data-row');
    const noDataRow = document.getElementById('no-data-filter');

    function applyFilter() {
        const searchTerm = filterSearch.value.toLowerCase();
        const roleFilter = filterRole.value;
        let visibleCount = 0;

        tableRows.forEach(row => {
            const nama = row.getAttribute('data-nama');
            const email = row.getAttribute('data-email');
            const role = row.getAttribute('data-role');

            const matchSearch = nama.includes(searchTerm) || email.includes(searchTerm);
            const matchRole = (roleFilter === 'all') || (role === roleFilter);

            if (matchSearch && matchRole) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visibleCount === 0 && tableRows.length > 0) {
            noDataRow.style.display = '';
        } else {
            noDataRow.style.display = 'none';
        }
    }

    if (filterSearch) filterSearch.addEventListener('input', applyFilter);
    if (filterRole) filterRole.addEventListener('change', applyFilter);

</script>
<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>