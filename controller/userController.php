<?php
class userController {
    public function __construct() {
        if (!isset($_SESSION['nama']) || ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'mentor')) {
            header("Location: " . BASEURL . "/index.php?page=login");
            exit();
        }
    }

    public function dashboard() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';

        // Load tugas status for dashboard
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;
        $status_tugas = 'Belum Mengirim';
        if ($id_siswa) {
            require_once 'model/tugasModel.php';
            $tugasModel = new tugasModel();
            $tugasSiswa = $tugasModel->getTugasBySiswaId($id_siswa);
            if ($tugasSiswa) {
                $status_tugas = $tugasSiswa['status'];
            }
        }

        require_once 'view/user/dashboard.php';
    }

   public function materi() {
    $nama_user = $_SESSION['nama'] ?? 'User';
    $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';

    require_once 'model/materiModel.php';
    $materiModel = new materiModel($GLOBALS['conn']);
    $id_materi = isset($_GET['id']) ? $_GET['id'] : 1;
    $list_materi = $materiModel->getAllMateri();
    $materi_aktif = $materiModel->getMateriById($id_materi);
    require_once 'view/user/materi.php';
    }

    public function kuis() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        require_once 'view/user/kuis.php';
    }

    public function tugas() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;

        // Coba cari id_siswa dari DB jika belum ada di session
        if (empty($id_siswa) && !empty($nama_user)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_user);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        require_once 'model/tugasModel.php';
        $tugasModel = new tugasModel();
        $tugasSiswa = $tugasModel->getTugasBySiswaId($id_siswa);
        $status_tugas = $tugasSiswa ? $tugasSiswa['status'] : 'Belum Mengirim';

        require_once 'view/user/tugas.php';
    }

    public function kirimTugas() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $nama_siswa = isset($_SESSION['nama']) ? $_SESSION['nama'] : null;
        $id_siswa   = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;

        // Fallback: cari id_siswa dari DB berdasarkan nama session
        if (empty($id_siswa) && !empty($nama_siswa)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_siswa);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul_tugas = $_POST['judul_tugas'];
            $nama_file   = $_FILES['file_tugas']['name'];
            $tmp_name    = $_FILES['file_tugas']['tmp_name'];
            $target_dir  = "assets/uploads/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            // Buat nama file unik agar tidak tertimpa
            $ekstensi   = pathinfo($nama_file, PATHINFO_EXTENSION);
            $nama_bersih = pathinfo($nama_file, PATHINFO_FILENAME);
            $nama_final  = $nama_bersih . '_' . time() . '.' . $ekstensi;

            move_uploaded_file($tmp_name, $target_dir . $nama_final);

            require_once 'model/tugasModel.php';
            $tugasModel = new tugasModel();
            $tugasModel->tambahTugas($id_siswa, $judul_tugas, $nama_final);

            header("Location: " . BASEURL . "/index.php?page=tugas&upload=sukses");
            exit();
        }
    }

    public function sertifikat() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        $id_siswa = isset($_SESSION['id_siswa']) ? intval($_SESSION['id_siswa']) : null;

        if (empty($id_siswa) && !empty($nama_user)) {
            global $conn;
            $nama_bersih = mysqli_real_escape_string($conn, $nama_user);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = intval($row['id']);
                $_SESSION['id_siswa'] = $id_siswa;
            }
        }

        require_once 'model/sertifikatModel.php';
        $sertifikatModel = new sertifikatModel();
        $sertifikatSiswa = null;

        if ($id_siswa) {
            $sertifikatSiswa = $sertifikatModel->getSertifikatBySiswaId($id_siswa);
        }

        require_once 'view/user/sertifikat.php';
    }

    public function profil() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';

        $pecah_nama   = explode(" ", $nama_user);
        $nama_depan   = $pecah_nama[0];
        $nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";

        require_once 'view/user/profil.php';
    }
}