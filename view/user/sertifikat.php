<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Saya - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Sertifikat Saya</div>
            <div class="topbar-actions">
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <?php if ($_SESSION['role'] === 'premium'): ?>
                <?php if ($sertifikatSiswa): ?>
                    <div class="cert-main-box" id="printable-cert">
                        <div class="cert-badge-status">
                            <span style="font-size:16px;">🏆</span> Tersedia
                        </div>
                        <div class="cert-title">Sertifikat Kelulusan</div>
                        <p class="cert-meta">
                            No: <strong><?php echo $sertifikatSiswa['nomor_sertifikat'] ?? '-'; ?></strong><br>
                            Terbit: <?php echo isset($sertifikatSiswa['tgl_terbit']) ? date('d M Y', strtotime($sertifikatSiswa['tgl_terbit'])) : '-'; ?>
                        </p>                    
                        <div class="cert-recipient-box">
                            <p class="cert-recipient-label">Diberikan secara resmi kepada:</p>
                            <div class="cert-recipient-name">
                                <?= htmlspecialchars($sertifikatSiswa['nama_siswa'] ?? $nama_user); ?>
                            </div>
                            <p class="cert-recipient-desc">
                                Atas keberhasilan dan dedikasi dalam menyelesaikan tugas proyek <br><strong>Full-Stack Web Development</strong> di ITacademy.
                            </p>
                        </div>
                        <div class="cert-signature">
                            <div class="cert-sig-line"></div>
                            <p>Instruktur Utama ITacademy</p>
                        </div>
                        <button class="btn btn-primary btn-lg" onclick="window.print()">Unduh Sertifikat PDF</button>
                    </div>
                <?php else: ?>
                    <div class="cert-main-box">
                        <div style="font-size: 64px; margin-bottom: 16px;">⏳</div>
                        <div style="font-size: 22px; font-weight: 700; margin-bottom: 8px;">Sertifikat Belum Tersedia</div>
                        <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 500px; margin: 0 auto 20px auto;">
                            Sertifikat akan diterbitkan secara otomatis setelah mentor menyetujui tugas proyekmu.
                            Pastikan kamu sudah mengirim tugas terlebih dahulu.
                        </p>
                        <a href="<?= BASEURL ?>/index.php?page=tugas" class="btn btn-primary" style="display:inline-block;">Lihat Status Tugasku</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="cert-main-box locked-container">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔒</div>
                    <div style="font-size: 22px; font-weight: 700; color: #f87171; margin-bottom: 8px;">Fitur Sertifikat Terkunci</div>
                    <p style="color: var(--text-secondary); font-size: 14px; line-height: 1.6; max-width: 520px; margin: 0 auto;">
                        Halo <strong><?= htmlspecialchars($nama_user); ?></strong>, fitur klaim sertifikat digital resmi ITacademy hanya terbuka untuk anggota <strong>Premium</strong>.
                    </p>
                    <a href="<?= BASEURL ?>/index.php?page=profil" class="btn-upgrade">Upgrade ke Premium Sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
</script>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
<style type="text/css">
    /* Certificate Screen Design */
    .cert-main-box {
        border-color: var(--accent-blue); 
        background: linear-gradient(135deg, rgba(59,130,246,0.05), rgba(139,92,246,0.05));
    }
    .cert-title {
        font-size: 26px; font-weight: 800; margin-bottom: 8px; color: var(--text-primary);
    }
    .cert-meta {
        color: var(--text-secondary); font-size: 15px; margin-bottom: 24px;
    }
    .cert-meta strong {
        color: var(--text-primary);
    }
    .cert-recipient-box {
        background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 12px; padding: 20px; margin-bottom: 24px;
    }
    .cert-recipient-label {
        font-size: 14px; color: var(--text-muted); margin-bottom: 8px;
    }
    .cert-recipient-name {
        font-size: 24px; font-weight: 700; color: var(--accent-blue); margin-bottom: 8px;
    }
    .cert-recipient-desc {
        font-size: 14px; color: var(--text-secondary); line-height: 1.6;
    }
    .cert-signature {
        display: none; /* Only show in print */
    }

    /* Print Media Query */
    @media print {
        @page {
            size: A4 landscape;
            margin: 0;
        }
        body {
            background: #ffffff !important;
            color: #000000 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .sidebar, .topbar, .btn, .cert-badge-status {
            display: none !important;
        }
        .app-layout, .main-content, .page-content {
            display: block !important;
            height: auto !important;
            overflow: visible !important;
            padding: 0 !important;
            margin: 0 !important;
            background: transparent !important;
        }
        .cert-main-box {
            background: #f8fafc !important;
            border: 8px solid #2563eb !important;
            border-radius: 12px !important;
            margin: 40px auto !important;
            padding: 60px !important;
            max-width: 90% !important;
            height: auto !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            box-shadow: inset 0 0 0 4px #ffffff, inset 0 0 0 6px #2563eb !important;
        }
        .cert-title {
            color: #1e293b !important;
            font-size: 42px !important;
            margin-bottom: 16px !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
        }
        .cert-meta {
            color: #475569 !important;
            font-size: 16px !important;
            margin-bottom: 30px !important;
        }
        .cert-meta strong {
            color: #0f172a !important;
        }
        .cert-recipient-box {
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 12px !important;
            padding: 30px 40px !important;
            margin-bottom: 40px !important;
            width: 100% !important;
            max-width: 700px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
        }
        .cert-recipient-label {
            color: #64748b !important;
            font-size: 16px !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
        }
        .cert-recipient-name {
            color: #1d4ed8 !important;
            font-size: 36px !important;
            margin: 12px 0 !important;
        }
        .cert-recipient-desc {
            color: #334155 !important;
            font-size: 16px !important;
        }
        .cert-signature {
            display: block !important;
            margin-top: 20px !important;
            text-align: right !important;
            width: 100% !important;
            max-width: 700px !important;
        }
        .cert-sig-line {
            width: 200px !important;
            height: 1px !important;
            background: #0f172a !important;
            margin: 0 0 8px auto !important;
        }
        .cert-signature p {
            color: #475569 !important;
            font-size: 14px !important;
            margin-right: 15px !important;
        }
    }
</style>
</body>
</html>