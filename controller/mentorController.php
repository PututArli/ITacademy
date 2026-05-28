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
        $total_tugas_menunggu = $tugasModel->getTotalTugasMenunggu();
        require_once 'view/mentor/dashboardMentor.php';
    }

    public function reviewTugasMentor() {
        $nama_user = $_SESSION['nama'];

        if (isset($_GET['aksi']) && isset($_GET['id_tugas'])) {
            $status = ($_GET['aksi'] == 'setuju') ? 'Selesai' : 'Revisi';
            $this->tugasModel->updateStatusTugas($_GET['id_tugas'], $status);
            header("Location: " . BASEURL . "/index.php?page=reviewTugasMentor");
            exit();
        }

        $ambil_tugas = $this->tugasModel->getAllTugas();
        require_once 'view/mentor/reviewtugasMentor.php';
    }

    public function siswaMentor() {
        $nama_user = $_SESSION['nama'];
        $daftar_siswa = $this->userModel->getAllPengguna();
        require_once 'view/mentor/siswaMentor.php';
    }

    public function profileMentor() {
        $nama_user = $_SESSION['nama'];
        global $conn;
        
        $query = "SELECT * FROM users WHERE nama = '" . mysqli_real_escape_string($conn, $nama_user) . "' AND role = 'mentor' LIMIT 1";
        $ambil_mentor = mysqli_query($conn, $query);
        $data_mentor = mysqli_fetch_assoc($ambil_mentor);

        require_once 'view/mentor/profileMentor.php';
    }
}
?>