<?php

class homeController {
    public function index() {
        $courseModel = new courseModel();
        
        $courses = $courseModel->getCourses();
        $mentors = $courseModel->getMentors();
        $pricing = $courseModel->getPricing();

        if (file_exists('view/landingview.php')) {
            require_once 'view/landingview.php';
        } else {
            echo "File view/landingview.php tidak ditemukan.";
        }
    }
}