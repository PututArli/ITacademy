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
    
    require_once 'model/tugasModel.php';
    $tugasModel = new tugasModel();
    $tugas_menunggu_count = $tugasModel->hitungTugasByStatus('Menunggu');
    $tugas_selesai_count = $tugasModel->hitungTugasByStatus('Selesai');
    $total_siswa_count = $tugasModel->hitungTotalSiswa();
    $tugas_masuk = $tugasModel->getTugasMenungguDashboard();
    
    require_once 'view/mentor/dashboardMentor.php';
}

    public function reviewTugasMentor() {
    $nama_user = $_SESSION['nama'];

    require_once 'model/tugasModel.php';
    $tugasModel = new tugasModel();

    if (isset($_GET['aksi']) && isset($_GET['id_tugas'])) {
        $id_tugas = $_GET['id_tugas'];

        if ($_GET['aksi'] == 'setuju') {
                $tugasModel->updateStatusTugas($id_tugas, 'Selesai');
                $detailTugas = $tugasModel->getTugasById($id_tugas);
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

        } elseif ($_GET['aksi'] == 'tolak') {
            $tugasModel->updateStatusTugas($id_tugas, 'Revisi');
        }

        header("Location: " . BASEURL . "/index.php?page=reviewTugasMentor");
        exit();
    }

    $ambil_tugas = $tugasModel->getAllTugas();
    require_once 'view/mentor/reviewTugasMentor.php';
}

    public function siswaMentor() {
        $nama_user = $_SESSION['nama'];
        $daftar_siswa = $this->userModel->getAllPengguna();
        require_once 'view/mentor/siswaMentor.php';
    }

    public function profilMentor() {
        $nama_user = $_SESSION['nama'];
        global $conn;
        
        $query = "SELECT * FROM users WHERE nama = '" . mysqli_real_escape_string($conn, $nama_user) . "' AND role = 'mentor' LIMIT 1";
        $ambil_mentor = mysqli_query($conn, $query);
        $data_mentor = mysqli_fetch_assoc($ambil_mentor);

        require_once 'view/mentor/profilMentor.php';
    }

    public function prosesTambahMateri() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judul = $_POST['judul'];
        $link = $_POST['link'];
        $deskripsi = $_POST['deskripsi'];

        require_once 'model/materiModel.php';
        $materiModel = new materiModel($GLOBALS['conn']);
        $materiModel->tambahMateri($judul, $link, $deskripsi);
        
        header("Location: " . BASEURL . "/index.php?page=dashboardMentor&status=sukses");
    }
    }

   public function tambahMateri() {
    require_once 'view/mentor/tambahMateri.php';
    }

}
?>