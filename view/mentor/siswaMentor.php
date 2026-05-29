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
            
            <table class="siswa-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nama Siswa</th>
                        <th>Alamat Email</th>
                        <th>Status Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($daftar_siswa)) {
                        foreach($daftar_siswa as $row) {
                    ?>
                        <tr>
                            <td style="font-weight: 600; color: var(--text-muted);">#<?= $row['id']; ?></td>
                            <td style="font-weight: 600; color: var(--text-primary);"><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td>
                                <?php if ($row['role'] == 'premium'): ?>
                                    <span class="badge-siswa badge-premium">⭐ Premium</span>
                                <?php else: ?>
                                    <span class="badge-siswa badge-free">Free Account</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align: center; color: var(--text-muted); padding: 24px;'>Belum ada data siswa.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/mentor.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>