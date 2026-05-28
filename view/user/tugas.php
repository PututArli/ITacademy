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
                <div class="user-avatar"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
            </div>
        </div>

        <div class="page-content">
            <div class="tugas-layout">
                <div>
                    <div class="section-header">
                        <div class="section-title">Kirim Tugas Proyek</div>
                    </div>

                    <div id="tugasForm" style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;">
                        <div class="form-group">
                            <label class="form-label">Judul Proyek</label>
                            <input type="text" class="form-input" placeholder="cth: Landing Page Portfolio Rafael" id="judulInput">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Upload File Proyek</label>
                            <div class="upload-zone" id="uploadZone" onclick="document.getElementById('fileInput').click()"
                                ondragover="event.preventDefault();this.classList.add('drag')"
                                ondragleave="this.classList.remove('drag')"
                                ondrop="handleDrop(event)">
                                <div class="upload-icon">📁</div>
                                <div class="upload-title">Klik untuk pilih file atau drag & drop</div>
                                <div class="upload-hint">Format: .zip, .rar, .pdf &nbsp;·&nbsp; Maksimal 20MB</div>
                                <input type="file" class="upload-input" id="fileInput" accept=".zip,.rar,.pdf" onchange="handleFile(this.files[0])">
                            </div>
                            <div id="filePreview" style="display:none;" class="file-preview">
                                <div class="file-icon">📦</div>
                                <div>
                                    <div class="file-name" id="fileName">—</div>
                                    <div class="file-size" id="fileSize">—</div>
                                </div>
                                <div class="file-remove" onclick="removeFile()" title="Hapus">✕</div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-full btn-lg" onclick="submitTugas()">Kirim Tugas ke Mentor</button>
                    </div>
                </div>

                <div>
                    <div class="section-header"><div class="section-title">Status Sertifikasi</div></div>
                    <div class="step-track">
                        <div class="step-track-item">
                            <div class="step-track-left"><div class="step-dot done">✓</div><div class="step-line done"></div></div>
                            <div class="step-body"><div class="step-sname">Selesaikan Materi</div></div>
                        </div>
                        <div class="step-track-item">
                            <div class="step-track-left"><div class="step-dot wait">⏳</div><div class="step-line"></div></div>
                            <div class="step-body"><div class="step-sname">Review Mentor</div><div class="step-sdesc">Menunggu persetujuan mentor</div></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="successMsg" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.7);z-index:1000;align-items:center;justify-content:center;" onclick="this.style.display='none'">
                <div style="background:var(--bg-card);border:1px solid rgba(16,185,129,0.3);border-radius:24px;padding:48px;text-align:center;max-width:420px;margin:20px;" onclick="event.stopPropagation()">
                    <div style="font-size:52px;margin-bottom:14px;">🚀</div>
                    <div style="font-size:20px;font-weight:700;margin-bottom:8px;">Tugas Berhasil Dikirim!</div>
                    <button class="btn btn-primary btn-full" onclick="document.getElementById('successMsg').style.display='none'">Oke, Mengerti</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
</body>
</html>