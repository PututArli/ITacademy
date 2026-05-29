<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$is_localhost = (
    $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ||
    $_SERVER['REMOTE_ADDR'] === '::1' ||
    $_SERVER['HTTP_HOST'] === 'localhost' ||
    strpos($_SERVER['HTTP_HOST'], 'localhost') !== false
);

if ($is_localhost) {
    define('BASEURL', 'http://localhost/ITacademy');
} else {
    define('BASEURL', 'https://itacademy-pemweb.infinityfree.me');
}

require_once 'model/koneksi.php';
require_once 'controller/authController.php';

$authCtrl = new authController();
$authCtrl->checkInactivity();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                header("Location: " . BASEURL . "/index.php?page=dashboardAdmin");
            } elseif ($_SESSION['role'] === 'mentor') {
                header("Location: " . BASEURL . "/index.php?page=dashboardMentor");
            } else {
                header("Location: " . BASEURL . "/index.php?page=dashboard");
            }
            exit();
        }
        require_once 'model/courseModel.php';
        require_once 'controller/homeController.php';
        $controller = new homeController();
        $controller->index();
        break;

    case 'login':
        $authCtrl->login();
        break;
    case 'register':
        $authCtrl->register();
        break;
    case 'logout':
        $isTimeout = isset($_GET['timeout']) && $_GET['timeout'] == '1';
        $authCtrl->logout($isTimeout);
        break;
    
    case 'dashboardAdmin':
        require_once 'controller/adminController.php';
        $adminCtrl = new adminController();
        $adminCtrl->dashboardAdmin();
        break;
    case 'penggunaAdmin':
        require_once 'controller/adminController.php';
        $adminCtrl = new adminController();
        $adminCtrl->penggunaAdmin();
        break;
    case 'mentorAdmin':
        require_once 'controller/adminController.php';
        $adminCtrl = new adminController();
        $adminCtrl->mentorAdmin();
        break;
    case 'kursusAdmin':
        require_once 'controller/adminController.php';
        $adminCtrl = new adminController();
        $adminCtrl->kursusAdmin();
        break;
    case 'profilAdmin':
        require_once 'controller/adminController.php';
        $adminCtrl = new adminController();
        $adminCtrl->profilAdmin();
        break;

    case 'dashboard':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->dashboard();
        break;
    case 'materi':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->materi();
        break;
    case 'kuis':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->kuis();
        break;
    case 'tugas':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->tugas();
        break;
    case 'kirimTugas':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->kirimTugas();
        break;
    case 'sertifikat':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->sertifikat();
        break;
    case 'profil':
        require_once 'controller/userController.php';
        $userCtrl = new userController();
        $userCtrl->profil();
        break;

    case 'dashboardMentor':
        require_once 'controller/mentorController.php';
        $mentorCtrl = new mentorController();
        $mentorCtrl->dashboardMentor();
        break;
    case 'reviewTugasMentor':
        require_once 'controller/mentorController.php';
        $mentorCtrl = new mentorController();
        $mentorCtrl->reviewTugasMentor();
        break;
    case 'siswaMentor':
        require_once 'controller/mentorController.php';
        $mentorCtrl = new mentorController();
        $mentorCtrl->siswaMentor();
        break;
    case 'profilMentor':
        require_once 'controller/mentorController.php';
        $mentorCtrl = new mentorController();
        $mentorCtrl->profilMentor();
        break;

    default:
        $viewFile = 'view/' . $page . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "404 - Halaman '" . htmlspecialchars($page) . "' tidak ditemukan di struktur ITacademy.";
        }
        break;
}
?>