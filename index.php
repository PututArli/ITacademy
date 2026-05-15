<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITacademy - Platform E-Learning Berbasis Project dan Mentorship</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time(); ?>">
    <style>
        .how-section { padding: 80px 60px; }
        .how-grid { display: flex; gap: 0; margin-top: 48px; position: relative; justify-content: center; flex-wrap: wrap; }
        .how-step { text-align: center; padding: 0 28px; flex: 1; min-width: 200px; max-width: 260px; position: relative; }
        .how-step:not(:last-child)::after { content: '→'; position: absolute; right: -8px; top: 32px; font-size: 20px; color: var(--text-muted); }
        .how-num { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; margin: 0 auto 16px; }
        .how-num.n1 { background: rgba(59,130,246,0.15); color: var(--accent-blue); }
        .how-num.n2 { background: rgba(139,92,246,0.15); color: var(--accent-purple); }
        .how-num.n3 { background: rgba(6,182,212,0.15); color: var(--accent-cyan); }
        .how-num.n4 { background: rgba(245,158,11,0.15); color: var(--accent-gold); }
        .how-title { font-size: 15px; font-weight: 700; margin-bottom: 6px; }
        .how-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; }

        .course-showcase { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 40px; }
        .showcase-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; transition: var(--transition); }
        .showcase-card:hover { transform: translateY(-4px); border-color: var(--border-accent); }
        .showcase-thumb { height: 150px; display: flex; align-items: center; justify-content: center; }
        .showcase-thumb.t1 { background: linear-gradient(135deg, #0f2942, #163a5f); }
        .showcase-thumb.t2 { background: linear-gradient(135deg, #1a1a3e, #2d1b6b); }
        .showcase-thumb.t3 { background: linear-gradient(135deg, #0f2920, #163f2e); }
        .showcase-thumb-text { text-align: center; }
        .showcase-thumb-text .icon { font-size: 36px; margin-bottom: 6px; display: block; }
        .showcase-thumb-text .label { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px; }
        .showcase-body { padding: 20px; }
        .showcase-title { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
        .showcase-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 14px; }
        .showcase-tags { display: flex; gap: 6px; flex-wrap: wrap; }
        .showcase-tag { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: var(--glass); border: 1px solid var(--border); color: var(--text-secondary); }

        .mentor-section { padding: 80px 60px; }
        .mentor-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 40px; }
        .mentor-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 24px; display: flex; gap: 16px; align-items: flex-start; transition: var(--transition); }
        .mentor-card:hover { border-color: var(--border-accent); }
        .mentor-avatar { width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: white; flex-shrink: 0; }
        .mentor-name { font-size: 15px; font-weight: 700; margin-bottom: 2px; }
        .mentor-spec { font-size: 12px; color: var(--accent-blue); margin-bottom: 6px; }
        .mentor-bio { font-size: 13px; color: var(--text-secondary); line-height: 1.5; }

        .cta-section { padding: 80px 60px; text-align: center; }
        .cta-box { background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(139,92,246,0.08)); border: 1px solid rgba(59,130,246,0.2); border-radius: 24px; padding: 60px 40px; max-width: 680px; margin: 0 auto; }
        .cta-title { font-size: 28px; font-weight: 800; margin-bottom: 12px; }
        .cta-desc { font-size: 15px; color: var(--text-secondary); margin-bottom: 28px; line-height: 1.7; max-width: 480px; margin-left: auto; margin-right: auto; }

        @media (max-width: 768px) {
            .how-step:not(:last-child)::after { display: none; }
            .how-section, .mentor-section, .cta-section { padding: 60px 20px; }
            .features-section, .pricing-section { padding: 60px 20px; }
            .landing-nav { padding: 14px 20px; }
            .landing-footer { padding: 24px 20px; }
        }
    </style>
</head>
<body>

<nav class="landing-nav" id="navbar">
    <div class="nav-logo">
        <div class="brand-icon">IT</div>
        <span class="brand-name">IT<span>academy</span></span>
    </div>
    <div class="nav-links">
        <a href="#kursus" class="btn btn-ghost" style="padding:8px 16px;">Kursus</a>
        <a href="#cara-kerja" class="btn btn-ghost" style="padding:8px 16px;">Cara Kerja</a>
        <a href="#harga" class="btn btn-ghost" style="padding:8px 16px;">Harga</a>
        <a href="login.php" class="btn btn-outline">Masuk</a>
        <a href="register.php" class="btn btn-primary">Daftar</a>
    </div>
</nav>

<section class="hero-section">
    <div class="hero-bg-glow hero-glow-1"></div>
    <div class="hero-bg-glow hero-glow-2"></div>
    <div class="hero-content">
        <h1 class="hero-title fade-up">Bangun Portofolio IT<br>dengan <span>Bimbingan Mentor</span></h1>
        <p class="hero-desc fade-up delay-1">Belajar Web Development sambil mengerjakan proyek nyata. Tugas kamu direview langsung oleh mentor — bukan dinilai otomatis oleh sistem.</p>
        <div class="hero-actions fade-up delay-2">
            <a href="register.php" class="btn btn-primary btn-lg">Mulai Belajar Gratis</a>
            <a href="#cara-kerja" class="btn btn-ghost btn-lg">Lihat Cara Kerja</a>
        </div>
    </div>
</section>

<section id="kursus" class="features-section">
    <div style="text-align:center;max-width:520px;margin:0 auto;">
        <h2 class="section-title-lg">Kursus Tersedia</h2>
        <p class="section-desc" style="margin:0 auto;">Fokus pada Web Development dasar. Setiap kursus terdiri dari materi, kuis latihan, dan tugas proyek akhir yang akan direview mentor.</p>
    </div>
    <div class="course-showcase">
        <div class="showcase-card">
            <div class="showcase-thumb t1">
                <div class="showcase-thumb-text"><span class="icon">&lt;/&gt;</span><span class="label">Modul 1–4</span></div>
            </div>
            <div class="showcase-body">
                <div class="showcase-title">HTML & CSS Dasar</div>
                <p class="showcase-desc">Pelajari struktur halaman web, styling, dan layout modern menggunakan Flexbox serta Grid. Cocok untuk pemula absolut.</p>
                <div class="showcase-tags">
                    <span class="showcase-tag">12 Video</span>
                    <span class="showcase-tag">4 Kuis</span>
                    <span class="showcase-tag">1 Proyek</span>
                </div>
            </div>
        </div>
        <div class="showcase-card">
            <div class="showcase-thumb t2">
                <div class="showcase-thumb-text"><span class="icon">{ }</span><span class="label">Modul 5–8</span></div>
            </div>
            <div class="showcase-body">
                <div class="showcase-title">JavaScript Fundamental</div>
                <p class="showcase-desc">Kuasai variabel, fungsi, DOM manipulation, dan event handling untuk membuat halaman web interaktif dan dinamis.</p>
                <div class="showcase-tags">
                    <span class="showcase-tag">10 Video</span>
                    <span class="showcase-tag">3 Kuis</span>
                    <span class="showcase-tag">1 Proyek</span>
                </div>
            </div>
        </div>
        <div class="showcase-card">
            <div class="showcase-thumb t3">
                <div class="showcase-thumb-text"><span class="icon">&#9881;</span><span class="label">Modul 9–12</span></div>
            </div>
            <div class="showcase-body">
                <div class="showcase-title">Proyek Akhir: Landing Page</div>
                <p class="showcase-desc">Gabungkan semua skill yang sudah dipelajari ke dalam satu proyek utuh. Hasilnya akan direview dan dinilai oleh mentor.</p>
                <div class="showcase-tags">
                    <span class="showcase-tag">4 Video</span>
                    <span class="showcase-tag">Proyek Akhir</span>
                    <span class="showcase-tag">Sertifikat</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cara-kerja" class="how-section" style="background:var(--bg-secondary);">
    <div style="text-align:center;max-width:520px;margin:0 auto;">
        <h2 class="section-title-lg">Cara Kerja</h2>
        <p class="section-desc" style="margin:0 auto;">Empat langkah sederhana dari mendaftar hingga mendapatkan sertifikat digital.</p>
    </div>
    <div class="how-grid">
        <div class="how-step">
            <div class="how-num n1">1</div>
            <div class="how-title">Daftar Akun</div>
            <p class="how-desc">Buat akun gratis atau langsung upgrade ke Premium untuk akses penuh dan fitur mentorship.</p>
        </div>
        <div class="how-step">
            <div class="how-num n2">2</div>
            <div class="how-title">Pelajari Materi</div>
            <p class="how-desc">Tonton video, baca materi, dan kerjakan kuis di setiap modul untuk menguji pemahaman kamu.</p>
        </div>
        <div class="how-step">
            <div class="how-num n3">3</div>
            <div class="how-title">Kirim Proyek</div>
            <p class="how-desc">Upload tugas proyek akhir kamu. Mentor akan memeriksa dan memberikan feedback secara langsung.</p>
        </div>
        <div class="how-step">
            <div class="how-num n4">4</div>
            <div class="how-title">Raih Sertifikat</div>
            <p class="how-desc">Jika mentor menyetujui proyekmu, sertifikat digital akan langsung diterbitkan atas namamu.</p>
        </div>
    </div>
</section>

<section class="features-section">
    <div style="text-align:center;max-width:520px;margin:0 auto;">
        <h2 class="section-title-lg">Kenapa ITacademy?</h2>
        <p class="section-desc" style="margin:0 auto;">Platform ini dirancang agar kamu tidak hanya belajar teori, tapi juga mendapat validasi langsung dari praktisi.</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(59,130,246,0.15);">&#128218;</div>
            <div class="feature-title">Materi Terstruktur</div>
            <p class="feature-desc">Video dan teks yang disusun bertahap oleh mentor berpengalaman di bidang Web Development.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(139,92,246,0.15);">&#9997;</div>
            <div class="feature-title">Review oleh Manusia</div>
            <p class="feature-desc">Tugas proyek kamu diperiksa langsung oleh mentor — bukan auto-grading. Dapat feedback yang relevan.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(6,182,212,0.15);">&#128196;</div>
            <div class="feature-title">Sertifikat Tervalidasi</div>
            <p class="feature-desc">Sertifikat PDF hanya diterbitkan setelah mentor menyetujui hasil proyek kamu. Bukan kelulusan otomatis.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(245,158,11,0.15);">&#128640;</div>
            <div class="feature-title">Portofolio Nyata</div>
            <p class="feature-desc">Setiap proyek yang kamu kerjakan bisa langsung dipakai sebagai portofolio untuk melamar kerja.</p>
        </div>
    </div>
</section>

<section class="mentor-section" style="background:var(--bg-secondary);">
    <div style="text-align:center;max-width:520px;margin:0 auto;">
        <h2 class="section-title-lg">Mentor Kami</h2>
        <p class="section-desc" style="margin:0 auto;">Praktisi yang siap membimbing dan mereview setiap proyek yang kamu kerjakan.</p>
    </div>
    <div class="mentor-grid">
        <div class="mentor-card">
            <div class="mentor-avatar">BS</div>
            <div>
                <div class="mentor-name">Budi Santoso</div>
                <div class="mentor-spec">Frontend Developer</div>
                <p class="mentor-bio">5 tahun pengalaman di industri web. Spesialis HTML, CSS, dan JavaScript modern.</p>
            </div>
        </div>
        <div class="mentor-card">
            <div class="mentor-avatar">AW</div>
            <div>
                <div class="mentor-name">Anita Wijaya</div>
                <div class="mentor-spec">UI/UX Designer</div>
                <p class="mentor-bio">Desainer berpengalaman yang juga menguasai frontend. Membantu kamu bikin layout yang rapi.</p>
            </div>
        </div>
    </div>
</section>

<section id="harga" class="pricing-section">
    <div style="text-align:center;max-width:520px;margin:0 auto;">
        <h2 class="section-title-lg">Pilih Paket Belajar</h2>
        <p class="section-desc" style="margin:0 auto;">Mulai gratis untuk coba-coba, atau langsung Premium untuk akses penuh dan mentorship.</p>
    </div>
    <div class="pricing-grid" style="margin-top:48px;">
        <div class="price-card">
            <div class="price-tier">Free</div>
            <div class="price-amount">Rp 0</div>
            <div class="price-period">Gratis selamanya</div>
            <ul class="price-features">
                <li><span class="check">&#10003;</span> Akses materi dasar</li>
                <li><span class="check">&#10003;</span> Kuis latihan</li>
                <li><span class="cross">&#10007;</span> Kirim tugas proyek</li>
                <li><span class="cross">&#10007;</span> Review dari mentor</li>
                <li><span class="cross">&#10007;</span> Sertifikat digital</li>
            </ul>
            <a href="register.php" class="btn btn-outline btn-full">Daftar Gratis</a>
        </div>
        <div class="price-card featured">
            <div style="margin-bottom:12px;"><span class="badge badge-gold">Rekomendasi</span></div>
            <div class="price-tier" style="color:var(--accent-blue);">Premium</div>
            <div class="price-amount" style="background:linear-gradient(135deg,#3b82f6,#8b5cf6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Rp 99.000</div>
            <div class="price-period">per bulan</div>
            <ul class="price-features">
                <li><span class="check">&#10003;</span> Semua materi & video</li>
                <li><span class="check">&#10003;</span> Kuis latihan</li>
                <li><span class="check">&#10003;</span> Kirim tugas proyek</li>
                <li><span class="check">&#10003;</span> Review & feedback mentor</li>
                <li><span class="check">&#10003;</span> Sertifikat digital (PDF)</li>
            </ul>
            <a href="register.php" class="btn btn-primary btn-full">Daftar Premium</a>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-box">
        <h2 class="cta-title">Siap mulai belajar?</h2>
        <p class="cta-desc">Daftar sekarang dan mulai bangun portofolio IT pertamamu. Kamu bisa mulai dari paket gratis.</p>
        <a href="register.php" class="btn btn-primary btn-lg">Daftar Sekarang</a>
    </div>
</section>

<footer class="landing-footer">
    <div class="nav-logo">
        <div class="brand-icon">IT</div>
        <span class="brand-name">IT<span>academy</span></span>
    </div>
    <div class="footer-text">&copy; 2025 ITacademy</div>
    <div class="footer-links">
        <a href="#">Privasi</a>
        <a href="#">Syarat</a>
        <a href="#">Kontak</a>
    </div>
</footer>

<script>
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        nav.style.background = window.scrollY > 20 ? 'rgba(10,14,26,0.97)' : 'rgba(10,14,26,0.8)';
    });
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const el = document.querySelector(a.getAttribute('href'));
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
</body>
</html>
