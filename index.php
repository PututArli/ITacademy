<?php
session_start();

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($baseDir === '/') {
    $baseDir = '';
}
define('BASEURL', $protocol . '://' . $host . $baseDir);

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