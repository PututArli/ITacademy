<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Saya - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/mentorSidebar.php'; ?>
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Daftar Siswa</div>
            <div class="topbar-actions">
                <span class="badge badge-blue">Mentor</span>
                <a href="<?= BASEURL ?>/index.php?page=profilMentor">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <p style="color: var(--text-muted); font-size: 14px; margin: 0 0 20px 0;">Seluruh siswa aktif yang terdaftar di platform ITacademy.</p>
            
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

            <table class="siswa-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nama Siswa</th>
                        <th>Alamat Email</th>
                        <th>Status Kelas</th>
                    </tr>
                </thead>
                <tbody id="tabelDataSiswa">
                    <?php 
                    if (!empty($daftar_siswa)) {
                        foreach($daftar_siswa as $row) {
                    ?>
                        <tr class="data-row" data-nama="<?= strtolower(htmlspecialchars($row['nama'])); ?>" data-email="<?= strtolower(htmlspecialchars($row['email'])); ?>" data-role="<?= $row['role']; ?>">
                            <td style="font-weight: 600; color: var(--text-muted);">#<?= $row['id']; ?></td>
                            <td style="font-weight: 600; color: var(--text-primary);"><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td>
                                <?php if ($row['role'] == 'premium'): ?>
                                    <span class="badge-siswa badge-premium"><iconify-icon icon="lucide:star" style="vertical-align:middle; font-size:14px; margin-right:4px;"></iconify-icon>Premium</span>
                                <?php else: ?>
                                    <span class="badge-siswa badge-free">Free Account</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr class='empty-state-db'><td colspan='4' style='text-align: center; color: var(--text-muted); padding: 24px;'>Belum ada data siswa.</td></tr>";
                    }
                    ?>
                    <tr id="no-data-filter" style="display:none;"><td colspan="4" style="text-align:center; padding:30px; color:var(--text-muted);">Pencarian tidak menemukan siswa yang sesuai.</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';

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
<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>