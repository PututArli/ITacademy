<?php
session_start();

if (isset($_SESSION['nama']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: view/admin_dashboard.php");
    } elseif ($_SESSION['role'] === 'mentor') {
        header("Location: view/mentor_dashboard.php");
    } else {
        header("Location: view/dashboard.php");
    }
    exit();
}

require_once 'model/coursemodel.php';
require_once 'controller/homecontroller.php';

$controller = new HomeController();
$controller->index();
?>