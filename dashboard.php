<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ITacademy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="sidebar">
        <h2>ITacademy</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="materi.php">Materi Belajar</a>
        <a href="kuis.php">Kuis Latihan</a>
        <a href="tugas.php">Pengumpulan Tugas</a>
        <a href="sertifikat.php">Sertifikat Saya</a>
    </div>

    <div class="main-area">
        <div class="topbar">
            <div>
                <strong>Selamat Datang</strong>
            </div>
            <div>
                <span class="role-badge">User (Premium)</span>
                <a href="login.php" style="margin-left: 15px; color: #e74c3c; text-decoration: none;">Logout</a>
            </div>
        </div>

        <div class="content">
            <h1 class="page-title">Dashboard Pembelajaran</h1>
            
            <div class="card-container">
                <div class="card">
                    <h3>Web Development Dasar</h3>
                    <p>Pelajari fundamental HTML, CSS, dan logika dasar untuk membangun antarmuka web.</p>
                    <a href="materi.php" class="btn">Lanjut Belajar</a>
                </div>

                <div class="card">
                    <h3>Status Proyek Akhir</h3>
                    <p>Status: <strong>Belum Dikirim</strong></p>
                    <p>Selesaikan tugas akhir kelas untuk mengklaim sertifikat kelulusan digital.</p>
                    <a href="tugas.php" class="btn">Kirim Tugas</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>