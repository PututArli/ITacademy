<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Proyek - ITacademy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .tugas-layout { display: grid; grid-template-columns: 1fr 340px; gap: 20px; }
        @media (max-width: 900px) { .tugas-layout { grid-template-columns: 1fr; } }

        .upload-zone { border: 2px dashed rgba(59,130,246,0.3); border-radius: 16px; padding: 48px 24px; text-align: center; cursor: pointer; transition: var(--transition); background: rgba(59,130,246,0.02); }
        .upload-zone:hover, .upload-zone.drag { border-color: var(--accent-blue); background: rgba(59,130,246,0.06); }
        .upload-icon { font-size: 48px; margin-bottom: 14px; }
        .upload-title { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
        .upload-hint { font-size: 13px; color: var(--text-muted); }
        .upload-input { display: none; }

        .file-preview { background: var(--bg-card); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; padding: 16px 18px; display: flex; align-items: center; gap: 14px; margin-top: 14px; }
        .file-icon { width: 42px; height: 42px; border-radius: 10px; background: rgba(16,185,129,0.15); display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .file-name { font-size: 14px; font-weight: 600; }
        .file-size { font-size: 12px; color: var(--text-muted); }
        .file-remove { margin-left: auto; color: #ef4444; cursor: pointer; font-size: 18px; opacity: 0.7; transition: var(--transition); }
        .file-remove:hover { opacity: 1; }

        .req-list { list-style: none; display: flex; flex-direction: column; gap: 8px; margin: 16px 0; }
        .req-item { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: var(--text-secondary); line-height: 1.5; }
        .req-check { color: #10b981; flex-shrink: 0; margin-top: 1px; }

        .history-item { background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 16px 18px; margin-bottom: 10px; transition: var(--transition); }
        .history-item:hover { border-color: var(--border-accent); }
        .history-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; flex-wrap: wrap; margin-bottom: 10px; }
        .history-title { font-size: 14px; font-weight: 600; }
        .history-meta { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
        .history-feedback { font-size: 13px; color: var(--text-secondary); line-height: 1.6; padding: 12px; background: rgba(59,130,246,0.05); border: 1px solid rgba(59,130,246,0.12); border-radius: 8px; }
        .feedback-by { font-size: 11px; font-weight: 700; color: var(--accent-blue); margin-bottom: 4px; }

        .mentor-box { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; }
        .mentor-head { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
        .mentor-stat { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border); font-size: 13px; }
        .mentor-stat:last-child { border-bottom: none; }
        .mentor-stat-label { color: var(--text-muted); }
        .mentor-stat-val { font-weight: 600; }

        .step-track { display: flex; flex-direction: column; gap: 0; }
        .step-track-item { display: flex; gap: 14px; }
        .step-track-left { display: flex; flex-direction: column; align-items: center; }
        .step-dot { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; }
        .step-dot.done { background: #10b981; color: white; }
        .step-dot.wait { background: rgba(245,158,11,0.2); border: 2px solid var(--accent-gold); color: var(--accent-gold); }
        .step-dot.pending { background: var(--glass); border: 2px solid var(--border); color: var(--text-muted); }
        .step-line { width: 2px; flex: 1; background: var(--border); min-height: 20px; margin: 4px 0; }
        .step-line.done { background: #10b981; }
        .step-body { padding-bottom: 20px; }
        .step-sname { font-size: 14px; font-weight: 600; margin-bottom: 2px; }
        .step-sdesc { font-size: 12px; color: var(--text-muted); }
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
            <a href="dashboard.php" class="nav-item"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="materi.php" class="nav-item"><span class="nav-icon">📖</span> Materi</a>
            <a href="kuis.php" class="nav-item"><span class="nav-icon">✔</span> Kuis</a>
            <a href="tugas.php" class="nav-item active"><span class="nav-icon">📤</span> Tugas Proyek</a>
            <a href="sertifikat.php" class="nav-item"><span class="nav-icon">🏅</span> Sertifikat</a>
            <div class="nav-label">Akun</div>
            <a href="profil.php" class="nav-item"><span class="nav-icon">👤</span> Profil</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">RF</div>
                <div><div class="user-name">Rafael</div><div class="user-role">Premium</div></div>
                <a href="login.php" class="user-logout" title="Keluar">←</a>
            </div>
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">Tugas Proyek</div>
            <div class="topbar-actions">
                <span class="badge badge-gold">Premium</span>
                <div class="user-avatar">RF</div>
            </div>
        </div>

        <div class="page-content">
            <div class="tugas-layout">
                <div>
                    <div class="section-header">
                        <div class="section-title">Kirim Tugas Proyek</div>
                    </div>

                    <div id="tugasForm" style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:24px;">
                        <div style="font-size:16px;font-weight:700;margin-bottom:4px;">Landing Page Portfolio</div>
                        <div style="font-size:13px;color:var(--text-secondary);margin-bottom:20px;">Proyek Akhir · Modul 1–3 Web Development</div>

                        <div class="form-group">
                            <label class="form-label">Judul Proyek</label>
                            <input type="text" class="form-input" placeholder="cth: Landing Page Portfolio Rafael" id="judulInput">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Deskripsi / Catatan untuk Mentor</label>
                            <textarea class="form-input" rows="3" placeholder="Jelaskan apa yang kamu buat, teknologi yang dipakai, dan bagian yang ingin dikomentari mentor..." id="descInput" style="resize:vertical;"></textarea>
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

                        <div style="background:rgba(59,130,246,0.05);border:1px solid rgba(59,130,246,0.15);border-radius:10px;padding:14px;margin-bottom:18px;">
                            <div style="font-size:13px;font-weight:600;color:var(--accent-blue);margin-bottom:8px;">Persyaratan Proyek</div>
                            <ul class="req-list">
                                <li class="req-item"><span class="req-check">✓</span> Halaman HTML minimal 2 section berbeda (Hero, About, dll)</li>
                                <li class="req-item"><span class="req-check">✓</span> Menggunakan Flexbox atau Grid untuk layout</li>
                                <li class="req-item"><span class="req-check">✓</span> Desain responsif (bisa dilihat di mobile & desktop)</li>
                                <li class="req-item"><span class="req-check">✓</span> File CSS terpisah dari HTML (bukan inline)</li>
                                <li class="req-item"><span class="req-check">✓</span> Sertakan file README.txt berisi nama & penjelasan singkat</li>
                            </ul>
                        </div>

                        <button class="btn btn-primary btn-full btn-lg" onclick="submitTugas()">Kirim Tugas ke Mentor</button>
                    </div>

                    <div class="section-header" style="margin-top:28px;">
                        <div class="section-title">Riwayat Pengiriman</div>
                    </div>

                    <div class="history-item">
                        <div class="history-top">
                            <div>
                                <div class="history-title">Landing Page Portfolio</div>
                                <div class="history-meta">Dikirim: 10 Mei 2025, 14:32 &nbsp;·&nbsp; portfolio-rafael.zip (2.4 MB)</div>
                            </div>
                            <span class="badge badge-gold">⏳ Direview</span>
                        </div>
                        <div class="history-feedback">
                            <div class="feedback-by">Mentor: Budi Santoso</div>
                            File diterima dengan baik. Sedang dalam proses review. Saya akan memberikan feedback dalam 1-2 hari kerja. Pastikan file zip sudah include semua asset gambar ya.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="section-header"><div class="section-title">Status Sertifikasi</div></div>
                    <div style="margin-bottom:20px;">
                        <div class="step-track">
                            <div class="step-track-item">
                                <div class="step-track-left"><div class="step-dot done">✓</div><div class="step-line done"></div></div>
                                <div class="step-body"><div class="step-sname">Selesaikan Materi</div><div class="step-sdesc">8/12 modul selesai</div></div>
                            </div>
                            <div class="step-track-item">
                                <div class="step-track-left"><div class="step-dot done">✓</div><div class="step-line done"></div></div>
                                <div class="step-body"><div class="step-sname">Lulus Kuis</div><div class="step-sdesc">2/3 kuis tersedia lulus</div></div>
                            </div>
                            <div class="step-track-item">
                                <div class="step-track-left"><div class="step-dot done">✓</div><div class="step-line"></div></div>
                                <div class="step-body"><div class="step-sname">Kirim Tugas Proyek</div><div class="step-sdesc">portfolio-rafael.zip dikirim</div></div>
                            </div>
                            <div class="step-track-item">
                                <div class="step-track-left"><div class="step-dot wait">⏳</div><div class="step-line"></div></div>
                                <div class="step-body"><div class="step-sname">Review Mentor</div><div class="step-sdesc">Menunggu persetujuan mentor</div></div>
                            </div>
                            <div class="step-track-item">
                                <div class="step-track-left"><div class="step-dot pending">5</div></div>
                                <div class="step-body"><div class="step-sname" style="color:var(--text-muted);">Sertifikat Diterbitkan</div><div class="step-sdesc">Setelah mentor approve</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="section-header"><div class="section-title">Mentor Kamu</div></div>
                    <div class="mentor-box">
                        <div class="mentor-head">
                            <div class="user-avatar" style="width:44px;height:44px;font-size:15px;">BS</div>
                            <div>
                                <div style="font-size:15px;font-weight:700;">Budi Santoso</div>
                                <div style="font-size:12px;color:var(--accent-blue);">Frontend Developer</div>
                            </div>
                        </div>
                        <div class="mentor-stat"><span class="mentor-stat-label">Tugas direvew</span><span class="mentor-stat-val">42 tugas</span></div>
                        <div class="mentor-stat"><span class="mentor-stat-label">Rata-rata waktu review</span><span class="mentor-stat-val">1.5 hari</span></div>
                        <div class="mentor-stat"><span class="mentor-stat-label">Rating</span><span class="mentor-stat-val">⭐ 4.8 / 5.0</span></div>
                    </div>
                </div>
            </div>

            <div id="successMsg" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.7);z-index:1000;align-items:center;justify-content:center;" onclick="this.style.display='none'">
                <div style="background:var(--bg-card);border:1px solid rgba(16,185,129,0.3);border-radius:24px;padding:48px;text-align:center;max-width:420px;margin:20px;" onclick="event.stopPropagation()">
                    <div style="font-size:52px;margin-bottom:14px;">🚀</div>
                    <div style="font-size:20px;font-weight:700;margin-bottom:8px;">Tugas Berhasil Dikirim!</div>
                    <p style="font-size:14px;color:var(--text-secondary);margin-bottom:24px;line-height:1.7;">Mentor akan mereview proyekmu dalam 1–2 hari kerja. Kamu akan mendapat notifikasi setelah ada feedback.</p>
                    <button class="btn btn-primary btn-full" onclick="document.getElementById('successMsg').style.display='none'">Oke, Mengerti</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handleFile(file) {
    if (!file) return;
    document.getElementById('filePreview').style.display = 'flex';
    document.getElementById('uploadZone').style.display = 'none';
    document.getElementById('fileName').textContent = file.name;
    const mb = (file.size / 1024 / 1024).toFixed(2);
    document.getElementById('fileSize').textContent = mb + ' MB';
}
function handleDrop(e) {
    e.preventDefault();
    document.getElementById('uploadZone').classList.remove('drag');
    const file = e.dataTransfer.files[0];
    if (file) handleFile(file);
}
function removeFile() {
    document.getElementById('filePreview').style.display = 'none';
    document.getElementById('uploadZone').style.display = 'block';
    document.getElementById('fileInput').value = '';
}
function submitTugas() {
    const judul = document.getElementById('judulInput').value.trim();
    const file = document.getElementById('fileInput').files[0];
    if (!judul) { alert('Isi judul proyek dulu ya!'); return; }
    if (!file) { alert('Upload file proyekmu dulu!'); return; }
    document.getElementById('successMsg').style.display = 'flex';
}
</script>
</body>
</html>
