<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITacademy - Belajar IT Berbasis Proyek</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .hero { background: linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)), url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); 
                height: 80vh; background-size: cover; color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 20px; }
        .hero h1 { font-size: 3rem; margin-bottom: 10px; }
        .pricing-container { display: flex; justify-content: center; gap: 30px; padding: 50px 20px; flex-wrap: wrap; }
        .price-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); width: 300px; text-align: center; border-top: 5px solid #3498db; }
        .price-card.premium { border-top-color: #f1c40f; transform: scale(1.05); }
    </style>
</head>
<body style="display: block; overflow-x: hidden;">
    <nav style="background: white; padding: 20px 50px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h2 style="color: #2c3e50;">ITacademy</h2>
        <div>
            <a href="login.php" class="btn">Masuk</a>
            <a href="register.php" class="btn" style="background: transparent; color: #3498db; border: 1px solid #3498db;">Daftar</a>
        </div>
    </nav>

    <header class="hero">
        <h1>ITacademy</h1>
        <p style="font-size: 1.2rem; max-width: 600px;">Platform E-Learning Berbasis Project dan Mentorship untuk meningkatkan portofolio nyata Anda.</p>
        <a href="#pricing" class="btn" style="margin-top: 25px; padding: 15px 30px; font-size: 1.1rem;">Mulai Belajar Sekarang</a>
    </header>

    <section id="pricing" class="pricing-container">
        <div class="price-card">
            <h3>User Free</h3>
            <h2 style="margin: 20px 0;">Rp 0</h2>
            <ul style="list-style: none; text-align: left; margin-bottom: 25px; color: #7f8c8d; line-height: 2;">
                <li>✓ Akses materi dasar</li>
                <li>✓ Kuis pilihan ganda</li>
                <li>✗ Tanpa Sertifikat</li>
                <li>✗ Tanpa Review Mentor</li>
            </ul>
            <a href="login.php" class="btn" style="width: 100%;">Pilih Free</a>
        </div>

        <div class="price-card premium">
            <div style="background: #f1c40f; color: #333; display: inline-block; padding: 2px 10px; border-radius: 5px; font-size: 12px; margin-bottom: 10px;">TERPOPULER</div>
            <h3>User Premium</h3>
            <h2 style="margin: 20px 0;">Rp 99k <small style="font-size: 12px; color: #7f8c8d;">(Simulasi)</small></h2>