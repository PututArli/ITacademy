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
        require_once 'view/user/tugas.php';
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