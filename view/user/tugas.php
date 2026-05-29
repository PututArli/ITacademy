<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Proyek - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Tugas Proyek</div>
            <div class="topbar-actions">
                <span class="badge badge-gold"><?= $status_keanggotaan; ?></span>
                
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="tugas-layout">
                <div>
                    <div class="section-header">
                        <div class="section-title">Kirim Tugas Proyek</div>
                    </div>

                    <!-- KONDISI 1: JIKA SISWA BELUM KIRIM TUGAS / STATUS NYA BELUM MENGIRIM -->
                    <?php if (isset($status_tugas) && $status_tugas == 'Belum Mengirim') : ?>
                        <form action="<?= BASEURL; ?>/index.php?page=kirimTugas" method="POST" enctype="multipart/form-data" style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;">
                            <div class="form-group">
                                <label class="form-label">Judul Proyek</label>
                                <input type="text" class="form-input" placeholder="Contoh: Landing Page Portfolio Rafael" id="judulInput" name="judul_tugas" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload File Proyek</label>
                                <div class="upload-zone" id="uploadZone" onclick="document.getElementById('fileInput').click()"
                                    ondragover="event.preventDefault();this.classList.add('drag')"
                                    ondragleave="this.classList.remove('drag')"
                                    ondrop="handleDrop(event)">
                                    <div class="upload-title">Klik untuk pilih file atau drag dan drop</div>
                                    <div class="upload-hint">Format: .zip, .rar, .pdf &nbsp;·&nbsp; Maksimal 20MB</div>
                                    <input type="file" class="upload-input" id="fileInput" name="file_tugas" accept=".zip,.rar,.pdf" onchange="handleFile(this.files[0])" required>
                                </div>
                                <div id="filePreview" style="display:none;" class="file-preview">
                                    <div>
                                        <div class="file-name" id="fileName">—</div>
                                        <div class="file-size" id="fileSize">—</div>
                                    </div>
                                    <div class="file-remove" onclick="removeFile()" title="Hapus">✕</div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-full btn-lg">Kirim Tugas ke Mentor</button>
                        </form>

                    <!-- KONDISI 2: JIKA STATUSNYA REVISI, BERIKAN TOMBOL UNTUK KIRIM ULANG -->
                    <?php elseif (isset($status_tugas) && $status_tugas == 'Revisi') : ?>
                        <div style="background:var(--bg-card); border:1px solid #ef4444; border-radius:var(--radius); padding:24px; margin-bottom:20px; text-align:center;">
                            <div style="font-weight:600; color:#ef4444; font-size:16px;">Tugas Perlu Revisi</div>
                            <p style="color:var(--text-secondary); font-size:13px; margin-top:5px; margin-bottom:15px;">Silakan perbaiki proyek Anda dan unggah ulang file terbaru di bawah ini.</p>
                        </div>
                        
                        <form action="<?= BASEURL; ?>/index.php?page=kirimTugas" method="POST" enctype="multipart/form-data" style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;">
                            <div class="form-group">
                                <label class="form-label">Judul Proyek (Revisi)</label>
                                <input type="text" class="form-input" placeholder="Contoh: Landing Page Portfolio Rafael - Perbaikan" id="judulInput" name="judul_tugas" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Upload File Proyek Terbaru</label>
                                <input type="file" name="file_tugas" accept=".zip,.rar,.pdf" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-full">Kirim Ulang Revisi</button>
                        </form>

                    <!-- KONDISI 3: JIKA TUGAS SUDAH MENUNGGU ATAU SELESAI, FORM DIKUNCI -->
                    <?php else : ?>
                        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); padding:40px; text-align:center;">
                            <?php if ($status_tugas == 'Selesai') : ?>
                                <div style="font-size:20px; font-weight:700; color:#10b981; margin-bottom:8px;">Tugas Lulus dan Disetujui</div>
                                <p style="color:var(--text-secondary); font-size:14px;">Sertifikat Anda telah diterbitkan secara otomatis. Silakan cek menu Sertifikat.</p>
                            <?php else : ?>
                                <div style="font-size:20px; font-weight:700; margin-bottom:8px;">Tugas Sedang Direview</div>
                                <p style="color:var(--text-secondary); font-size:14px;">Tugas proyek Anda telah tersimpan di sistem dan sedang diperiksa oleh mentor.</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- BAGIAN KANAN: STATUS SERTIFIKASI DINAMIS -->
                <div>
                    <div class="section-header"><div class="section-title">Status Sertifikasi</div></div>
                    <div class="step-track">
                        <div class="step-track-item">
                            <div class="step-track-left"><div class="step-dot done">✓</div><div class="step-line done"></div></div>
                            <div class="step-body"><div class="step-sname">Selesaikan Materi</div></div>
                        </div>
                        <div class="step-track-item">
                            <div class="step-track-left">
                                <?php if (isset($status_tugas) && $status_tugas == 'Selesai') : ?>
                                    <div class="step-dot done">✓</div><div class="step-line done"></div>
                                <?php elseif (isset($status_tugas) && $status_tugas == 'Revisi') : ?>
                                    <div class="step-dot" style="background:#ef4444; color:white; display:flex; align-items:center; justify-content:center; border-radius:50%; width:24px; height:24px; font-weight:bold;">✕</div><div class="step-line"></div>
                                <?php else : ?>
                                    <div class="step-dot wait">-</div><div class="step-line"></div>
                                <?php endif; ?>
                            </div>
                            <div class="step-body">
                                <div class="step-sname">Review Mentor</div>
                                <div class="step-sdesc">Status saat ini: <strong><?= isset($status_tugas) ? $status_tugas : 'Belum Mengirim'; ?></strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>