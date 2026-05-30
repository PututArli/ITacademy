<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Tugas - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/mentorSidebar.php'; ?>
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Review Tugas Masuk</div>
            <div class="topbar-actions">
                <span class="badge badge-blue">Mentor</span>
                <a href="<?= BASEURL ?>/index.php?page=profilMentor">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            
            <!-- Filter Bar -->
            <div class="filter-card">
                <div class="filter-search-wrap">
                    <span class="filter-search-icon">🔍</span>
                    <input type="text" id="filterSearch" class="filter-input-search" placeholder="Cari nama siswa atau judul tugas...">
                </div>
                <div class="filter-select-wrap">
                    <select id="filterStatus" class="filter-input-select">
                        <option value="all">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="selesai">Selesai</option>
                        <option value="revisi">Revisi</option>
                    </select>
                </div>
            </div>

            <div class="tugas-list">
                <?php 
                if ($ambil_tugas && mysqli_num_rows($ambil_tugas) > 0) {
                    while($row = mysqli_fetch_assoc($ambil_tugas)) { 
                        $status_class = '';
                        if ($row['status'] == 'Selesai') $status_class = 'selesai';
                        if ($row['status'] == 'Revisi') $status_class = 'revisi';
                ?>
                    <div class="tugas-card" data-siswa="<?= strtolower(htmlspecialchars($row['nama_siswa'])); ?>" data-judul="<?= strtolower(htmlspecialchars($row['judul_tugas'])); ?>" data-status="<?= strtolower($row['status']); ?>">
                        <div class="tugas-header">
                            <h3 class="tugas-title"><?= htmlspecialchars($row['judul_tugas']); ?></h3>
                            <span class="badge-status <?= $status_class; ?>"><?= htmlspecialchars($row['status']); ?></span>
                        </div>
                        
                        <div class="tugas-meta">
                            Siswa: <span><?= htmlspecialchars($row['nama_siswa']); ?></span> &bull; File: <a href="#"><?= htmlspecialchars($row['nama_file']); ?></a>
                        </div>
                        
                        <p class="tugas-desc">
                            Ini adalah tugas yang dikirim oleh siswa untuk dipelajari dan direview struktur kodenya.
                        </p>
                        
                        <div class="btn-group">
                            <button class="btn-action btn-feedback">Beri Feedback</button>

                            <?php if ($row['status'] == 'Menunggu') : ?>
                                <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=setuju&id_tugas=<?= $row['id_tugas']; ?>" class="btn-action btn-approve">Setujui & Terbitkan Sertifikat</a>
                                <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=tolak&id_tugas=<?= $row['id_tugas']; ?>" class="btn-action btn-reject">Tolak & Minta Revisi</a>
                            <?php else : ?>
                                <span style="font-size: 14px; color: gray; font-weight: 600; padding: 6px 12px;">Tugas telah di-review</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo "<div class='empty-state-db' style='background: var(--bg-card); padding: 24px; border-radius: 8px; text-align: center; color: var(--text-muted);'>Belum ada data tugas yang masuk di database.</div>";
                }
                ?>
                <div id="no-data-filter" style="display:none; background: var(--bg-card); padding: 24px; border-radius: 8px; text-align: center; color: var(--text-muted);">Pencarian tidak menemukan tugas yang sesuai.</div>
            </div>
        </div>
    </div>
</div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';

    // Fitur Filter Real-Time
    const filterSearch = document.getElementById('filterSearch');
    const filterStatus = document.getElementById('filterStatus');
    const taskCards = document.querySelectorAll('.tugas-list .tugas-card');
    const noDataRow = document.getElementById('no-data-filter');

    function applyFilter() {
        const searchTerm = filterSearch.value.toLowerCase();
        const statusFilter = filterStatus.value;
        let visibleCount = 0;

        taskCards.forEach(card => {
            const siswa = card.getAttribute('data-siswa');
            const judul = card.getAttribute('data-judul');
            const status = card.getAttribute('data-status');

            const matchSearch = siswa.includes(searchTerm) || judul.includes(searchTerm);
            const matchStatus = (statusFilter === 'all') || (status === statusFilter);

            if (matchSearch && matchStatus) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (visibleCount === 0 && taskCards.length > 0) {
            noDataRow.style.display = 'block';
        } else {
            noDataRow.style.display = 'none';
        }
    }

    if (filterSearch) filterSearch.addEventListener('input', applyFilter);
    if (filterStatus) filterStatus.addEventListener('change', applyFilter);

</script>
<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>