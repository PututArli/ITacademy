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

            <?php if (!empty($pesan_sukses)): ?>
                <div id="toast-msg" style="background:#10b981;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                    &#10003; <?= htmlspecialchars($pesan_sukses); ?>
                </div>
            <?php endif; ?>

            <!-- Filter Bar -->
            <div class="filter-card">
                <div class="filter-search-wrap">
                    <span class="filter-search-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </span>
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
                        if ($row['status'] == 'Revisi')  $status_class = 'revisi';
                        $id_t = intval($row['id_tugas']);
                        $catatan_ada = !empty($row['catatan_mentor']);
                ?>
                    <div class="tugas-card" data-siswa="<?= strtolower(htmlspecialchars($row['nama_siswa'])); ?>" data-judul="<?= strtolower(htmlspecialchars($row['judul_tugas'])); ?>" data-status="<?= strtolower($row['status']); ?>">
                        <div class="tugas-header">
                            <h3 class="tugas-title"><?= htmlspecialchars($row['judul_tugas']); ?></h3>
                            <span class="badge-status <?= $status_class; ?>"><?= htmlspecialchars($row['status']); ?></span>
                        </div>

                        <div class="tugas-meta">
                            Siswa: <span><?= htmlspecialchars($row['nama_siswa']); ?></span>
                            &bull; File: <span style="color:var(--accent-blue);"><?= htmlspecialchars($row['nama_file']); ?></span>
                        </div>

                        <?php if ($catatan_ada): ?>
                        <div class="catatan-mentor-box">
                            <div class="catatan-label">Catatan Mentor:</div>
                            <div class="catatan-isi"><?= nl2br(htmlspecialchars($row['catatan_mentor'])); ?></div>
                        </div>
                        <?php endif; ?>

                        <div class="btn-group" style="margin-top:14px;">
                            <?php if ($row['status'] == 'Menunggu'): ?>
                                <!-- Tombol Setujui -->
                                <a href="<?= BASEURL; ?>/index.php?page=reviewTugasMentor&aksi=setuju&id_tugas=<?= $id_t; ?>"
                                   class="btn-action btn-approve"
                                   onclick="return confirm('Setujui tugas ini dan terbitkan sertifikat?')">
                                   &#10003; Setujui &amp; Terbitkan Sertifikat
                                </a>

                                <!-- Tombol Tolak (buka form tolak) -->
                                <button class="btn-action btn-reject" onclick="togglePanel('tolak-<?= $id_t; ?>')">
                                    &#10005; Tolak &amp; Minta Revisi
                                </button>

                                <!-- Panel Tolak (inline) -->
                                <div id="tolak-<?= $id_t; ?>" class="feedback-panel" style="display:none;">
                                    <form method="POST" action="<?= BASEURL ?>/index.php?page=reviewTugasMentor">
                                        <input type="hidden" name="aksi" value="tolak_tugas">
                                        <input type="hidden" name="id_tugas" value="<?= $id_t; ?>">
                                        <label class="feedback-label">Alasan Penolakan / Catatan Revisi (wajib):</label>
                                        <textarea name="catatan_mentor" class="feedback-textarea" rows="3" placeholder="Jelaskan apa yang perlu diperbaiki siswa..." required></textarea>
                                        <div style="display:flex;gap:8px;margin-top:8px;">
                                            <button type="submit" class="btn-action btn-reject">Konfirmasi Tolak</button>
                                            <button type="button" class="btn-action btn-feedback" onclick="togglePanel('tolak-<?= $id_t; ?>')">Batal</button>
                                        </div>
                                    </form>
                                </div>

                            <?php else: ?>
                                <span style="font-size:13px;color:var(--text-muted);font-weight:600;padding:6px 12px;">
                                    Tugas telah di-review (<?= htmlspecialchars($row['status']); ?>)
                                </span>
                            <?php endif; ?>

                            <!-- Tombol Beri Feedback (selalu tampil) -->
                            <button class="btn-action btn-feedback" onclick="togglePanel('feedback-<?= $id_t; ?>')">
                                &#9998; <?= $catatan_ada ? 'Edit Feedback' : 'Beri Feedback'; ?>
                            </button>

                            <!-- Panel Feedback (inline) -->
                            <div id="feedback-<?= $id_t; ?>" class="feedback-panel" style="display:none;">
                                <form method="POST" action="<?= BASEURL ?>/index.php?page=reviewTugasMentor">
                                    <input type="hidden" name="aksi" value="beri_feedback">
                                    <input type="hidden" name="id_tugas" value="<?= $id_t; ?>">
                                    <label class="feedback-label">Catatan / Feedback untuk siswa:</label>
                                    <textarea name="catatan_mentor" class="feedback-textarea" rows="3" placeholder="Tulis catatan, pujian, atau saran untuk siswa..."><?= htmlspecialchars($row['catatan_mentor'] ?? ''); ?></textarea>
                                    <div style="display:flex;gap:8px;margin-top:8px;">
                                        <button type="submit" class="btn-action btn-approve">Simpan Feedback</button>
                                        <button type="button" class="btn-action btn-feedback" onclick="togglePanel('feedback-<?= $id_t; ?>')">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<div class='empty-state-db' style='background:var(--bg-card);padding:40px;border-radius:12px;text-align:center;color:var(--text-muted);'>Belum ada data tugas yang masuk.</div>";
                }
                ?>
                <div id="no-data-filter" style="display:none;background:var(--bg-card);padding:40px;border-radius:12px;text-align:center;color:var(--text-muted);">
                    Tidak ada tugas yang cocok dengan filter.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.catatan-mentor-box {
    background: rgba(59,130,246,0.06);
    border: 1px solid rgba(59,130,246,0.2);
    border-radius: 8px;
    padding: 12px 14px;
    margin-top: 10px;
    font-size: 13px;
    color: var(--text-secondary);
}
.catatan-label {
    font-size: 11px;
    font-weight: 700;
    color: var(--accent-blue);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}
.catatan-isi { line-height: 1.6; }

.feedback-panel {
    width: 100%;
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 14px 16px;
    margin-top: 10px;
}
.feedback-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 6px;
}
.feedback-textarea {
    width: 100%;
    background: var(--bg-card);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    padding: 10px 12px;
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    resize: vertical;
    outline: none;
    transition: border-color 0.2s;
}
.feedback-textarea:focus { border-color: var(--accent-blue); }
</style>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';

    function togglePanel(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.display = el.style.display === 'none' ? 'block' : 'none';
    }

    // Auto-hide pesan sukses
    setTimeout(function() {
        const msg = document.getElementById('toast-msg');
        if (msg) { msg.style.transition = 'opacity .5s'; msg.style.opacity = '0'; setTimeout(() => msg.remove(), 500); }
    }, 4000);

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
            const siswa  = card.getAttribute('data-siswa') || '';
            const judul  = card.getAttribute('data-judul') || '';
            const status = card.getAttribute('data-status') || '';
            const matchSearch = siswa.includes(searchTerm) || judul.includes(searchTerm);
            const matchStatus = statusFilter === 'all' || status === statusFilter;
            if (matchSearch && matchStatus) { card.style.display = ''; visibleCount++; }
            else { card.style.display = 'none'; }
        });
        noDataRow.style.display = (visibleCount === 0 && taskCards.length > 0) ? 'block' : 'none';
    }

    if (filterSearch) filterSearch.addEventListener('input', applyFilter);
    if (filterStatus) filterStatus.addEventListener('change', applyFilter);
</script>
<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>