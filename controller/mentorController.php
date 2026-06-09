<?php
class mentorController {
    private $userModel;
    private $tugasModel;

    public function __construct() {
        if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'mentor') {
            header("Location: " . BASEURL . "/index.php?page=login");
            exit();
        }
        require_once 'model/userModel.php';
        require_once 'model/tugasModel.php';
        $this->userModel = new userModel();
        $this->tugasModel = new tugasModel();
    }

    public function dashboardMentor() {
        $nama_user = $_SESSION['nama'];
        
        $tugas_menunggu_count = $this->tugasModel->hitungTugasByStatus('Menunggu');
        $tugas_selesai_count  = $this->tugasModel->hitungTugasByStatus('Selesai');
        $total_siswa_count    = $this->tugasModel->hitungTotalSiswa();
        $tugas_masuk          = $this->tugasModel->getTugasMenungguDashboard();
        
        require_once 'view/mentor/dashboardMentor.php';
    }

    public function reviewTugasMentor() {
        $nama_user = $_SESSION['nama'];
        $pesan_sukses = '';

        // ---- Handler GET: Setuju (terbitkan sertifikat) ----
        if (isset($_GET['aksi']) && $_GET['aksi'] == 'setuju' && isset($_GET['id_tugas'])) {
            $id_tugas = intval($_GET['id_tugas']);
            $this->tugasModel->updateStatusTugas($id_tugas, 'Selesai');
            $detailTugas = $this->tugasModel->getTugasById($id_tugas);

            if (isset($detailTugas['id_siswa'])) {
                $id_siswa = $detailTugas['id_siswa'];
            } elseif (isset($detailTugas['user_id'])) {
                $id_siswa = $detailTugas['user_id'];
            } else {
                $id_siswa = 0;
            }

            $no_sertifikat = "SERT-IT-" . date("Y") . "-" . rand(1000, 9999);
            require_once 'model/sertifikatModel.php';
            $sertifikatModel = new sertifikatModel();
            $sertifikatModel->tambahSertifikat($id_siswa, $id_tugas, $no_sertifikat);

            header("Location: " . BASEURL . "/index.php?page=reviewTugasMentor&sukses=setuju");
            exit();
        }

        // ---- Handler POST: Beri Feedback ----
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi'])) {

            if ($_POST['aksi'] === 'beri_feedback') {
                $id_tugas = intval($_POST['id_tugas'] ?? 0);
                $catatan  = trim($_POST['catatan_mentor'] ?? '');
                if ($id_tugas && $catatan) {
                    $this->tugasModel->simpanFeedback($id_tugas, $catatan);
                }
                header("Location: " . BASEURL . "/index.php?page=reviewTugasMentor&sukses=feedback");
                exit();
            }

            // ---- Handler POST: Tolak + Catatan Wajib ----
            if ($_POST['aksi'] === 'tolak_tugas') {
                $id_tugas = intval($_POST['id_tugas'] ?? 0);
                $catatan  = trim($_POST['catatan_mentor'] ?? '');
                if ($id_tugas) {
                    $this->tugasModel->updateStatusTugas($id_tugas, 'Revisi');
                    if ($catatan) {
                        $this->tugasModel->simpanFeedback($id_tugas, $catatan);
                    }
                }
                header("Location: " . BASEURL . "/index.php?page=reviewTugasMentor&sukses=tolak");
                exit();
            }
        }

        if (isset($_GET['sukses'])) {
            $jenis = $_GET['sukses'];
            if ($jenis === 'setuju') $pesan_sukses = 'Tugas disetujui dan sertifikat telah diterbitkan.';
            if ($jenis === 'tolak')  $pesan_sukses = 'Tugas ditolak dan siswa diminta revisi.';
            if ($jenis === 'feedback') $pesan_sukses = 'Feedback berhasil disimpan.';
        }

        $ambil_tugas = $this->tugasModel->getAllTugas();
        require_once 'view/mentor/reviewTugasMentor.php';
    }


    public function siswaMentor() {
        $nama_user = $_SESSION['nama'];
        $daftar_siswa = $this->userModel->getAllPengguna();
        require_once 'view/mentor/siswaMentor.php';
    }

    public function profilMentor() {
        $nama_user = $_SESSION['nama'];
        $id_mentor = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : 0;
        $pesan_sukses = '';
        $pesan_error  = '';

        // Ambil data mentor dari DB berdasarkan id session
        $data_mentor = $this->userModel->getUserById($id_mentor);

        // Jika tidak ditemukan by id, cari by nama
        if (!$data_mentor) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_user);
            $res = mysqli_query($conn, "SELECT * FROM users WHERE nama = '$nama_bersih' AND role = 'mentor' LIMIT 1");
            $data_mentor = mysqli_fetch_assoc($res);
            if ($data_mentor) {
                $id_mentor = intval($data_mentor['id']);
                $_SESSION['id_siswa'] = $id_mentor;
            }
        }

        // Proses update profil mentor
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'update_profil_mentor') {
            $nama_baru     = trim($_POST['nama'] ?? '');
            $password_baru = trim($_POST['password_baru'] ?? '');
            $konfirmasi    = trim($_POST['konfirmasi'] ?? '');

            if (!$nama_baru) {
                $pesan_error = "Nama tidak boleh kosong.";
            } elseif ($password_baru && strlen($password_baru) < 8) {
                $pesan_error = "Password baru minimal harus 8 karakter.";
            } elseif ($password_baru && $password_baru !== $konfirmasi) {
                $pesan_error = "Konfirmasi password tidak cocok.";
            } else {
                if ($this->userModel->updateProfilUser($id_mentor, $nama_baru, $password_baru)) {
                    $_SESSION['nama'] = $nama_baru;
                    $nama_user = $nama_baru;
                    $data_mentor = $this->userModel->getUserById($id_mentor);
                    $pesan_sukses = "Profil berhasil diperbarui.";
                } else {
                    $pesan_error = "Gagal memperbarui profil.";
                }
            }
        }

        require_once 'view/mentor/profilMentor.php';
    }

    public function prosesTambahMateri() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul    = $_POST['judul'];
            $link     = $_POST['link'];
            $deskripsi = $_POST['deskripsi'];

            require_once 'model/materiModel.php';
            $materiModel = new materiModel($GLOBALS['conn']);
            $materiModel->tambahMateri($judul, $link, $deskripsi);
            
            header("Location: " . BASEURL . "/index.php?page=dashboardMentor&status=sukses");
            exit();
        }
    }

   public function tambahMateri() {
        require_once 'view/mentor/tambahMateri.php';
    }

}
?>