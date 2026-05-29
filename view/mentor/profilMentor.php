<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mentor - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/mentorSidebar.php'; ?>
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Profil Saya</div>
            <div class="topbar-actions">
                <span class="badge badge-blue">Mentor</span>
                <a href="<?= BASEURL ?>/index.php?page=profilMentor">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-avatar-big">
                        <?= strtoupper(substr($nama_user, 0, 2)); ?>
                    </div>
                    <div>
                        <h2 style="margin: 0; font-size: 20px; color: var(--text-primary);"><?= htmlspecialchars($nama_user); ?></h2>
                        <p style="margin: 4px 0 0 0; color: var(--accent-blue); font-weight: 600; font-size: 14px;">ID Mentor: #<?= $data_mentor['id'] ?? '-'; ?></p>
                    </div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px;">Nama Lengkap</div>
                    <div style="font-size: 16px; color: var(--text-primary); background-color: var(--bg-secondary); padding: 12px 16px; border-radius: 8px; border: 1px solid var(--border);"><?= htmlspecialchars($data_mentor['nama'] ?? $nama_user); ?></div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px;">Alamat Email</div>
                    <div style="font-size: 16px; color: var(--text-primary); background-color: var(--bg-secondary); padding: 12px 16px; border-radius: 8px; border: 1px solid var(--border);"><?= htmlspecialchars($data_mentor['email'] ?? 'belum diatur'); ?></div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <div style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 6px;">Peran Sistem (Role)</div>
                    <div style="font-size: 16px; color: var(--accent-blue); background-color: var(--bg-secondary); padding: 12px 16px; border-radius: 8px; border: 1px solid var(--border); font-weight: 600; text-transform: uppercase;">💼 <?= htmlspecialchars($data_mentor['role'] ?? 'MENTOR'); ?></div>
                </div>
            </div>
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