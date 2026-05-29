/**
 * ITacademy — Session Inactivity Manager
 * 
 * Konfigurasi:
 *   TIMEOUT_MENIT  : Total durasi tidak aktif sebelum auto-logout (harus sama dengan PHP: 30 menit)
 *   WARNING_MENIT  : Menit sebelum timeout untuk tampilkan peringatan
 * 
 * Cara kerja:
 *   1. Setiap mouse/keyboard/scroll/touch = reset timer.
 *   2. Di (TIMEOUT - WARNING) menit → tampil modal countdown.
 *   3. Di TIMEOUT menit → redirect ke ?page=login&timeout=1.
 */

(function () {
    const TIMEOUT_MENIT = 30;       // harus sinkron dengan $batas_maksimal di authController.php (1800 detik)
    const WARNING_MENIT = 3;        // tampilkan peringatan 3 menit sebelum logout

    const TIMEOUT_MS    = TIMEOUT_MENIT * 60 * 1000;
    const WARNING_MS    = WARNING_MENIT * 60 * 1000;
    const WARNING_DETIK = WARNING_MENIT * 60;

    let timerLogout;
    let timerWarning;
    let timerCountdown;
    let warningShown  = false;
    let countdownSisa = WARNING_DETIK;

    // ── Buat elemen modal warning jika belum ada ──
    function buatModalWarning() {
        if (document.getElementById('session-warning-modal')) return;

        const overlay = document.createElement('div');
        overlay.id    = 'session-warning-modal';
        overlay.style.cssText = `
            display:none; position:fixed; inset:0; z-index:99999;
            background:rgba(0,0,0,0.65); backdrop-filter:blur(6px);
            align-items:center; justify-content:center;
        `;

        overlay.innerHTML = `
            <div style="
                background: var(--bg-card, #1a1f2e);
                border: 1px solid var(--border, #2a3146);
                border-radius: 16px;
                padding: 36px 32px;
                max-width: 420px;
                width: 90%;
                text-align: center;
                box-shadow: 0 24px 64px rgba(0,0,0,0.5);
                animation: fadeUp 0.3s ease;
            ">
                <div style="font-size:48px; margin-bottom:16px;">⏳</div>
                <div style="font-size:20px; font-weight:700; color: var(--text-primary, #fff); margin-bottom:8px;">
                    Sesi Hampir Berakhir
                </div>
                <p style="font-size:14px; color: var(--text-secondary, #9aa3b5); line-height:1.7; margin-bottom:20px;">
                    Kamu tidak melakukan aktivitas selama beberapa saat.<br>
                    Sesi akan otomatis berakhir dalam:
                </p>
                <div id="session-countdown" style="
                    font-size: 42px;
                    font-weight: 800;
                    color: #f59e0b;
                    letter-spacing: 2px;
                    margin-bottom: 24px;
                    font-variant-numeric: tabular-nums;
                ">3:00</div>
                <div style="display:flex; gap:12px; justify-content:center;">
                    <button id="session-stay-btn" style="
                        flex:1; padding:12px 0;
                        background: var(--accent-blue, #3b82f6);
                        color: white; border: none; border-radius:10px;
                        font-size:14px; font-weight:700; cursor:pointer;
                        transition: opacity .2s;
                    " onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        Ya, Saya Masih Di Sini
                    </button>
                    <button id="session-logout-btn" style="
                        flex:0.6; padding:12px 0;
                        background: transparent;
                        color: var(--text-secondary, #9aa3b5);
                        border: 1px solid var(--border, #2a3146);
                        border-radius:10px; font-size:14px;
                        font-weight:600; cursor:pointer;
                        transition: color .2s;
                    " onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color=''">
                        Keluar Sekarang
                    </button>
                </div>
            </div>
            <style>
                @keyframes fadeUp {
                    from { opacity:0; transform:translateY(16px); }
                    to   { opacity:1; transform:translateY(0); }
                }
            </style>
        `;

        document.body.appendChild(overlay);

        document.getElementById('session-stay-btn').addEventListener('click', function () {
            resetTimer();
            sembunyikanWarning();
        });

        document.getElementById('session-logout-btn').addEventListener('click', function () {
            logoutSekarang();
        });
    }

    function tampilkanWarning() {
        if (warningShown) return;
        warningShown = true;
        countdownSisa = WARNING_DETIK;
        updateCountdownDisplay();

        const modal = document.getElementById('session-warning-modal');
        if (modal) {
            modal.style.display = 'flex';
        }

        // Mulai countdown di dalam modal
        clearInterval(timerCountdown);
        timerCountdown = setInterval(function () {
            countdownSisa--;
            if (countdownSisa <= 0) {
                clearInterval(timerCountdown);
                logoutSekarang();
            } else {
                updateCountdownDisplay();
            }
        }, 1000);
    }

    function sembunyikanWarning() {
        warningShown = false;
        clearInterval(timerCountdown);
        const modal = document.getElementById('session-warning-modal');
        if (modal) modal.style.display = 'none';
    }

    function updateCountdownDisplay() {
        const el = document.getElementById('session-countdown');
        if (!el) return;
        const m = Math.floor(countdownSisa / 60);
        const s = String(countdownSisa % 60).padStart(2, '0');
        el.textContent = m + ':' + s;
        // Warna merah saat < 60 detik
        el.style.color = countdownSisa <= 60 ? '#ef4444' : '#f59e0b';
    }

    function logoutSekarang() {
        clearTimeout(timerLogout);
        clearTimeout(timerWarning);
        clearInterval(timerCountdown);
        // Redirect ke logout dengan flag timeout
        const base = window.itAcademyBaseUrl || '';
        window.location.href = base + '/index.php?page=logout&timeout=1';
    }

    function resetTimer() {
        clearTimeout(timerLogout);
        clearTimeout(timerWarning);

        // Set timer warning
        timerWarning = setTimeout(function () {
            tampilkanWarning();
        }, TIMEOUT_MS - WARNING_MS);

        // Set timer logout final (fallback — PHP sudah handle di server)
        timerLogout = setTimeout(function () {
            logoutSekarang();
        }, TIMEOUT_MS);

        // Sembunyikan warning jika sedang tampil dan user aktif kembali
        if (warningShown) {
            sembunyikanWarning();
        }
    }

    // ── Inisialisasi ──
    function init() {
        buatModalWarning();
        resetTimer();

        // Daftarkan event listener aktivitas user
        const events = ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart', 'click'];
        events.forEach(function (evt) {
            document.addEventListener(evt, resetTimer, { passive: true });
        });
    }

    // Tunggu DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
