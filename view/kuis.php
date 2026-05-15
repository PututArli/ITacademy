<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Latihan - ITacademy</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .kuis-wrap { max-width: 720px; margin: 0 auto; padding: 28px; }
        .kuis-header { background: linear-gradient(135deg, rgba(139,92,246,0.12), rgba(59,130,246,0.08)); border: 1px solid rgba(139,92,246,0.25); border-radius: var(--radius); padding: 24px 28px; margin-bottom: 28px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .kuis-title { font-size: 20px; font-weight: 700; margin-bottom: 4px; }
        .kuis-meta { font-size: 13px; color: var(--text-secondary); }
        .timer { background: var(--bg-card); border: 1px solid var(--border); border-radius: 10px; padding: 10px 18px; text-align: center; }
        .timer-num { font-size: 22px; font-weight: 800; color: var(--accent-purple); }
        .timer-label { font-size: 11px; color: var(--text-muted); }

        .question-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 24px 28px; margin-bottom: 16px; }
        .q-num { font-size: 12px; font-weight: 700; color: var(--accent-purple); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .q-text { font-size: 16px; font-weight: 600; margin-bottom: 18px; line-height: 1.5; }
        .q-options { display: flex; flex-direction: column; gap: 8px; }
        .q-option { display: flex; align-items: center; gap: 12px; padding: 13px 16px; border: 1.5px solid var(--border); border-radius: 10px; cursor: pointer; transition: var(--transition); font-size: 14px; color: var(--text-secondary); }
        .q-option:hover { border-color: rgba(139,92,246,0.4); background: rgba(139,92,246,0.05); color: var(--text-primary); }
        .q-option.selected { border-color: var(--accent-purple); background: rgba(139,92,246,0.1); color: var(--text-primary); }
        .q-option.correct { border-color: #10b981; background: rgba(16,185,129,0.1); color: #10b981; }
        .q-option.wrong { border-color: #ef4444; background: rgba(239,68,68,0.08); color: #ef4444; }
        .q-letter { width: 28px; height: 28px; border-radius: 8px; background: var(--glass); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; flex-shrink: 0; }
        .q-option.selected .q-letter { background: var(--accent-purple); border-color: var(--accent-purple); color: white; }
        .q-option.correct .q-letter { background: #10b981; border-color: #10b981; color: white; }
        .q-option.wrong .q-letter { background: #ef4444; border-color: #ef4444; color: white; }

        .progress-bar-wrap { background: var(--border); border-radius: 4px; height: 6px; margin-bottom: 6px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, var(--accent-purple), var(--accent-blue)); border-radius: 4px; transition: width 0.5s ease; }

        .result-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 40px; text-align: center; display: none; }
        .result-icon { font-size: 52px; margin-bottom: 16px; }
        .result-score { font-size: 48px; font-weight: 800; background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px; }
        .result-label { font-size: 15px; color: var(--text-secondary); margin-bottom: 24px; }

        .kuis-list { display: flex; flex-direction: column; gap: 10px; }
        .kuis-item { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px 22px; display: flex; align-items: center; gap: 14px; transition: var(--transition); }
        .kuis-item:hover { border-color: var(--border-accent); }
        .kuis-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
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
            <a href="kuis.php" class="nav-item active"><span class="nav-icon">✔</span> Kuis</a>
            <a href="tugas.php" class="nav-item"><span class="nav-icon">📤</span> Tugas Proyek</a>
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
            <div class="topbar-title" id="topbarTitle">Kuis Latihan</div>
            <div class="topbar-actions">
                <span class="badge badge-gold">Premium</span>
                <div class="user-avatar">RF</div>
            </div>
        </div>

        <div class="page-content" id="listView">
            <div style="margin-bottom:20px;">
                <h2 style="font-size:18px;font-weight:700;margin-bottom:4px;">Kuis Tersedia</h2>
                <p style="font-size:14px;color:var(--text-secondary);">Selesaikan kuis setelah menonton semua video di modul tersebut.</p>
            </div>
            <div class="kuis-list">
                <div class="kuis-item">
                    <div class="kuis-icon" style="background:rgba(16,185,129,0.15);">🌐</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 1: HTML Dasar</div>
                        <div style="font-size:13px;color:var(--text-muted);">5 soal · Skor kamu: 92/100</div>
                    </div>
                    <span class="badge badge-green">Lulus ✓</span>
                    <button class="btn btn-ghost" style="font-size:13px;" onclick="startKuis(1,'Kuis Modul 1: HTML Dasar')">Ulangi</button>
                </div>
                <div class="kuis-item">
                    <div class="kuis-icon" style="background:rgba(16,185,129,0.15);">🎨</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 2: CSS Dasar</div>
                        <div style="font-size:13px;color:var(--text-muted);">5 soal · Skor kamu: 88/100</div>
                    </div>
                    <span class="badge badge-green">Lulus ✓</span>
                    <button class="btn btn-ghost" style="font-size:13px;" onclick="startKuis(2,'Kuis Modul 2: CSS Dasar')">Ulangi</button>
                </div>
                <div class="kuis-item">
                    <div class="kuis-icon" style="background:rgba(59,130,246,0.15);">📐</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 3: Flexbox & Grid</div>
                        <div style="font-size:13px;color:var(--text-muted);">5 soal · Belum dikerjakan</div>
                    </div>
                    <span class="badge badge-blue">Tersedia</span>
                    <button class="btn btn-primary" style="font-size:13px;" onclick="startKuis(3,'Kuis Modul 3: Flexbox & Grid')">Mulai</button>
                </div>
                <div class="kuis-item" style="opacity:0.5;">
                    <div class="kuis-icon" style="background:var(--glass);">🔒</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 4: JavaScript Dasar</div>
                        <div style="font-size:13px;color:var(--text-muted);">Selesaikan modul 4 dulu</div>
                    </div>
                    <span class="badge" style="color:var(--text-muted);">Terkunci</span>
                </div>
                <div class="kuis-item" style="opacity:0.5;">
                    <div class="kuis-icon" style="background:var(--glass);">🔒</div>
                    <div style="flex:1;">
                        <div style="font-size:15px;font-weight:600;margin-bottom:2px;">Kuis Modul 5: DOM & Event</div>
                        <div style="font-size:13px;color:var(--text-muted);">Selesaikan modul 5 dulu</div>
                    </div>
                    <span class="badge" style="color:var(--text-muted);">Terkunci</span>
                </div>
            </div>
        </div>

        <div class="kuis-wrap" id="kuisView" style="display:none;">
            <div class="kuis-header">
                <div>
                    <div class="kuis-title" id="kuisName">—</div>
                    <div class="kuis-meta" id="kuisMeta">5 soal pilihan ganda</div>
                    <div style="margin-top:10px;">
                        <div class="progress-bar-wrap"><div class="progress-fill" id="progressFill" style="width:20%;"></div></div>
                        <div style="font-size:12px;color:var(--text-muted);" id="progressLabel">Soal 1 dari 5</div>
                    </div>
                </div>
                <div class="timer"><div class="timer-num" id="timerNum">09:47</div><div class="timer-label">Sisa Waktu</div></div>
            </div>

            <div id="questionsContainer"></div>

            <div style="display:flex;gap:10px;margin-top:8px;" id="navButtons">
                <button class="btn btn-ghost" id="prevBtn" onclick="prevQ()" style="flex:1;" disabled>← Sebelumnya</button>
                <button class="btn btn-primary" id="nextBtn" onclick="nextQ()" style="flex:1;">Berikutnya →</button>
            </div>
            <div style="margin-top:10px;">
                <button class="btn btn-outline btn-full" onclick="cancelKuis()">Batalkan & Kembali</button>
            </div>

            <div class="result-card" id="resultCard">
                <div class="result-icon" id="resultIcon">🎉</div>
                <div class="result-score" id="resultScore">—</div>
                <div class="result-label" id="resultLabel">—</div>
                <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                    <button class="btn btn-ghost" onclick="cancelKuis()">Kembali ke Daftar</button>
                    <a href="materi.php" class="btn btn-primary">Lanjut Belajar →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const questions = [
    { q: "Properti CSS mana yang digunakan untuk mengaktifkan flexbox pada sebuah container?", opts: ["position: flex", "display: flex", "layout: flexbox", "flex: active"], correct: 1 },
    { q: "Properti apa yang mengatur perataan item di sepanjang sumbu utama (main axis) pada flexbox?", opts: ["align-items", "align-content", "justify-content", "flex-align"], correct: 2 },
    { q: "Nilai default dari 'flex-direction' adalah?", opts: ["column", "row-reverse", "row", "column-reverse"], correct: 2 },
    { q: "Properti CSS Grid mana yang digunakan untuk mendefinisikan kolom pada grid?", opts: ["grid-template-columns", "grid-columns", "column-template", "grid-col"], correct: 0 },
    { q: "Apa fungsi dari properti 'flex-wrap: wrap'?", opts: ["Menghapus semua item flex", "Mengizinkan item pindah ke baris baru jika tidak cukup ruang", "Membungkus teks di dalam item", "Membuat item menjadi vertikal"], correct: 1 }
];

let current = 0, answers = Array(5).fill(null), timerInterval;

function startKuis(num, name) {
    document.getElementById('listView').style.display = 'none';
    document.getElementById('kuisView').style.display = 'block';
    document.getElementById('kuisName').textContent = name;
    current = 0; answers = Array(5).fill(null);
    renderQ(); startTimer(600);
}

function renderQ() {
    const q = questions[current];
    document.getElementById('progressFill').style.width = ((current+1)/5*100)+'%';
    document.getElementById('progressLabel').textContent = `Soal ${current+1} dari 5`;
    document.getElementById('prevBtn').disabled = current === 0;
    document.getElementById('nextBtn').textContent = current === 4 ? 'Selesai & Kirim' : 'Berikutnya →';
    document.getElementById('nextBtn').onclick = current === 4 ? submitKuis : nextQ;
    document.getElementById('questionsContainer').innerHTML = `
        <div class="question-card">
            <div class="q-num">Soal ${current+1} dari 5</div>
            <div class="q-text">${q.q}</div>
            <div class="q-options">
                ${q.opts.map((o,i) => `
                    <div class="q-option ${answers[current]===i?'selected':''}" onclick="selectAnswer(${i})">
                        <div class="q-letter">${['A','B','C','D'][i]}</div>
                        ${o}
                    </div>`).join('')}
            </div>
        </div>`;
}

function selectAnswer(i) {
    answers[current] = i;
    renderQ();
}

function nextQ() { if(current < 4) { current++; renderQ(); } }
function prevQ() { if(current > 0) { current--; renderQ(); } }

function submitKuis() {
    clearInterval(timerInterval);
    const correct = answers.filter((a,i) => a === questions[i].correct).length;
    const score = correct * 20;
    document.getElementById('questionsContainer').style.display = 'none';
    document.getElementById('navButtons').style.display = 'none';
    document.querySelector('.kuis-header').style.display = 'none';
    const rc = document.getElementById('resultCard');
    rc.style.display = 'block';
    document.getElementById('resultScore').textContent = score + '/100';
    document.getElementById('resultIcon').textContent = score >= 75 ? '🎉' : '😅';
    document.getElementById('resultLabel').textContent = score >= 75
        ? `Selamat! Kamu lulus dengan ${correct} dari 5 jawaban benar.`
        : `Kamu menjawab ${correct} dari 5 benar. Nilai minimum lulus 75. Coba lagi!`;
}

function cancelKuis() {
    document.getElementById('listView').style.display = 'block';
    document.getElementById('kuisView').style.display = 'none';
    document.getElementById('questionsContainer').style.display = 'block';
    document.getElementById('navButtons').style.display = 'flex';
    document.querySelector('.kuis-header').style.display = 'flex';
    document.getElementById('resultCard').style.display = 'none';
    clearInterval(timerInterval);
}

function startTimer(sec) {
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        if (sec <= 0) { clearInterval(timerInterval); submitKuis(); return; }
        sec--;
        const m = String(Math.floor(sec/60)).padStart(2,'0');
        const s = String(sec%60).padStart(2,'0');
        document.getElementById('timerNum').textContent = `${m}:${s}`;
        if (sec <= 60) document.getElementById('timerNum').style.color = '#ef4444';
    }, 1000);
}
</script>
</body>
</html>
