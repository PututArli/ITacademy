<?php
class adminController {
    private $userModel; 

    public function __construct() {
        if (!isset($_SESSION['nama']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/index.php?page=login");
            exit();
        }
        require_once 'model/userModel.php';
        $this->userModel = new userModel(); 
    }

    public function dashboardAdmin() {
        $nama_user = $_SESSION['nama'];
        
        $total_pengguna       = $this->userModel->getTotalPengguna();
        $total_premium        = $this->userModel->getTotalPremium();
        $total_mentor         = $this->userModel->getTotalMentor();
        $total_sertifikat     = $this->userModel->getTotalSertifikat();
        $total_tugas_menunggu = $this->userModel->getTotalTugasMenunggu();
        
        $daftar_pengguna = $this->userModel->getAllPengguna();
        $daftar_mentor   = $this->userModel->getAllMentor();
        $daftar_tugas    = $this->userModel->getAllTugasMenunggu();
        
        require_once 'view/admin/dashboardAdmin.php';
    }

    public function penggunaAdmin() {
        $nama_user = $_SESSION['nama'];
        $total_pengguna = $this->userModel->getTotalPengguna();
        $total_premium  = $this->userModel->getTotalPremium();
        require_once 'view/admin/penggunaAdmin.php';
    }

    public function mentorAdmin() {
        $nama_user = $_SESSION['nama'];
        $total_mentor = $this->userModel->getTotalMentor();
        require_once 'view/admin/mentorAdmin.php';
    }
    public function kursusAdmin() {
        $nama_user = $_SESSION['nama'];        
        require_once 'view/admin/kursusAdmin.php';
    }

    public function profilAdmin() {
        $nama_user = $_SESSION['nama'];
        
        require_once 'view/admin/profilAdmin.php';
    }
}
?>