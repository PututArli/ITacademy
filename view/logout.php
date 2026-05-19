<?php
session_unset();
session_destroy();

// Redirect to login page properly
header("Location: " . BASEURL . "/index.php?page=login");
exit();
?>