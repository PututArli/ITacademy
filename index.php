<?php
session_start();

// Prevent browser caching to solve back-button after logout issue
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

$page = isset($_GET['page']) ? $_GET['page'] : (isset($_GET['url']) ? $_GET['url'] : 'home');
if (empty($page)) {
    $page = 'home';
}

if ($page === 'home' || $page === 'index' || $page === 'index.php') {
    if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            header("Location: " . BASEURL . "/index.php?page=admin_dashboard");
        } elseif ($_SESSION['role'] === 'mentor') {
            header("Location: " . BASEURL . "/index.php?page=mentor_dashboard");
        } else {
            header("Location: " . BASEURL . "/index.php?page=dashboard");
        }
        exit();
    }
    require_once 'model/coursemodel.php';
    require_once 'controller/homecontroller.php';
    $controller = new HomeController();
    $controller->index();
} else {
    $viewFile = 'view/' . $page . '.php';
    if (file_exists($viewFile)) {
        require_once $viewFile;
    } else {
        echo "404 - Halaman tidak ditemukan.";
    }
}
?>