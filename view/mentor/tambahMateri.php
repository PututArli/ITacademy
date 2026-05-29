<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/mentorSidebar.php'; ?>
    
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Tambah Materi Baru</div>
            <div class="topbar-actions">
                <span class="badge badge-blue">Mentor</span>
                <a href="<?= BASEURL ?>/index.php?page=profilMentor">
                    <div class="user-avatar" style="cursor:pointer;">
                        <?php
                            $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Mentor';
                            echo strtoupper(substr($nama, 0, 2)); 
                        ?>
                    </div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="tugas-card" style="max-width: 800px; margin: 0 auto;">
                <h3 class="tugas-title" style="margin-bottom: 20px;">Form Tambah Materi</h3>
                
                <form action="index.php?page=prosesTambahMateri" method="POST">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Judul Materi</label>
                        <input type="text" name="judul" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #2c3e50; border-radius: 4px;" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Link Embed YouTube</label>
                        <input type="text" name="link" class="form-control" placeholder="https://www.youtube.com/embed/..." style="width: 100%; padding: 10px; border: 1px solid #2c3e50; border-radius: 4px;" required>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="5" style="width: 100%; padding: 10px; border: 1px solid #2c3e50; border-radius: 4px;" required></textarea>
                    </div>
                    
                    <div class="btn-group" style="margin-top: 20px;">
                        <button type="submit" class="btn-action btn-approve" style="cursor:pointer;">Simpan Materi</button>
                        <a href="<?= BASEURL ?>/index.php?page=dashboardMentor" class="btn-action" style="background:#6c757d; color:white; text-decoration:none; padding:10px 20px; border-radius:4px;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>window.itAcademyBaseUrl = '<?= BASEURL ?>';</script>
</body>
</html>