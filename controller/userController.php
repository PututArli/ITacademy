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
        require_once 'view/user/dashboard.php';
    }

    public function materi() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
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
        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : null;
        require_once 'model/tugasModel.php';
        $tugasModel = new tugasModel();
        $tugasSiswa = $tugasModel->getTugasBySiswaId($id_siswa);
        $status_tugas = ($tugasSiswa) ? $tugasSiswa['status'] : 'Belum Mengirim';

        require_once 'view/user/tugas.php';
    }

    public function kirimTugas() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $nama_siswa = isset($_SESSION['nama']) ? $_SESSION['nama'] : null;
        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : null;
        if (empty($id_siswa) && !empty($nama_siswa)) {
            global $conn; // Mengambil koneksi database global aplikasi kamu
            $nama_bersih = mysqli_real_escape_string($conn, $nama_siswa);
            $cek_user = mysqli_query($conn, "SELECT id FROM users WHERE nama = '$nama_bersih' LIMIT 1");
            if ($row = mysqli_fetch_assoc($cek_user)) {
                $id_siswa = $row['id'];
                $_SESSION['id_siswa'] = $id_siswa; // Kunci permanen di session biar ga ilang lagi
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul_tugas = $_POST['judul_tugas'];
            $nama_file = $_FILES['file_tugas']['name'];
            $tmp_name = $_FILES['file_tugas']['tmp_name'];
            $target_dir = "assets/uploads/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            move_uploaded_file($tmp_name, $target_dir . $nama_file);

            require_once 'model/tugasModel.php';
            $tugasModel = new tugasModel();
            $tugasModel->tambahTugas($id_siswa, $judul_tugas, $nama_file);

            header("Location: " . BASEURL . "/index.php?page=tugas&upload=sukses");
            exit();
        }
    }
    public function sertifikat() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        require_once 'view/user/sertifikat.php';
    }

    public function profil() {
        $nama_user = $_SESSION['nama'];
        $status_keanggotaan = ($_SESSION['role'] === 'premium') ? 'Premium Member' : 'Free Member';
        
        $pecah_nama = explode(" ", $nama_user);
        $nama_depan = $pecah_nama[0];
        $nama_belakang = isset($pecah_nama[1]) ? implode(" ", array_slice($pecah_nama, 1)) : "";
        
        require_once 'view/user/profil.php';
    }
}