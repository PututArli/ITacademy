function bukaModalLogout(e) {
    if (e) e.preventDefault();
    const modal = document.getElementById('modalLogout');
    if (modal) modal.classList.add('show');
}
function tutupModalLogout() {
    const modal = document.getElementById('modalLogout');
    if (modal) modal.classList.remove('show');
}

function switchTab(el, name) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    ['video','materi','kuis'].forEach(t => {
        const el2 = document.getElementById('tab-'+t);
        if (el2) el2.style.display = t === name ? 'block' : 'none';
    });
}

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