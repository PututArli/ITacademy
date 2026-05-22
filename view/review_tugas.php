<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../model/koneksi.php';

if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'mentor') {
    header("Location: " . BASEURL . "/index.php?page=login");
    exit();
}

$nama_user = $_SESSION['nama'];

if (isset($_GET['aksi']) && isset($_GET['id_tugas'])) {
    $id_tugas = intval($_GET['id_tugas']);
    $aksi = $_GET['aksi'];
    
    if ($aksi == 'setuju') {
        $status_baru = 'Selesai';
    } elseif ($aksi == 'tolak') {
        $status_baru = 'Revisi';
    }
    
    if (isset($status_baru)) {
        mysqli_query($conn, "UPDATE tugas SET status = '$status_baru' WHERE id = $id_tugas");
        echo "<script>alert('Status tugas berhasil diperbarui!'); window.location.href='index.php?page=review_tugas';</script>";
        exit;
    }
}

$query_tugas = "SELECT tugas.*, users.nama AS nama_siswa 
                FROM tugas 
                JOIN users ON tugas.user_id = users.id 
                ORDER BY tugas.id ASC";
$ambil_tugas = mysqli_query($conn, $query_tugas);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Tugas - ITacademy</title>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>/assets/css/style.css">
    <style>
        .mentor-layout { display: flex; min-height: 100vh; background-color: #0f172a; color: #f8fafc; font-family: sans-serif; }
        .sidebar { width: 260px; background-color: #1e293b; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid #334155; }
        .main-content { flex: 1; padding: 40px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .brand-name { font-size: 20px; font-weight: bold; color: #3b82f6; text-decoration: none; }
        .brand-name span { color: #38bdf8; }
        .nav-menu { list-style: none; padding: 0; margin: 20px 0; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #94a3b8; text-decoration: none; border-radius: 8px; margin-bottom: 8px; font-weight: 500; }
        .nav-item.active { background-color: #334155; color: #38bdf8; }
        .nav-item:hover { background-color: #334155; color: #ffffff; }
        
        .tugas-list { display: flex; flex-direction: column; gap: 20px; max-width: 800px; }
        .tugas-card { background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; position: relative; }
        .tugas-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
        .tugas-title { font-size: 18px; font-weight: 700; color: #ffffff; margin: 0; }
        .badge-status { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .badge-status.selesai { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
        .badge-status.revisi { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .tugas-meta { font-size: 13px; color: #64748b; margin-bottom: 12px; }
        .tugas-meta span { color: #94a3b8; font-weight: 500; }
        .tugas-desc { font-size: 14px; color: #94a3b8; line-height: 1.6; margin-bottom: 20px; }
        .btn-group { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-action { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; border: none; text-align: center; }
        .btn-feedback { background-color: #334155; color: #ffffff; }
        .btn-approve { background-color: #6366f1; color: #ffffff; box-shadow: 0 0 15px rgba(99, 102, 241, 0.4); }
        .btn-reject { background-color: transparent; color: #ef4444; border: 1px solid #ef4444; }
        .btn-feedback:hover { background-color: #475569; }
        .btn-approve:hover { background-color: #4f46e5; }
        .btn-reject:hover { background-color: rgba(239, 68, 68, 0.1); }
    </style>
</head>
<body>

<div class="mentor-layout">
    <div class="sidebar">
        <div>
            <a href="#" class="brand-name">IT<span>academy</span></a>
            <div style="font-size: 11px; color: #64748b; margin-top: 24px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Mentor</div>
            <ul class="nav-menu">
                <li><a href="index.php?page=mentor_dashboard" class="nav-item">📊 Dashboard</a></li>
                <li><a href="index.php?page=review_tugas" class="nav-item active">📝 Review Tugas</a></li>
                <li><a href="#" class="nav-item">☺ Siswa Saya</a></li>
            </ul>
            <div style="font-size: 11px; color: #64748b; margin-top: 24px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Akun</div>
            <ul class="nav-menu">
                <li><a href="#" class="nav-item">👤 Profil</a></li>
                <li><a href="#" onclick="bukaModalLogout(event)" class="nav-item" style="color: #f87171;">🚪 Keluar</a></li>
            </ul>
        </div>
        
        <div style="background-color: #111827; padding: 12px; border-radius: 12px; display: flex; align-items: center; gap: 12px;">
            <div style="width: 36px; height: 36px; background-color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">BU</div>
            <div>
                <div style="font-size: 14px; font-weight: 600; color: white;"><?= htmlspecialchars($nama_user); ?></div>
                <div style="font-size: 11px; color: #64748b;">Mentor</div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h1 style="font-size: 24px; font-weight: 700; color: white; margin: 0;">Review Tugas Masuk</h1>
            <div style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600;">Mentor</div>
        </div>

        <h2 style="font-size: 18px; font-weight: 600; color: #94a3b8; margin-bottom: 24px;">Daftar Tugas Perlu Direview</h2>

        <div class="tugas-list">
            <?php 
            if ($ambil_tugas && mysqli_num_rows($ambil_tugas) > 0) {
                while($row = mysqli_fetch_assoc($ambil_tugas)) { 
                    $status_class = '';
                    if ($row['status'] == 'Selesai') $status_class = 'selesai';
                    if ($row['status'] == 'Revisi') $status_class = 'revisi';
            ?>
                <div class="tugas-card">
                    <div class="tugas-header">
                        <h3 class="tugas-title"><?= htmlspecialchars($row['judul_tugas']); ?></h3>
                        <span class="badge-status <?= $status_class; ?>"><?= htmlspecialchars($row['status']); ?></span>
                    </div>
                    
                    <div class="tugas-meta">
                        Siswa: <span><?= htmlspecialchars($row['nama_siswa']); ?></span> &bull; File: <a href="#" style="color: #38bdf8; text-decoration: none; font-weight: 500;"><?= htmlspecialchars($row['file_tugas']); ?></a>
                    </div>
                    
                    <p class="tugas-desc">
                        <?php
                        if (stripos($row['judul_tugas'], 'Portfolio') !== false) {
                            echo "Siswa membuat landing page portfolio dengan HTML & CSS. Menggunakan Flexbox untuk layout dan sudah mencakup section Hero, About, dan Contact.";
                        } elseif (stripos($row['judul_tugas'], 'Login') !== false) {
                            echo "Membuat halaman login dengan form validasi JavaScript dan desain responsif menggunakan CSS Grid dan media queries.";
                        } else {
                            echo "Proyek akhir berupa website toko online sederhana dengan fitur katalog produk, halaman detail, dan keranjang belanja menggunakan JavaScript.";
                        }
                        ?>
                    </p>
                    
                    <div class="btn-group">
                        <button class="btn-action btn-feedback">Beri Feedback</button>
                        <a href="index.php?page=review_tugas&id_tugas=<?= $row['id']; ?>&aksi=setuju" class="btn-action btn-approve">Setujui & Terbitkan Sertifikat</a>
                        <a href="index.php?page=review_tugas&id_tugas=<?= $row['id']; ?>&aksi=tolak" class="btn-action btn-reject">Tolak & Minta Revisi</a>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo "<div style='background: #1e293b; padding: 24px; border-radius: 8px; text-align: center; color: #64748b;'>Belum ada data tugas yang masuk di database.</div>";
            }
            ?>
        </div>
    </div>
</div>

<div id="logoutModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; width: 100%; max-width: 400px; text-align: center;">
        <div style="font-size: 40px; margin-bottom: 16px;">👋</div>
        <h2 style="color: #ffffff; font-size: 20px; font-weight: 700; margin-bottom: 8px;">Yakin ingin keluar?</h2>
        <p style="color: #94a3b8; font-size: 14px; line-height: 1.5; margin-bottom: 24px;">Sesi ngajar kamu akan diakhiri. Kamu harus masuk kembali untuk mereview tugas siswa.</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="tutupModalLogout()" style="background: #334155; color: #ffffff; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; flex: 1;">Batal</button>
            <a href="index.php?page=logout" style="background: #ef4444; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; flex: 1; display: inline-block;">Ya, Keluar</a>
        </div>
    </div>
</div>

<script>
function bukaModalLogout(e) { e.preventDefault(); document.getElementById('logoutModal').style.display = 'flex'; }
function tutupModalLogout() { document.getElementById('logoutModal').style.display = 'none'; }
</script>

</body>
</html>