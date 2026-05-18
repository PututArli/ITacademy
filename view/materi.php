<?php
require_once 'model/koneksi.php';

if (!isset($_SESSION['nama'])) {
    header("Location: " . BASEURL . "/index.php?page=login");
    exit();
}

$nama_user = $_SESSION['nama'];
$ambil_user = mysqli_query($conn, "SELECT * FROM users WHERE nama = '$nama_user'");
$data = mysqli_fetch_assoc($ambil_user);
$role_user = isset($data['role']) ? $data['role'] : 'free';
$status_keanggotaan = "Siswa " . ucfirst($role_user);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Belajar - ITacademy</title>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/style.css">
    <style>
        .materi-layout { display: grid; grid-template-columns: 300px 1fr; gap: 20px; height: calc(100vh - 64px); overflow: hidden; }
        .module-sidebar { background: var(--bg-secondary); border-right: 1px solid var(--border); overflow-y: auto; padding: 20px 12px; }
        .module-sidebar-title { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; padding: 0 8px; margin-bottom: 10px; }
        .mod-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; cursor: pointer; transition: var(--transition); margin-bottom: 2px; }
        .mod-item:hover { background: var(--glass); }
        .mod-item.active { background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(139,92,246,0.1)); border: 1px solid rgba(59,130,246,0.2); }
        .mod-dot { width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; }
        .mod-dot.done { background: rgba(16,185,129,0.2); color: #10b981; }
        .mod-dot.active { background: rgba(59,130,246,0.2); color: var(--accent-blue); }
        .mod-dot.locked { background: var(--glass); color: var(--text-muted); border: 1px solid var(--border); }
        .mod-label { font-size: 13px; font-weight: 500; flex: 1; }
        .mod-label.locked { color: var(--text-muted); }

        .video-area { overflow-y: auto; padding: 28px; }
        .video-player { background: #000; border-radius: var(--radius); aspect-ratio: 16/9; display: flex; align-items: center; justify-content: center; margin-bottom: 24px; position: relative; overflow: hidden; }
        .video-overlay { text-align: center; }
        .play-btn { width: 72px; height: 72px; border-radius: 50%; background: rgba(59,130,246,0.9); display: flex; align-items: center; justify-content: center; font-size: 28px; cursor: pointer; transition: var(--transition); margin: 0 auto 14px; }
        .play-btn:hover { transform: scale(1.1); background: var(--accent-blue); }
        .video-title-overlay { font-size: 16px; font-weight: 600; color: rgba(255,255,255,0.8); }

        .video-info { margin-bottom: 24px; }
        .video-title { font-size: 22px; font-weight: 700; margin-bottom: 8px; }
        .video-meta { display: flex; align-items: center; gap: 16px; font-size: 13px; color: var(--text-secondary); flex-wrap: wrap; }

        .video-list-title { font-size: 15px; font-weight: 700; margin-bottom: 12px; }
        .video-item { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; cursor: pointer; transition: var(--transition); border: 1px solid transparent; }
        .video-item:hover { background: var(--bg-card); border-color: var(--border); }
        .video-item.active { background: var(--bg-card); border-color: var(--border-accent); }
        .video-thumb { width: 80px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #0f2942, #163a5f); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
        .video-item-title { font-size: 13px; font-weight: 600; margin-bottom: 3px; }
        .video-item-dur { font-size: 12px; color: var(--text-muted); }
        .video-done { margin-left: auto; color: #10b981; font-size: 16px; }

        .materi-content-tab { display: flex; gap: 2px; margin-bottom: 20px; background: var(--bg-secondary); border-radius: 10px; padding: 4px; width: fit-content; }
        .tab-btn { padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; color: var(--text-secondary); transition: var(--transition); border: none; background: transparent; }
        .tab-btn.active { background: var(--bg-card); color: var(--text-primary); }
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
            <a href="<?= BASEURL ?>/index.php?page=dashboard" class="nav-item"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="<?= BASEURL ?>/index.php?page=materi" class="nav-item active"><span class="nav-icon">📖</span> Materi Belajar</a>
            <a href="<?= BASEURL ?>/index.php?page=kuis" class="nav-item"><span class="nav-icon">🧩</span> Kuis Latihan</a>
            <a href="<?= BASEURL ?>/index.php?page=tugas" class="nav-item"><span class="nav-icon">📁</span> Tugas Proyek</a>
            <a href="<?= BASEURL ?>/index.php?page=sertifikat" class="nav-item"><span class="nav-icon">🎓</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="<?= BASEURL ?>/index.php?page=profil" class="nav-item"><span class="nav-icon">👤</span> Profil Saya</a>
            <a href="#" class="nav-item" style="color: #f87171;" onclick="bukaModalLogout(event)"><span class="nav-icon">🚪</span> Keluar</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">RF</div>
                <div><div class="user-name"><?= $nama_user; ?></div>
<div class="user-role" style="font-size: 12px; color: var(--text-muted);"><?= $status_keanggotaan; ?></div></div>
                <a href="#" class="user-logout" title="Keluar" onclick="bukaModalLogout(event)">←</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Materi Belajar</div>
            <div class="topbar-actions">
                <span class="badge badge-gold"><?= $status_keanggotaan; ?></span>
                <div class="user-avatar">RF</div>
            </div>
        </div>

        <div class="materi-layout">
            <div class="module-sidebar">
                <div class="module-sidebar-title">Modul Kursus</div>

                <div class="mod-item active">
                    <div class="mod-dot active">3</div>
                    <div class="mod-label">Flexbox & Grid</div>
                    <span class="badge badge-blue" style="font-size:10px;padding:2px 7px;">Aktif</span>
                </div>
                <div class="mod-item">
                    <div class="mod-dot done">✓</div>
                    <div class="mod-label">Pengenalan HTML</div>
                </div>
                <div class="mod-item">
                    <div class="mod-dot done">✓</div>
                    <div class="mod-label">CSS Dasar & Styling</div>
                </div>
                <div style="border-top: 1px solid var(--border); margin: 10px 0;"></div>
                <div class="mod-item">
                    <div class="mod-dot locked">4</div>
                    <div class="mod-label locked">JavaScript Dasar</div>
                </div>
                <div class="mod-item">
                    <div class="mod-dot locked">5</div>
                    <div class="mod-label locked">DOM & Event</div>
                </div>
                <div class="mod-item">
                    <div class="mod-dot locked">6</div>
                    <div class="mod-label locked">Fetch API</div>
                </div>
                <div class="mod-item">
                    <div class="mod-dot locked">7</div>
                    <div class="mod-label locked">Proyek Akhir</div>
                </div>
            </div>

            <div class="video-area">
                <div class="video-player">
                    <div class="video-overlay">
                        <div class="play-btn" onclick="this.innerHTML='⏸'">▶</div>
                        <div class="video-title-overlay">CSS Flexbox — Konsep Dasar</div>
                    </div>
                </div>

                <div class="video-info">
                    <h1 class="video-title">CSS Flexbox & Grid Layout</h1>
                    <div class="video-meta">
                        <span>📖 Modul 3 · Video 1 dari 4</span>
                        <span>⏱ 12 menit</span>
                        <span>👤 Budi Santoso</span>
                        <span class="badge badge-blue">Sedang Ditonton</span>
                    </div>
                </div>

                <div class="materi-content-tab">
                    <button class="tab-btn active" onclick="switchTab(this,'video')">Video</button>
                    <button class="tab-btn" onclick="switchTab(this,'materi')">Materi Teks</button>
                    <button class="tab-btn" onclick="switchTab(this,'kuis')">Kuis Modul</button>
                </div>

                <div id="tab-video">
                    <div class="video-list-title">Video dalam Modul Ini</div>
                    <div class="video-item active">
                        <div class="video-thumb">📹</div>
                        <div>
                            <div class="video-item-title">1. Konsep Dasar Flexbox</div>
                            <div class="video-item-dur">12 menit</div>
                        </div>
                        <span style="margin-left:auto;color:var(--accent-blue);font-size:12px;font-weight:600;">▶ Sedang</span>
                    </div>
                    <div class="video-item">
                        <div class="video-thumb">📹</div>
                        <div>
                            <div class="video-item-title">2. justify-content & align-items</div>
                            <div class="video-item-dur">15 menit</div>
                        </div>
                        <span class="video-done">✓</span>
                    </div>
                    <div class="video-item">
                        <div class="video-thumb">📹</div>
                        <div>
                            <div class="video-item-title">3. CSS Grid Dasar</div>
                            <div class="video-item-dur">18 menit</div>
                        </div>
                        <span style="margin-left:auto;font-size:12px;color:var(--text-muted);">Belum</span>
                    </div>
                    <div class="video-item">
                        <div class="video-thumb">📹</div>
                        <div>
                            <div class="video-item-title">4. Layout Responsif dengan Grid</div>
                            <div class="video-item-dur">20 menit</div>
                        </div>
                        <span style="margin-left:auto;font-size:12px;color:var(--text-muted);">Belum</span>
                    </div>

                    <div style="display:flex;gap:10px;margin-top:20px;">
                        <button class="btn btn-ghost" style="flex:1;">← Video Sebelumnya</button>
                        <button class="btn btn-primary" style="flex:1;">Video Berikutnya →</button>
                    </div>
                    <div style="margin-top:12px;text-align:center;">
                        <a href="<?= BASEURL ?>/index.php?page=kuis" class="btn btn-outline btn-full">Selesai Modul ini — Kerjakan Kuis ✔</a>
                    </div>
                </div>

                <div id="tab-materi" style="display:none;">
                    <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;font-size:14px;line-height:1.9;color:var(--text-secondary);">
                        <h3 style="color:var(--text-primary);margin-bottom:12px;font-size:17px;">Apa itu Flexbox?</h3>
                        <p>Flexbox (Flexible Box) adalah model tata letak CSS yang memungkinkan kamu mengatur elemen-elemen di dalam sebuah container secara fleksibel — baik horizontal maupun vertikal.</p>
                        <br>
                        <h3 style="color:var(--text-primary);margin-bottom:12px;font-size:17px;">Properti Utama Flexbox</h3>
                        <ul style="padding-left:18px;display:flex;flex-direction:column;gap:8px;">
                            <li><code style="background:rgba(59,130,246,0.1);padding:2px 8px;border-radius:5px;color:var(--accent-blue);">display: flex</code> — Mengaktifkan flexbox pada container.</li>
                            <li><code style="background:rgba(59,130,246,0.1);padding:2px 8px;border-radius:5px;color:var(--accent-blue);">flex-direction</code> — Menentukan arah susunan item (row/column).</li>
                            <li><code style="background:rgba(59,130,246,0.1);padding:2px 8px;border-radius:5px;color:var(--accent-blue);">justify-content</code> — Perataan item di sumbu utama.</li>
                            <li><code style="background:rgba(59,130,246,0.1);padding:2px 8px;border-radius:5px;color:var(--accent-blue);">align-items</code> — Perataan item di sumbu silang.</li>
                            <li><code style="background:rgba(59,130,246,0.1);padding:2px 8px;border-radius:5px;color:var(--accent-blue);">flex-wrap</code> — Mengizinkan item pindah ke baris berikutnya.</li>
                        </ul>
                        <br>
                        <div style="background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.2);border-radius:10px;padding:14px;">
                            <strong style="color:#10b981;">💡 Tips:</strong> Praktikkan langsung di browser. Buka DevTools (F12) dan coba ubah nilai properti untuk melihat efeknya secara real-time.
                        </div>
                    </div>
                    <div style="margin-top:12px;">
                        <a href="<?= BASEURL ?>/index.php?page=kuis" class="btn btn-primary btn-full">Kerjakan Kuis Modul Ini ✔</a>
                    </div>
                </div>

                <div id="tab-kuis" style="display:none;">
                    <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center;">
                        <div style="font-size:36px;margin-bottom:14px;">🧩</div>
                        <div style="font-size:17px;font-weight:700;margin-bottom:8px;">Kuis Modul 3: CSS Flexbox & Grid</div>
                        <div style="font-size:14px;color:var(--text-secondary);margin-bottom:20px;">5 soal pilihan ganda · Waktu 10 menit · Nilai minimum lulus: 75</div>
                        <a href="<?= BASEURL ?>/index.php?page=kuis?modul=3" class="btn btn-primary btn-lg">Mulai Kuis Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalLogout">
    <div class="modal-box">
        <div class="modal-icon">👋</div>
        <div class="modal-title">Yakin ingin keluar?</div>
        <div class="modal-desc">Sesi belajar kamu akan diakhiri. Kamu harus masuk kembali untuk melanjutkan.</div>
        <div class="modal-actions">
            <button class="btn btn-ghost" onclick="tutupModalLogout()">Batal</button>
            <a href="<?= BASEURL ?>/index.php?page=logout" class="btn btn-danger">Ya, Keluar</a>
        </div>
    </div>
</div>

<script>
function switchTab(el, name) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    ['video','materi','kuis'].forEach(t => {
        const el2 = document.getElementById('tab-'+t);
        if (el2) el2.style.display = t === name ? 'block' : 'none';
    });
}
function bukaModalLogout(e) {
    if (e) e.preventDefault();
    document.getElementById('modalLogout').classList.add('show');
}
function tutupModalLogout() {
    document.getElementById('modalLogout').classList.remove('show');
}
</script>
</body>
</html>