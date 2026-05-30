<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kursus - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    
    <?php require_once 'view/layouts/adminSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Manajemen Kursus</div>
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
                    <div class="summary-val" style="color:var(--accent-blue);">1</div>
                    <div class="summary-label">Kursus Aktif</div>
                </div>
                <div class="summary-card">
                    <div class="summary-val" style="color:var(--accent-purple);">12</div>
                    <div class="summary-label">Total Modul Materi</div>
                </div>
            </div>

            <div class="section-header">
                <div class="section-title">Daftar Kursus ITacademy</div>
                <button class="btn btn-primary" style="font-size:13px;" onclick="openModal('modal-tambah-kursus')">+ Tambah Kursus Baru</button>
            </div>

            <!-- Filter Bar -->
            <div class="filter-card">
                <div class="filter-search-wrap">
                    <span class="filter-search-icon">🔍</span>
                    <input type="text" id="filterSearch" class="filter-input-search" placeholder="Cari nama kursus atau kategori...">
                </div>
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
                    <tbody id="tabelDataKursus">
                        <tr class="data-row" data-nama="full-stack web development" data-kategori="programming">
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
                        <tr id="no-data-filter" style="display:none;"><td colspan="6" style="text-align:center; padding:30px; color:var(--text-muted);">Pencarian tidak menemukan kursus yang sesuai.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-tambah-kursus" onclick="closeModal('modal-tambah-kursus')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title">Tambah Kursus Baru</div>
        <div class="form-group"><label class="form-label">Nama Kursus</label><input type="text" class="form-input" id="new-course-name" placeholder="Nama kursus baru"></div>
        <div class="form-group"><label class="form-label">Kategori</label><input type="text" class="form-input" id="new-course-cat" placeholder="cth: Programming, Design"></div>
        <div style="display:flex; gap:10px; margin-top:8px;">
            <button class="btn btn-primary" style="flex:1;" onclick="simpanKursus()">Simpan</button>
            <button class="btn btn-ghost" style="flex:1;" onclick="closeModal('modal-tambah-kursus')">Batal</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal-edit" onclick="closeModal('modal-edit')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-title" id="modal-edit-title">Edit Kursus</div>
        <div class="form-group"><label class="form-label">Nama Kursus</label><input type="text" class="form-input" id="edit-name"></div>
        <div class="form-group"><label class="form-label">Status</label>
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

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';

    // Fitur Filter Real-Time
    const filterSearch = document.getElementById('filterSearch');
    const tableRows = document.querySelectorAll('#tabelDataKursus .data-row');
    const noDataRow = document.getElementById('no-data-filter');

    function applyFilter() {
        const searchTerm = filterSearch.value.toLowerCase();
        let visibleCount = 0;

        tableRows.forEach(row => {
            const nama = row.getAttribute('data-nama');
            const kategori = row.getAttribute('data-kategori');

            if (nama.includes(searchTerm) || kategori.includes(searchTerm)) {
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