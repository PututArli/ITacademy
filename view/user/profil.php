<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ITacademy</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/style.css">
</head>
<body>
<div class="app-layout">
    <?php require_once 'view/layouts/userSidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Pengaturan Akun</div>
            <div class="topbar-actions">
                <a href="<?= BASEURL ?>/index.php?page=profil">
                    <div class="user-avatar" style="cursor:pointer;"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                </a>
            </div>
        </div>

        <div class="page-content">
            <div class="profile-container">

                <?php if (!empty($pesan_sukses)): ?>
                    <div style="background:#10b981;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                        ✅ <?= htmlspecialchars($pesan_sukses); ?>
                    </div>
                <?php elseif (!empty($pesan_error)): ?>
                    <div style="background:#ef4444;color:#fff;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;">
                        ❌ <?= htmlspecialchars($pesan_error); ?>
                    </div>
                <?php endif; ?>

                <div class="profile-header">
                    <div class="profile-avatar-big"><?= strtoupper(substr($nama_user, 0, 2)); ?></div>
                    <div>
                        <div class="profile-title-text"><?= htmlspecialchars($nama_user); ?></div>
                        <div class="profile-subtitle-text"><?= $status_keanggotaan; ?> &middot; Anggota sejak <?= isset($data_user['created_at']) ? date('M Y', strtotime($data_user['created_at'])) : 'Mei 2026'; ?></div>
                    </div>
                </div>

                <form action="<?= BASEURL ?>/index.php?page=profil" method="POST">
                    <input type="hidden" name="aksi" value="update_profil">
                    <!-- Hidden field nama gabungan -->
                    <input type="hidden" name="nama" id="inputNamaGabung" value="<?= htmlspecialchars($nama_user); ?>">

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Depan</label>
                            <input type="text" class="form-input" id="inputNamaDepan" value="<?= htmlspecialchars($nama_depan); ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Belakang</label>
                            <input type="text" class="form-input" id="inputNamaBelakang" value="<?= htmlspecialchars($nama_belakang); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-input" value="<?= htmlspecialchars($data_user['email'] ?? ''); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tipe Keanggotaan</label>
                        <input type="text" class="form-input" value="<?= $status_keanggotaan; ?>" readonly>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Password Baru <span style="color:var(--text-muted);font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                            <input type="password" class="form-input" name="password_baru" placeholder="Password baru">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-input" name="konfirmasi" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <button type="submit" class="btn-save" onclick="gabungNama()">Simpan Perubahan</button>
                </form>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'free'): ?>
                <div class="upgrade-card" style="margin-top: 24px; background: linear-gradient(135deg, var(--bg-card), rgba(245, 158, 11, 0.05)); border: 1px solid var(--accent-gold); border-radius: 12px; padding: 24px;">
                    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                        <div>
                            <h3 style="color:var(--accent-gold); margin:0 0 8px 0; font-size:18px;">Upgrade ke Premium ✨</h3>
                            <p style="color:var(--text-muted); margin:0; font-size:14px;">Buka akses ke semua materi, tugas proyek, klaim sertifikat, dan mentorship eksklusif.</p>
                        </div>
                        <button type="button" class="btn-primary" style="background:var(--accent-gold); color:#000; border:none; padding:10px 20px; font-weight:600; border-radius:8px; cursor:pointer;" onclick="bukaModalUpgrade()">Upgrade Sekarang</button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-overlay" id="modalUpgrade">
    <div class="modal-box" style="max-width: 420px; padding: 0; overflow: hidden; background: var(--bg-card); border: 1px solid var(--accent-gold); box-shadow: 0 25px 50px rgba(0,0,0,0.5), 0 0 40px rgba(245,158,11,0.1);">
        
        <!-- Header Image/Gradient -->
        <div style="background: linear-gradient(135deg, rgba(245,158,11,0.2) 0%, rgba(245,158,11,0) 100%); padding: 30px 24px 20px; text-align: center; position: relative;">
            <button onclick="tutupModalUpgrade()" style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.1); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 24px; transition: 0.2s; z-index: 10;">&times;</button>
            <div style="font-size: 48px; line-height: 1; margin-bottom: 12px; filter: drop-shadow(0 4px 8px rgba(245,158,11,0.3));">✨</div>
            <h3 style="margin: 0; font-size: 24px; color: var(--accent-gold); font-weight: 700; letter-spacing: -0.5px;">Premium Member</h3>
            <p style="margin: 8px 0 0; color: var(--text-secondary); font-size: 14px;">Upgrade untuk membuka semua akses</p>
        </div>
        
        <div style="padding: 24px;">
            <!-- Receipt Box -->
            <div style="background: rgba(0,0,0,0.2); border: 1px solid var(--border); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                    <span style="color: var(--text-muted);">Biaya Langganan</span>
                    <span style="color: var(--text-primary);">Rp 99.000</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                    <span style="color: var(--text-muted);">Pajak & Biaya Admin</span>
                    <span style="color: var(--text-primary);">Rp 0</span>
                </div>
                <div style="height: 1px; background: var(--border); margin: 12px 0;"></div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: var(--text-secondary); font-weight: 500;">Total Tagihan</span>
                    <span style="color: var(--accent-gold); font-weight: 800; font-size: 20px;">Rp 99.000</span>
                </div>
            </div>

            <form id="formUpgrade" action="<?= BASEURL ?>/index.php?page=profil" method="POST">
                <input type="hidden" name="aksi" value="upgrade_premium">
                
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-size: 13px; color: var(--text-secondary); font-weight: 600; margin-bottom: 8px; display: block;">Metode Pembayaran</label>
                    <select class="form-input" style="width: 100%; background: var(--bg-secondary); border: 1px solid var(--border); padding: 12px 16px; border-radius: 10px; font-size: 14px; cursor: pointer; color: var(--text-primary);">
                        <option>Transfer Bank Virtual Account</option>
                        <option>Kartu Kredit / Debit</option>
                        <option>GoPay / OVO / Dana</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 13px; color: var(--text-secondary); font-weight: 600; margin-bottom: 8px; display: block;">Konfirmasi PIN</label>
                    <input type="password" id="pinPembayaran" class="form-input" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" maxlength="6" style="width: 100%; background: var(--bg-secondary); border: 1px solid var(--border); padding: 14px; border-radius: 10px; text-align: center; letter-spacing: 12px; font-size: 24px; color: var(--accent-gold);" autocomplete="off">
                </div>

                <button type="button" id="btnProsesPembayaran" class="btn-primary" style="width: 100%; justify-content: center; background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; font-size: 16px; font-weight: 700; padding: 14px; border-radius: 12px; border: none; box-shadow: 0 8px 16px rgba(245,158,11,0.2); transition: 0.3s;" onclick="prosesPembayaran()">Konfirmasi & Bayar</button>
            </form>
        </div>
    </div>
