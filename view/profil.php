<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .profil-layout { display: grid; grid-template-columns: 280px 1fr; gap: 20px; }
        @media (max-width: 900px) { .profil-layout { grid-template-columns: 1fr; } }

        .profil-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 28px; text-align: center; position: sticky; top: 0; }
        .profil-avatar-big { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple)); display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; color: white; margin: 0 auto 14px; border: 3px solid rgba(59,130,246,0.3); cursor: pointer; transition: var(--transition); }
        .profil-avatar-big:hover { transform: scale(1.05); }
        .profil-name { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .profil-email { font-size: 13px; color: var(--text-secondary); margin-bottom: 14px; }
        .profil-divider { height: 1px; background: var(--border); margin: 16px 0; }
        .profil-stat { display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px; }
        .profil-stat-label { color: var(--text-muted); }
        .profil-stat-val { font-weight: 600; }
        .profil-logout { display: flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 10px; color: #ef4444; font-size: 14px; font-weight: 600; cursor: pointer; transition: var(--transition); margin-top: 16px; justify-content: center; border: 1px solid rgba(239,68,68,0.2); }
        .profil-logout:hover { background: rgba(239,68,68,0.08); }

        .edit-section { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 24px; margin-bottom: 20px; }
        .edit-title { font-size: 16px; font-weight: 700; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid var(--border); }

        .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media (max-width: 600px) { .input-row { grid-template-columns: 1fr; } }

        .activity-item { display: flex; align-items: flex-start; gap: 12px; padding: 14px 0; border-bottom: 1px solid var(--border); }
        .activity-item:last-child { border-bottom: none; }
        .activity-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-top: 5px; }
        .activity-dot.blue { background: var(--accent-blue); }
        .activity-dot.green { background: #10b981; }
        .activity-dot.purple { background: var(--accent-purple); }
        .activity-dot.gold { background: var(--accent-gold); }
        .activity-text { font-size: 13px; color: var(--text-secondary); flex: 1; line-height: 1.5; }
        .activity-text strong { color: var(--text-primary); }
        .activity-time { font-size: 11px; color: var(--text-muted); white-space: nowrap; }

        .toast { position: fixed; bottom: 28px; right: 28px; background: #10b981; color: white; padding: 12px 20px; border-radius: 10px; font-size: 14px; font-weight: 600; z-index: 1000; display: none; align-items: center; gap: 8px; box-shadow: 0 8px 24px rgba(0,0,0,0.3); }
    </style>
</head>
<body>
<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">IT</div>
            <span class="brand-name">IT<span>academy</span></span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Belajar</div>
            <a href="view/vdashboard.php" class="nav-item"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="view/materi.php" class="nav-item"><span class="nav-icon">📖</span> Materi</a>
            <a href="view/kuis.php" class="nav-item"><span class="nav-icon">✔</span> Kuis</a>
            <a href="view/tugas.php" class="nav-item"><span class="nav-icon">📤</span> Tugas Proyek</a>
            <a href="view/sertifikat.php" class="nav-item"><span class="nav-icon">🏅</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="view/profil.php" class="nav-item active"><span class="nav-icon">👤</span> Profil</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">RF</div>
                <div><div class="user-name">Rafael</div><div class="user-role">Premium</div></div>
                <a href="view/login.php" class="user-logout" title="Keluar">←</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Profil Saya</div>
            <div class="topbar-actions">
                <span class="badge badge-gold">Premium</span>
                <div class="user-avatar">RF</div>
            </div>
        </div>

        <div class="page-content">
            <div class="profil-layout">

                <div>
                    <div class="profil-card">
                        <div class="profil-avatar-big" title="Klik untuk ganti foto">RF</div>
                        <div class="profil-name">Rafael Arlianto</div>
                        <div class="profil-email">rafael@email.com</div>
                        <span class="badge badge-gold" style="margin-bottom:8px;">⭐ User Premium</span>
                        <div style="font-size:12px;color:var(--text-muted);">Bergabung: Januari 2025</div>
                        <div class="profil-divider"></div>
                        <div class="profil-stat"><span class="profil-stat-label">Modul Selesai</span><span class="profil-stat-val">8 / 12</span></div>
                        <div class="profil-stat"><span class="profil-stat-label">Kuis Lulus</span><span class="profil-stat-val">2 / 3</span></div>
                        <div class="profil-stat"><span class="profil-stat-label">Tugas Dikirim</span><span class="profil-stat-val">1</span></div>
                        <div class="profil-stat"><span class="profil-stat-label">Sertifikat</span><span class="profil-stat-val">0</span></div>
                        <div class="profil-divider"></div>
                        <div class="profil-stat"><span class="profil-stat-label">Mentor</span><span class="profil-stat-val">Budi Santoso</span></div>
                        <div class="profil-stat"><span class="profil-stat-label">Paket</span><span class="profil-stat-val" style="color:var(--accent-gold);">Premium</span></div>
                        <div class="profil-stat"><span class="profil-stat-label">Aktif hingga</span><span class="profil-stat-val">12 Jun 2025</span></div>
                        <a href="view/login.php" class="profil-logout">🚪 Keluar dari Akun</a>
                    </div>
                </div>

                <div>
                    <div class="edit-section">
                        <div class="edit-title">Informasi Akun</div>
                        <div class="input-row">
                            <div class="form-group">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" class="form-input" value="Rafael" id="firstName">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" class="form-input" value="Arlianto" id="lastName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" value="rafael@email.com" id="emailInput">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon <span style="color:var(--text-muted);font-weight:400;">(opsional)</span></label>
                            <input type="tel" class="form-input" placeholder="08xxxxxxxxxx" id="phoneInput">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bio Singkat <span style="color:var(--text-muted);font-weight:400;">(opsional)</span></label>
                            <textarea class="form-input" rows="2" placeholder="Ceritakan sedikit tentang dirimu..." id="bioInput" style="resize:vertical;"></textarea>
                        </div>
                        <button class="btn btn-primary" onclick="saveProfile()">Simpan Perubahan</button>
                    </div>

                    <div class="edit-section">
                        <div class="edit-title">Ganti Password</div>
                        <div class="form-group">
                            <label class="form-label">Password Lama</label>
                            <input type="password" class="form-input" placeholder="Password saat ini" id="oldPass">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-input" placeholder="Min. 8 karakter" id="newPass">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-input" placeholder="Ulangi password baru" id="confirmPass">
                        </div>
                        <button class="btn btn-outline" onclick="changePassword()">Update Password</button>
                    </div>

                    <div class="edit-section">
                        <div class="edit-title">Aktivitas Terakhir</div>
                        <div>
                            <div class="activity-item">
                                <div class="activity-dot blue"></div>
                                <div class="activity-text">Menonton video <strong>CSS Flexbox — Konsep Dasar</strong> (Modul 3)</div>
                                <div class="activity-time">12 Mei · 15:40</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot gold"></div>
                                <div class="activity-text">Mengirim tugas proyek <strong>Landing Page Portfolio</strong></div>
                                <div class="activity-time">10 Mei · 14:32</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot green"></div>
                                <div class="activity-text">Lulus kuis <strong>Modul 2: CSS Dasar</strong> dengan skor 88/100</div>
                                <div class="activity-time">8 Mei · 10:15</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot green"></div>
                                <div class="activity-text">Lulus kuis <strong>Modul 1: HTML Dasar</strong> dengan skor 92/100</div>
                                <div class="activity-time">5 Mei · 09:00</div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-dot purple"></div>
                                <div class="activity-text">Bergabung ke kursus <strong>Web Development Dasar</strong></div>
                                <div class="activity-time">1 Mei · 08:30</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast" id="toast">✓ <span id="toastMsg">Tersimpan!</span></div>

<script>
function showToast(msg) {
    const t = document.getElementById('toast');
    document.getElementById('toastMsg').textContent = msg;
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}
function saveProfile() {
    const fn = document.getElementById('firstName').value.trim();
    if (!fn) { alert('Nama tidak boleh kosong!'); return; }
    showToast('Profil berhasil disimpan!');
}
function changePassword() {
    const op = document.getElementById('oldPass').value;
    const np = document.getElementById('newPass').value;
    const cp = document.getElementById('confirmPass').value;
    if (!op || !np || !cp) { alert('Lengkapi semua field password!'); return; }
    if (np !== cp) { alert('Konfirmasi password tidak cocok!'); return; }
    if (np.length < 8) { alert('Password baru minimal 8 karakter!'); return; }
    document.getElementById('oldPass').value = '';
    document.getElementById('newPass').value = '';
    document.getElementById('confirmPass').value = '';
    showToast('Password berhasil diperbarui!');
}
</script>
</body>
</html>
