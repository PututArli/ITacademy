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
                    <div class="summary-val" style="color:var(--accent-purple);"><?= $total_mentor ?? count($semua_mentor); ?></div>
                    <div class="summary-label">Total Mentor Aktif</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:#10b981;"><?= $total_mentor ?? count($semua_mentor); ?></div>
                    <div class="summary-label">Mentor Terdaftar</div>
                </div>
            </div>

            <div class="section-header">
                <div class="section-title">Kelola Akun Mentor</div>
                <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-mentor')">+ Tambah Mentor Baru</button>
            </div>

            <!-- Filter Bar -->
            <div class="filter-card">
                <div class="filter-search-wrap">
                    <span class="filter-search-icon">🔍</span>
                    <input type="text" id="filterSearch" class="filter-input-search" placeholder="Cari nama atau email mentor...">
                </div>
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
                    <tbody id="tabelDataMentor">
                        <?php if (!empty($semua_mentor)): ?>
                            <?php foreach ($semua_mentor as $mentor): ?>
                            <tr id="row-mentor-<?= $mentor['id']; ?>" class="data-row" data-nama="<?= strtolower(htmlspecialchars($mentor['nama'])); ?>" data-email="<?= strtolower(htmlspecialchars($mentor['email'])); ?>">
                                <td><strong style="color:var(--text-primary);"><?= htmlspecialchars($mentor['nama']); ?></strong></td>
                                <td><?= htmlspecialchars($mentor['email']); ?></td>
                                <td><span class="badge badge-green">Aktif</span></td>
                                <td style="display:flex; gap:6px;">
                                    <button class="action-btn action-edit" onclick="editMentor('<?= htmlspecialchars($mentor['nama']); ?>', '<?= $mentor['id']; ?>')">Edit</button>
                                    <button class="action-btn action-del" onclick="hapusMentorDB(<?= $mentor['id']; ?>, this)">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="empty-state-db"><td colspan="4" style="text-align:center; padding:20px; color:var(--text-muted);">Belum ada mentor terdaftar di database.</td></tr>
                        <?php endif; ?>
                        <tr id="no-data-filter" style="display:none;"><td colspan="4" style="text-align:center; padding:30px; color:var(--text-muted);">Pencarian tidak menemukan mentor yang sesuai.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Mentor -->
<div class="modal-overlay" id="modal-tambah-mentor" onclick="closeModal('modal-tambah-mentor')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Mentor Baru</div>
        <form action="<?= BASEURL ?>/index.php?page=mentorAdmin" method="POST">
            <input type="hidden" name="aksi" value="tambah_mentor">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-input" name="nama" id="new-mentor-name" placeholder="Nama mentor" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" name="email" id="new-mentor-email" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-input" name="password" placeholder="Password" required>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">Simpan</button>
                <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-mentor')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Mentor -->
<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Mentor</div>
        <form action="<?= BASEURL ?>/index.php?page=mentorAdmin" method="POST">
            <input type="hidden" name="aksi" value="edit_mentor">
            <input type="hidden" name="id" id="edit-mentor-id">
            <div class="form-group"><label class="form-label">Nama</label><input type="text" class="form-input" name="nama" id="edit-name"></div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">Simpan</button>
                <button type="button" class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-edit')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Form Hapus Mentor (hidden) -->
<form id="form-hapus-mentor" action="<?= BASEURL ?>/index.php?page=mentorAdmin" method="POST" style="display:none;">
    <input type="hidden" name="aksi" value="hapus_mentor">
    <input type="hidden" name="id" id="hapus-mentor-id">
</form>

<div id="toast" style="display:none;position:fixed;bottom:24px;right:24px;padding:14px 22px;border-radius:10px;font-weight:600;z-index:9999;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(0,0,0,.3);"></div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';

    function editMentor(nama, id) {
        document.getElementById('edit-name').value = nama;
        document.getElementById('edit-mentor-id').value = id;
        document.getElementById('modal-edit-title').textContent = 'Edit Mentor: ' + nama;
        openModal('modal-edit');
    }

    function hapusMentorDB(id, btn) {
        if (!confirm('Yakin ingin menghapus mentor ini?')) return;
        document.getElementById('hapus-mentor-id').value = id;
        document.getElementById('form-hapus-mentor').submit();
    }

    // Auto-hide pesan setelah 4 detik
    setTimeout(function() {
        const msg = document.getElementById('toast-msg');
        if (msg) msg.style.transition = 'opacity .5s', msg.style.opacity = '0', setTimeout(() => msg.remove(), 500);
    }, 4000);

    // Fitur Filter Real-Time
    const filterSearch = document.getElementById('filterSearch');
    const tableRows = document.querySelectorAll('#tabelDataMentor .data-row');
    const noDataRow = document.getElementById('no-data-filter');

    function applyFilter() {
        const searchTerm = filterSearch.value.toLowerCase();
        let visibleCount = 0;

        tableRows.forEach(row => {
            const nama = row.getAttribute('data-nama');
            const email = row.getAttribute('data-email');

            if (nama.includes(searchTerm) || email.includes(searchTerm)) {
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

</script>
<script src="<?= BASEURL ?>/assets/js/admin.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>