</div>

<script>
    window.itAcademyBaseUrl = '<?= BASEURL ?>';
    function gabungNama() {
        const depan   = document.getElementById('inputNamaDepan').value.trim();
        const belakang = document.getElementById('inputNamaBelakang').value.trim();
        document.getElementById('inputNamaGabung').value = belakang ? (depan + ' ' + belakang) : depan;
    }

    function bukaModalUpgrade() {
        document.getElementById('modalUpgrade').classList.add('show');
        setTimeout(() => document.getElementById('pinPembayaran').focus(), 100);
    }

    function tutupModalUpgrade() {
        document.getElementById('modalUpgrade').classList.remove('show');
    }

    function prosesPembayaran() {
        const pin = document.getElementById('pinPembayaran').value;
        if(pin.length < 4) {
            alert("Harap masukkan PIN pembayaran yang valid!");
            return;
        }
        
        const btn = document.getElementById('btnProsesPembayaran');
        btn.innerHTML = 'Memproses... ⏳';
        btn.style.opacity = '0.7';
        btn.style.cursor = 'not-allowed';
        btn.disabled = true;
        
        // Simulasi loading gateway pembayaran 1.5 detik
        setTimeout(() => {
            document.getElementById('formUpgrade').submit();
        }, 1500);
    }
</script>
<script src="<?= BASEURL ?>/assets/js/user.js"></script>
<script src="<?= BASEURL ?>/assets/js/session.js"></script>
</body>
</html>