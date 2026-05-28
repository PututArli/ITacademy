<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITacademy - Platform E-Learning Berbasis Project dan Mentorship</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style.css">
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
        <a href="<?= BASEURL ?>/index.php?page=login" class="btn btn-outline">Masuk</a>
        <a href="<?= BASEURL ?>/index.php?page=register" class="btn btn-primary">Daftar</a>
    </div>
</nav>

<section class="hero-section">
    <div class="hero-bg-glow hero-glow-1"></div>
    <div class="hero-bg-glow hero-glow-2"></div>
    <div class="hero-content">
        <h1 class="hero-title fade-up">Bangun Portofolio IT<br>dengan <span>Bimbingan Mentor</span></h1>
        <p class="hero-desc fade-up delay-1">Belajar Web Development sambil mengerjakan proyek nyata. Tugas kamu direview langsung oleh mentor — bukan dinilai otomatis oleh sistem.</p>
        <div class="hero-actions fade-up delay-2">
            <a href="<?= BASEURL ?>/index.php?page=register" class="btn btn-primary btn-lg">Mulai Belajar Gratis</a>
            <a href="#cara-kerja" class="btn btn-ghost btn-lg">Lihat Cara Kerja</a>
        </div>
    </div>
</section>

<section id="kursus" class="features-section">
    <div style="text-align:center; max-width:520px; margin:0 auto;">
        <h2 class="section-title-lg">Kursus Tersedia</h2>
        <p class="section-desc" style="margin:0 auto;">Fokus pada Web Development dasar. Setiap kursus terdiri dari materi, kuis latihan, dan tugas proyek akhir yang akan direview mentor.</p>
    </div>
    <div class="course-showcase">
        <?php foreach ($courses as $course): ?>
        <div class="showcase-card">
            <div class="showcase-thumb <?= $course['thumb_class']; ?>">
                <div class="showcase-thumb-text">
                    <span class="icon"><?= $course['icon']; ?></span>
                    <span class="label"><?= $course['label']; ?></span>
                </div>
            </div>
            <div class="showcase-body">
                <div class="showcase-title"><?= $course['title']; ?></div>
                <p class="showcase-desc"><?= $course['desc']; ?></p>
                <div class="showcase-tags">
                    <?php foreach ($course['tags'] as $tag): ?>
                        <span class="showcase-tag"><?= $tag; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="cara-kerja" class="how-section" style="background:var(--bg-secondary);">
    <div style="text-align:center; max-width:520px; margin:0 auto;">
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
    <div style="text-align:center; max-width:520px; margin:0 auto;">
        <h2 class="section-title-lg">Kenapa ITacademy?</h2>
        <p class="section-desc" style="margin:0 auto;">Platform ini dirancang agar kamu tidak hanya belajar teori, tapi juga mendapat validasi langsung dari praktisi.</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(59,130,246,0.15);"></div>
            <div class="feature-title">Materi Terstruktur</div>
            <p class="feature-desc">Video dan teks yang disusun bertahap oleh mentor berpengalaman di bidang Web Development.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(139,92,246,0.15);"></div>
            <div class="feature-title">Review oleh Manusia</div>
            <p class="feature-desc">Tugas proyek kamu diperiksa langsung oleh mentor — bukan auto-grading. Dapat feedback yang relevan.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(6,182,212,0.15);"></div>
            <div class="feature-title">Sertifikat Tervalidasi</div>
            <p class="feature-desc">Sertifikat PDF hanya diterbitkan setelah mentor menyetujui hasil proyek kamu. Bukan kelulusan otomatis.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="background:rgba(245,158,11,0.15);"></div>
            <div class="feature-title">Portofolio Nyata</div>
            <p class="feature-desc">Setiap proyek yang kamu kerjakan bisa langsung dipakai sebagai portofolio untuk melamar kerja.</p>
        </div>
    </div>
</section>

<section class="mentor-section" style="background:var(--bg-secondary);">
    <div style="text-align:center; max-width:520px; margin:0 auto;">
        <h2 class="section-title-lg">Mentor Kami</h2>
        <p class="section-desc" style="margin:0 auto;">Praktisi yang siap membimbing dan mereview setiap proyek yang kamu kerjakan.</p>
    </div>
    <div class="mentor-grid">
        <?php foreach ($mentors as $mentor): ?>
        <div class="mentor-card">
            <div class="mentor-avatar"><?= $mentor['avatar']; ?></div>
            <div>
                <div class="mentor-name"><?= $mentor['name']; ?></div>
                <div class="mentor-spec"><?= $mentor['spec']; ?></div>
                <p class="mentor-bio"><?= $mentor['bio']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="harga" class="pricing-section">
    <div style="text-align:center; max-width:520px; margin:0 auto;">
        <h2 class="section-title-lg">Pilih Paket Belajar</h2>
        <p class="section-desc" style="margin:0 auto;">Mulai gratis untuk coba-coba, atau langsung Premium untuk akses penuh dan mentorship.</p>
    </div>
    <div class="pricing-grid" style="margin-top:48px;">
        <?php foreach ($pricing as $plan): ?>
        <div class="price-card <?= $plan['featured'] ? 'featured' : ''; ?>">
            <?php if ($plan['featured']): ?>
                <div style="margin-bottom:12px;"><span class="badge badge-gold">Rekomendasi</span></div>
            <?php endif; ?>
            <div class="price-tier" <?= $plan['featured'] ? 'style="color:var(--accent-blue);"' : ''; ?>><?= $plan['tier']; ?></div>
            <div class="price-amount" <?= $plan['featured'] ? 'style="background:linear-gradient(135deg,#3b82f6,#8b5cf6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"' : ''; ?>><?= $plan['amount']; ?></div>
            <div class="price-period"><?= $plan['period']; ?></div>
            <ul class="price-features">
                <?php foreach ($plan['features'] as $feat): ?>
                    <li><span class="<?= $feat['class']; ?>"><?= $feat['icon'] === 'check' ? '&check;' : '&times;'; ?></span> <?= $feat['text']; ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?= BASEURL ?>/index.php?page=register&plan=<?= strtolower($plan['tier']); ?>" class="btn <?= $plan['btn_class']; ?> btn-full"><?= $plan['btn_text']; ?></a>        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="cta-section">
    <div class="cta-box">
        <h2 class="cta-title">Siap mulai belajar?</h2>
        <p class="cta-desc">Daftar sekarang dan mulai bangun portofolio IT pertamamu. Kamu bisa mulai dari paket gratis.</p>
        <a href="<?= BASEURL ?>/index.php?page=register" class="btn btn-primary btn-lg">Daftar Sekarang</a>
    </div>
</section>

<footer class="landing-footer">
    <div class="nav-logo">
        <div class="brand-icon">IT</div>
        <span class="brand-name">IT<span>academy</span></span>
    </div>
    <div class="footer-text">&copy; <?= date('Y'); ?> ITacademy</div>
</footer>

<script src="<?= BASEURL ?>/assets/js/main.js"></script>

</body>
</html>