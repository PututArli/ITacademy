<?php
require_once 'model/coursemodel.php';
require_once 'controller/homecontroller.php';

$controller = new HomeController();

$controller->index();